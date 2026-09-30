<?php
/**
 * Empties the WP Super Cache when timeline content changes without a post
 * save: the Years options page and the v29_row lanes (terms and row_order).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function v29_clear_page_cache() {
	if ( function_exists( 'wp_cache_clear_cache' ) ) {
		wp_cache_clear_cache();
	}
}

add_action( 'acf/save_post', function ( $post_id ) {
	if ( $post_id === 'options' ) {
		v29_clear_page_cache();
	}
}, 20 );

add_action( 'created_v29_row', 'v29_clear_page_cache' );
add_action( 'edited_v29_row', 'v29_clear_page_cache' );
add_action( 'delete_v29_row', 'v29_clear_page_cache' );

foreach ( [ 'added_term_meta', 'updated_term_meta' ] as $hook ) {
	add_action( $hook, function ( $meta_id, $term_id, $meta_key ) {
		if ( $meta_key === V29_ROW_ORDER_META ) {
			v29_clear_page_cache();
		}
	}, 10, 3 );
}
