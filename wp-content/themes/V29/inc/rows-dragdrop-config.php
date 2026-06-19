<?php
/**
 * V29 — Drag & drop ordering for timeline rows.
 *
 * Adds drag-and-drop sorting directly inside the native "Rows" term list
 * (edit-tags.php?taxonomy=v29_row). Dragging a row auto-saves its position
 * to the `row_order` term meta via AJAX — no save button, no separate page.
 *
 * The `row_order` meta is the single source of truth. The old SCF number
 * field is no longer needed (you can stop importing field-row-order.json);
 * this code reads and writes the raw term meta directly.
 *
 * Install: require_once this file from your theme's functions.php, or paste
 * its contents into your v29-timeline plugin.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

const V29_ROW_TAXONOMY   = 'v29_row';
const V29_ROW_ORDER_META = 'row_order';

/* -------------------------------------------------------------------------
 * 1. Render the admin term list in row_order.
 *
 * LEFT JOIN (rather than meta_key + meta_value_num on get_terms, which would
 * INNER JOIN and silently drop rows that have no order yet). COALESCE pushes
 * un-ordered rows to the bottom instead of the top.
 *
 * Guarded to is_admin() so front-end / template term queries are untouched —
 * you'll set ordering explicitly there during templating.
 * ---------------------------------------------------------------------- */
add_filter( 'terms_clauses', 'v29_order_rows_clauses', 10, 3 );
function v29_order_rows_clauses( $clauses, $taxonomies, $args ) {
	if ( ! is_admin() ) {
		return $clauses;
	}
	if ( ! in_array( V29_ROW_TAXONOMY, (array) $taxonomies, true ) ) {
		return $clauses;
	}

	global $wpdb;
	$meta_key = esc_sql( V29_ROW_ORDER_META );

	$clauses['join']   .= " LEFT JOIN {$wpdb->termmeta} AS v29om ON ( t.term_id = v29om.term_id AND v29om.meta_key = '{$meta_key}' )";
	$clauses['orderby'] = 'ORDER BY CAST( COALESCE( v29om.meta_value, 999999 ) AS UNSIGNED )';
	$clauses['order']   = 'ASC';

	return $clauses;
}

/* -------------------------------------------------------------------------
 * 2. Enqueue Sortable + our glue, only on the Rows term list screen.
 * ---------------------------------------------------------------------- */
add_action( 'admin_enqueue_scripts', 'v29_enqueue_row_sort' );
function v29_enqueue_row_sort( $hook ) {
	if ( 'edit-tags.php' !== $hook ) {
		return;
	}
	if ( ! isset( $_GET['taxonomy'] ) || V29_ROW_TAXONOMY !== $_GET['taxonomy'] ) {
		return;
	}

	wp_enqueue_script( 'jquery-ui-sortable' );

	wp_localize_script(
		'jquery-ui-sortable',
		'V29RowSort',
		array( 'nonce' => wp_create_nonce( 'v29_row_sort' ) )
	);

	$js = <<<'JS'
jQuery(function ($) {
	var $list = $('#the-list');
	if (!$list.length) {
		return;
	}

	$list.sortable({
		items: '> tr',
		axis: 'y',
		cursor: 'move',
		opacity: 0.95,
		placeholder: 'v29-sort-placeholder',
		// Keep column widths intact while dragging a table row.
		helper: function (e, $row) {
			var $cells = $row.children();
			var $clone = $row.clone();
			$clone.children().each(function (i) {
				$(this).width($cells.eq(i).width());
			});
			return $clone;
		},
		update: function () {
			var order = $list.children('tr').map(function () {
				return this.id.replace('tag-', '');
			}).get();

			$list.addClass('v29-saving');
			$.post(ajaxurl, {
				action: 'v29_save_row_order',
				nonce: V29RowSort.nonce,
				order: order
			}).always(function () {
				$list.removeClass('v29-saving');
			});
		}
	});
});
JS;

	wp_add_inline_script( 'jquery-ui-sortable', $js );

	$css = <<<'CSS'
body.taxonomy-v29_row #the-list tr { cursor: move; }
body.taxonomy-v29_row #the-list tr:hover { background: #f6f7f7; }
.v29-sort-placeholder { outline: 2px dashed #2271b1; }
.v29-sort-placeholder > * { visibility: hidden; }
.ui-sortable-helper { box-shadow: 0 2px 8px rgba(0,0,0,.15); }
.v29-saving { opacity: .6; transition: opacity .2s ease; }
CSS;

	wp_add_inline_style( 'common', $css );
}

/* -------------------------------------------------------------------------
 * 3. Save the new order.
 * ---------------------------------------------------------------------- */
add_action( 'wp_ajax_v29_save_row_order', 'v29_save_row_order' );
function v29_save_row_order() {
	check_ajax_referer( 'v29_row_sort', 'nonce' );

	if ( ! current_user_can( 'manage_categories' ) ) {
		wp_send_json_error( 'forbidden', 403 );
	}

	$order = ( isset( $_POST['order'] ) && is_array( $_POST['order'] ) )
		? array_map( 'absint', $_POST['order'] )
		: array();

	if ( empty( $order ) ) {
		wp_send_json_error( 'empty', 400 );
	}

	$position = 1;
	foreach ( $order as $term_id ) {
		// Stored in 10s so the values stay readable if you ever peek at them.
		update_term_meta( $term_id, V29_ROW_ORDER_META, $position * 10 );
		$position++;
	}

	wp_send_json_success( array( 'saved' => count( $order ) ) );
}