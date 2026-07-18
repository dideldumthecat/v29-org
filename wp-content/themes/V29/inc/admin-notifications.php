<?php
/**
 * V29 – hourly content-change digest.
 *
 * Collects every publish / update / unpublish of timeline items and pages,
 * then mails one digest per hour, only for hours in which something changed.
 *
 * Mechanics:
 *   1. transition_post_status logs each event into an option.
 *   2. A scheduled hourly event mails the collected list and clears it.
 *
 * @package V29
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** Digest recipient(s). wp_mail() also accepts a comma-separated list. */
const V29_NOTIFY_EMAIL = 'webmasters@v29.org';

/** Option holding the queue of not-yet-mailed changes. */
const V29_NOTIFY_OPTION = 'v29_pending_changes';

/** Name of the scheduled digest event. */
const V29_NOTIFY_HOOK = 'v29_send_change_digest';

/* =========================================================================
 * 1. Collect
 *    Every relevant status change is appended to the queue, keyed by post
 *    ID so repeat saves of the same item collapse into one entry.
 * ====================================================================== */

add_action( 'transition_post_status', 'v29_log_content_change', 10, 3 );

function v29_log_content_change( $new_status, $old_status, $post ) {

	// Watched content types, with the label used in the digest.
	$watched = array(
		'v29_timeline_item' => 'Timeline item',
		'page'              => 'Page',
	);

	if ( ! isset( $watched[ $post->post_type ] ) ) {
		return;
	}

	// Skip autosaves and revisions.
	if ( wp_is_post_revision( $post ) || wp_is_post_autosave( $post ) ) {
		return;
	}

	// Classify by the publish transition; anything not touching publish exits.
	if ( 'publish' === $new_status && 'publish' !== $old_status ) {
		$action = 'published';
	} elseif ( 'publish' === $new_status ) {
		$action = 'updated';
	} elseif ( 'publish' === $old_status ) {
		$action = ( 'trash' === $new_status ) ? 'trashed' : 'unpublished';
	} else {
		return;
	}

	$user    = wp_get_current_user();
	$pending = get_option( V29_NOTIFY_OPTION, array() );
	$id      = $post->ID;

	if ( isset( $pending[ $id ] ) ) {
		$entry = $pending[ $id ];
		$entry['saves']++;
		// "updated" never demotes a fresh publish; removals always win.
		if ( 'updated' !== $action || 'published' !== $entry['action'] ) {
			$entry['action'] = $action;
		}
	} else {
		$entry = array(
			'type'   => $watched[ $post->post_type ],
			'action' => $action,
			'saves'  => 1,
		);
	}

	// Refreshed every event, so a title added after an untitled first save wins.
	$entry['title'] = $post->post_title ?: '(no title)';
	$entry['by']    = $user->exists() ? $user->display_name : 'unknown user';
	$entry['last']  = wp_date( 'H:i' );

	$pending[ $id ] = $entry;
	update_option( V29_NOTIFY_OPTION, $pending, false ); // false = no autoload.
}

/* =========================================================================
 * 2. Digest
 *    Runs hourly via WP-Cron. Empty hours produce no mail.
 * ====================================================================== */

add_action( 'init', function () {
	if ( ! wp_next_scheduled( V29_NOTIFY_HOOK ) ) {
		wp_schedule_event( time(), 'hourly', V29_NOTIFY_HOOK );
	}
} );

add_action( V29_NOTIFY_HOOK, 'v29_send_change_digest' );

function v29_send_change_digest() {

	$pending = get_option( V29_NOTIFY_OPTION, array() );
	if ( empty( $pending ) ) {
		return;
	}

	// Clear before sending, so a failed send loses one digest rather than
	// resending stale entries on the next run.
	delete_option( V29_NOTIFY_OPTION );

	$lines = array();
	foreach ( $pending as $e ) {
		$saves   = ( $e['saves'] > 1 ) ? sprintf( ', %d saves', $e['saves'] ) : '';
		$lines[] = sprintf(
			"%s %s: \"%s\"\n  by %s (last %s%s)\n",
			$e['type'],
			$e['action'],
			$e['title'],
			$e['by'],
			$e['last'],
			$saves
		);
	}

	$count   = count( $pending );
	$subject = sprintf(
		'[V29] %d change%s in the last hour',
		$count,
		( 1 === $count ) ? '' : 's'
	);

	$body = implode( "\n", $lines );

	if ( false === wp_mail( V29_NOTIFY_EMAIL, $subject, $body ) ) {
		error_log( sprintf( '[V29] change digest failed to send (%d entries lost)', $count ) );
	}
}

/* =========================================================================
 * 3. Hygiene
 *    If the theme is ever switched away, remove the schedule and queue.
 * ====================================================================== */

add_action( 'switch_theme', function () {
	wp_clear_scheduled_hook( V29_NOTIFY_HOOK );
	delete_option( V29_NOTIFY_OPTION );
} );
