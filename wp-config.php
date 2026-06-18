<?php

require_once dirname(__FILE__) . '/vendor/autoload.php';

use Dotenv\Dotenv;

// Load .env file
$dotenv = Dotenv::createImmutable(dirname(__FILE__));
$dotenv->load();

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', getenv( 'DB_CHARSET' ) ?: 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', getenv( 'DB_COLLATE' ) ?: '' );

/** Authentication Unique Keys and Salts. */
define( 'AUTH_KEY', '***REMOVED***' );
define( 'SECURE_AUTH_KEY', '***REMOVED***' );
define( 'LOGGED_IN_KEY', '***REMOVED***' );
define( 'NONCE_KEY', '***REMOVED***' );
define( 'AUTH_SALT', '***REMOVED***' );
define( 'SECURE_AUTH_SALT', '***REMOVED***' );
define( 'LOGGED_IN_SALT', '***REMOVED***' );
define( 'NONCE_SALT', '***REMOVED***' );

/* Add any custom values between this line and the "stop editing" line. */

// Configuration from .env file
// wp-config-ddev.php not needed
define( 'DB_NAME', $_ENV['DB_NAME'] );
define( 'DB_USER', $_ENV['DB_USER'] );
define( 'DB_PASSWORD', $_ENV['DB_PASSWORD'] );
define( 'DB_HOST', $_ENV['DB_HOST'] );
define( 'WP_DEBUG', $_ENV['WP_DEBUG'] === 'true' );
define( 'WP_HOME', $_ENV['WP_HOME']  );

define( 'WP_SITEURL', WP_HOME . '/' );

// Wordpress auto-update configuration
define( 'WP_AUTO_UPDATE_CORE', 'minor' );

// Configure the wp-mail-smtp plugin
define( 'WPMS_ON', true );
define( 'WPMS_MAIL_FROM', $_ENV['WPMS_MAIL_FROM'] );
define( 'WPMS_MAIL_FROM_NAME', $_ENV['WPMS_MAIL_FROM_NAME'] );
define( 'WPMS_MAILER', 'smtp' );
define( 'WPMS_SMTP_HOST', $_ENV['WPMS_SMTP_HOST'] );
define( 'WPMS_SMTP_PORT', $_ENV['WPMS_SMTP_PORT'] );
define( 'WPMS_SSL', $_ENV['WPMS_SSL'] === 'true' );
define( 'WPMS_SMTP_AUTH', $_ENV['WPMS_SMTP_AUTH'] === 'true' );
define( 'WPMS_SMTP_USER', $_ENV['WPMS_SMTP_USER'] );
define( 'WPMS_SMTP_PASS', $_ENV['WPMS_SMTP_PASS'] );

// Disable the plugin and theme editor
define( 'DISALLOW_FILE_EDIT', true );

// Disable WP cron due to performance issues and use a real cron job instead
define('DISABLE_WP_CRON', true);

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

// Include for settings managed by ddev.
$ddev_settings = __DIR__ . '/wp-config-ddev.php';
if ( ! defined( 'DB_USER' ) && getenv( 'IS_DDEV_PROJECT' ) === 'true' && is_readable( $ddev_settings ) ) {
	require_once( $ddev_settings );
}

/** Include wp-settings.php */
if ( file_exists( ABSPATH . '/wp-settings.php' ) ) {
	require_once ABSPATH . '/wp-settings.php';
}
