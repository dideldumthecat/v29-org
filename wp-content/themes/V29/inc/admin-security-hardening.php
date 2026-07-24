<?php
/**
 * V29 — front-end security hardening.
 *
 * Closes the recon vectors that expose the administrator account and the exact
 * WordPress version to anonymous visitors:
 *
 *   1. REST API gated to logged-in users (the public front end never calls it).
 *   2. Author-archive / ?author=N enumeration redirected to the home page.
 *   3. Generator version tag removed from wp_head and the feeds.
 *
 * @package V29
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* -------------------------------------------------------------------------
 * 1. Restrict the whole REST API to authenticated users.
 *
 * Returns 401 for anonymous callers on every /wp-json/ route; logged-in
 * requests (the block editor, media library) pass through untouched.
 * ---------------------------------------------------------------------- */
add_filter( 'rest_authentication_errors', 'v29_restrict_rest_to_authenticated' );
function v29_restrict_rest_to_authenticated( $result ) {
	if ( ! empty( $result ) ) {
		return $result;
	}
	if ( ! is_user_logged_in() ) {
		return new WP_Error(
			'rest_not_logged_in',
			'REST API access is restricted to authenticated users.',
			array( 'status' => 401 )
		);
	}
	return $result;
}

/* -------------------------------------------------------------------------
 * 2. Send author requests to the home page.
 *
 * Priority 0 fires ahead of redirect_canonical (10), so ?author=N is caught
 * before its 301 to /author/<slug>/ can leak the login name in the Location
 * header. Also covers direct hits on author archive URLs.
 * ---------------------------------------------------------------------- */
add_action( 'template_redirect', 'v29_block_author_enumeration', 0 );
function v29_block_author_enumeration() {
	if ( is_author() || isset( $_GET['author'] ) ) {
		wp_safe_redirect( home_url( '/' ), 301 );
		exit;
	}
}

/* -------------------------------------------------------------------------
 * 3. Drop the WordPress version tag from the head and the feeds.
 * ---------------------------------------------------------------------- */
remove_action( 'wp_head', 'wp_generator' );
add_filter( 'the_generator', '__return_empty_string' );
