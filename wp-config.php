<?php

require_once dirname(__FILE__) . '/vendor/autoload.php';

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/* Add any custom values between this line and the "stop editing" line. */

// WordPress auto-update configuration
define( 'WP_AUTO_UPDATE_CORE', 'minor' );

// wp-mail-smtp plugin constants shared across environments
define( 'WPMS_ON', true );
define( 'WPMS_MAILER', 'smtp' );

// Disable the plugin and theme editor
define( 'DISALLOW_FILE_EDIT', true );

// Disable WP cron due to performance issues and use a real cron job instead
define( 'DISABLE_WP_CRON', true );

/**
 * Set WordPress Database Table prefix if not already set.
 *
 * @global string $table_prefix
 */
if ( ! isset( $table_prefix ) || empty( $table_prefix ) ) {
	// phpcs:disable WordPress.WP.GlobalVariablesOverride.Prohibited
	$table_prefix = 'wp_';
	// phpcs:enable
}

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
defined( 'ABSPATH' ) || define( 'ABSPATH', __DIR__ . '/' );

if ( getenv( 'IS_DDEV_PROJECT' ) === 'true' ) {
	require_once __DIR__ . '/wp-config-ddev.php';
} else {
	require_once __DIR__ . '/wp-config-production.php';
}

/** Include wp-settings.php */
if ( file_exists( ABSPATH . '/wp-settings.php' ) ) {
	require_once ABSPATH . '/wp-settings.php';
}
