<?php
/**
 * Start date / End date columns for the v29_timeline_item admin list table.
 *
 * Adds two read-only columns next to the Row column so editors can see each
 * item's timeline position at a glance, and makes both sortable. Sorting reuses
 * the same correlated-subquery approach as the default-order file, so an item
 * without a date stays visible (NULL sorts first in ASC) rather than being
 * filtered out by a JOIN.
 *
 * Display uses d.m.Y (matching the date picker). The value is stored as Ymd,
 * which already sorts chronologically as a plain string.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* -------------------------------------------------------------------------
 * Columns
 * ---------------------------------------------------------------------- */

add_filter( 'manage_v29_timeline_item_posts_columns', 'v29_timeline_item_columns' );

function v29_timeline_item_columns( $columns ) {
	// Sit the dates after the Row column when present, otherwise after Title.
	$anchor = isset( $columns['taxonomy-v29_row'] ) ? 'taxonomy-v29_row' : 'title';

	$new = [];
	foreach ( $columns as $key => $label ) {
		$new[ $key ] = $label;
		if ( $key === $anchor ) {
			$new['v29_start_date'] = 'Start date';
			$new['v29_end_date']   = 'End date';
		}
	}
	return $new;
}

add_action( 'manage_v29_timeline_item_posts_custom_column', 'v29_timeline_item_column_content', 10, 2 );

function v29_timeline_item_column_content( $column, $post_id ) {
	if ( 'v29_start_date' === $column ) {
		echo esc_html( v29_format_admin_date( get_field( 'start_date', $post_id ) ) );
	} elseif ( 'v29_end_date' === $column ) {
		$formatted = v29_format_admin_date( get_field( 'end_date', $post_id ) );
		echo $formatted ? esc_html( $formatted ) : '&mdash;';
	}
}

/**
 * get_field() returns the date as Y-m-d (the field's return format); show it as
 * d.m.Y. Falls back to the raw value if it ever arrives in another shape.
 */
function v29_format_admin_date( $date ) {
	if ( ! $date ) {
		return '';
	}
	$dt = DateTime::createFromFormat( 'Y-m-d', $date );
	return $dt ? $dt->format( 'd.m.Y' ) : $date;
}

/* -------------------------------------------------------------------------
 * Sorting
 * ---------------------------------------------------------------------- */

add_filter( 'manage_edit-v29_timeline_item_sortable_columns', 'v29_timeline_item_sortable_columns' );

function v29_timeline_item_sortable_columns( $columns ) {
	$columns['v29_start_date'] = 'start_date';
	$columns['v29_end_date']   = 'end_date';
	return $columns;
}

add_action( 'pre_get_posts', 'v29_timeline_item_date_sort' );

/**
 * When a date column header is clicked, hand ordering to a correlated subquery
 * so items missing the date are kept rather than dropped by a meta JOIN.
 *
 * (The default-order file bows out automatically here: it only runs when no
 * `orderby` is set, and clicking a column sets one.)
 */
function v29_timeline_item_date_sort( $query ) {
	if ( ! is_admin() || ! $query->is_main_query() ) {
		return;
	}
	if ( 'v29_timeline_item' !== $query->get( 'post_type' ) ) {
		return;
	}

	$orderby = $query->get( 'orderby' );
	if ( 'start_date' === $orderby || 'end_date' === $orderby ) {
		add_filter( 'posts_clauses', 'v29_timeline_item_date_sort_clauses', 10, 2 );
	}
}

function v29_timeline_item_date_sort_clauses( $clauses, $query ) {
	global $wpdb;

	remove_filter( 'posts_clauses', 'v29_timeline_item_date_sort_clauses', 10 );

	// orderby is one of two whitelisted keys, so it's safe to drop into SQL.
	$meta_key = ( 'end_date' === $query->get( 'orderby' ) ) ? 'end_date' : 'start_date';
	$order    = ( 'DESC' === strtoupper( $query->get( 'order' ) ) ) ? 'DESC' : 'ASC';

	$date = "(
		SELECT pm.meta_value
		FROM {$wpdb->postmeta} pm
		WHERE pm.post_id = {$wpdb->posts}.ID
		AND pm.meta_key = '{$meta_key}'
		LIMIT 1
	)";

	$clauses['orderby'] = "{$date} {$order}, {$wpdb->posts}.post_title ASC";

	return $clauses;
}