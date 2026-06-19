<?php
/**
 * Default ordering for the v29_timeline_item admin list table.
 *
 * Sorts by:
 *   1. Row    — the item's v29_row term, ordered by its `row_order` term meta
 *               (mirrors the timeline's top-to-bottom row sequence).
 *   2. start_date — ascending (earliest first).
 *
 * Only applies to the default view. Clicking a sortable column header still
 * overrides this, so editors keep full control.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'pre_get_posts', 'v29_timeline_item_default_admin_order' );

/**
 * Gate: only the main list query for v29_timeline_item, and only when the
 * editor hasn't explicitly chosen a sort column.
 */
function v29_timeline_item_default_admin_order( $query ) {
	if ( ! is_admin() || ! $query->is_main_query() ) {
		return;
	}

	if ( 'v29_timeline_item' !== $query->get( 'post_type' ) ) {
		return;
	}

	// A manual column-sort sets `orderby` in the URL — respect it.
	if ( ! empty( $_GET['orderby'] ) ) {
		return;
	}

	add_filter( 'posts_clauses', 'v29_timeline_item_order_clauses', 10, 2 );
}

/**
 * Inject the ORDER BY via correlated subqueries.
 *
 * Subqueries (rather than JOINs) keep the result set clean: no row
 * multiplication if an item ever lands in more than one row term, and no
 * GROUP BY needed. For an admin list of this size, performance is a non-issue.
 */
function v29_timeline_item_order_clauses( $clauses, $query ) {
	global $wpdb;

	// Shape only this one query — drop the filter so nothing else on the page is touched.
	remove_filter( 'posts_clauses', 'v29_timeline_item_order_clauses', 10 );

	// 1. Row order: lowest `row_order` term meta among the item's v29_row terms.
	//    Want alphabetical rows instead? Swap the termmeta join + MIN(...) for
	//    a join to {$wpdb->terms} t and select MIN( t.name ).
	$row_order = "(
		SELECT MIN( CAST( tm.meta_value AS UNSIGNED ) )
		FROM {$wpdb->term_relationships} tr
		INNER JOIN {$wpdb->term_taxonomy} tt
			ON tt.term_taxonomy_id = tr.term_taxonomy_id
			AND tt.taxonomy = 'v29_row'
		INNER JOIN {$wpdb->termmeta} tm
			ON tm.term_id = tt.term_id
			AND tm.meta_key = 'row_order'
		WHERE tr.object_id = {$wpdb->posts}.ID
	)";

	// 2. start_date: the SCF date_picker stores values as Ymd, so plain
	//    string comparison already sorts chronologically.
	$start_date = "(
		SELECT pm.meta_value
		FROM {$wpdb->postmeta} pm
		WHERE pm.post_id = {$wpdb->posts}.ID
		AND pm.meta_key = 'start_date'
		LIMIT 1
	)";

	// Items missing a row or a date sort to the TOP (NULL is first in ASC), so
	// half-finished entries stay visible while you populate. To push them to the
	// bottom instead, wrap each subquery: COALESCE( <subquery>, 'zzzzzzzz' ).
	$clauses['orderby'] = "{$row_order} ASC, {$start_date} ASC, {$wpdb->posts}.post_title ASC";

	return $clauses;
}