<?php
/**
 * Editor note under the title field on the v29_timeline_item edit screen.
 *
 * The title is backend-only — it distinguishes items in the admin list and is
 * never rendered on the frontend timeline. This prints a short reminder so
 * editors understand why the field is there and that it stays internal.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'edit_form_after_title', 'v29_timeline_item_title_hint' );

function v29_timeline_item_title_hint( $post ) {
	if ( 'v29_timeline_item' !== $post->post_type ) {
		return;
	}

	echo '<p class="description">This title is only used in the backend to distinguish items — it is not displayed on the timeline.</p>';
}
