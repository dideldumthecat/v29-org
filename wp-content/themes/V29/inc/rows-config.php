<?php
/**
 * V29 — Rows list & form tweaks.
 *
 * On the v29_row term screens (Timeline Items > Rows):
 *   - List:      strip the Slug and Count columns (Name + Description remain).
 *   - Add/Edit:  hide the Parent and Slug fields.
 *
 * Row order is handled by drag-and-drop (see v29-row-ordering.php), which owns
 * the list sorting — so there's no Order column and no click-to-sort here.
 *
 * NOTE on the old "sort order" field: remove the SCF field group
 * (group_v29_row / field-row-order.json) in SCF rather than hiding it. An
 * active SCF field still writes on every term save, so a hidden one could
 * clobber the row_order value set by drag-and-drop. Removing the group leaves
 * the row_order term meta intact — it's just no longer an editable field.
 *
 * Drop into your theme's functions.php, or save as an include and require it.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * List columns: drop Slug + Count, leaving the checkbox, Name and Description.
 * ('posts' is the Count column; 'slug' is the Slug column.)
 */
add_filter( 'manage_edit-v29_row_columns', function ( $columns ) {
	unset( $columns['slug'], $columns['posts'] );
	return $columns;
} );

/**
 * Add/Edit form: hide the Parent and Slug fields.
 *
 * The taxonomy stays hierarchical (so the timeline-item editor keeps its
 * checkbox UI for picking a row); we only hide the unused Parent dropdown.
 * Slug still auto-generates from the name on save.
 *
 * Loaded only on the v29_row term screens, so the plain selectors can't leak
 * to other taxonomies.
 */
add_action( 'admin_enqueue_scripts', function ( $hook ) {
	if ( ! in_array( $hook, array( 'edit-tags.php', 'term.php' ), true ) ) {
		return;
	}

	$taxonomy = isset( $_REQUEST['taxonomy'] ) ? sanitize_key( wp_unslash( $_REQUEST['taxonomy'] ) ) : '';
	if ( 'v29_row' !== $taxonomy ) {
		return;
	}

	wp_add_inline_style(
		'common',
		'.term-parent-wrap, .term-slug-wrap { display: none; }'
	);
} );