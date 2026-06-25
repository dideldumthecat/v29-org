<?php
/**
 * DDEV environment settings — loaded by wp-config.php when IS_DDEV_PROJECT=true.
 *
 * @package ddevapp
 */

if ( getenv( 'IS_DDEV_PROJECT' ) !== 'true' ) {
	return;
}

/** The name of the database for WordPress */
defined( 'DB_NAME' ) || define( 'DB_NAME', getenv( 'DB_NAME' ) ?: 'db' );

/** MySQL database username */
defined( 'DB_USER' ) || define( 'DB_USER', getenv( 'DB_USER' ) ?: 'db' );

/** MySQL database password */
defined( 'DB_PASSWORD' ) || define( 'DB_PASSWORD', getenv( 'DB_PASSWORD' ) ?: 'db' );

/** MySQL hostname */
defined( 'DB_HOST' ) || define( 'DB_HOST', getenv( 'DB_HOST' ) ?: 'db' );

/** WP_HOME URL */
defined( 'WP_HOME' ) || define( 'WP_HOME', getenv( 'DDEV_PRIMARY_URL' ) ?: 'http://localhost' );

/** WP_SITEURL location */
defined( 'WP_SITEURL' ) || define(
	'WP_SITEURL',
	WP_HOME . '/' . ltrim(
		str_replace(
			realpath( getenv( 'DDEV_APPROOT' ) . '/' . getenv( 'DDEV_DOCROOT' ) ),
			'',
			realpath( ABSPATH )
		),
		'/'
	)
);

/** Enable debug (can be disabled with `ddev config --web-environment-add=WP_DEBUG=false`) */
defined( 'WP_DEBUG' ) || define( 'WP_DEBUG', getenv( 'WP_DEBUG' ) === false || getenv( 'WP_DEBUG' ) === 'true' );

/**
 * Set WordPress Database Table prefix if not already set.
 *
 * @global string $table_prefix
 */
if ( empty( $table_prefix ) ) {
	// phpcs:disable WordPress.WP.GlobalVariablesOverride.Prohibited
	$table_prefix = getenv('DB_PREFIX') ?: 'wp_';
	// phpcs:enable
}

/** Install-time constants (used by install.sh) */
defined( 'WP_SITE_TITLE' )     || define( 'WP_SITE_TITLE',     'V29' );
defined( 'WP_ADMIN_USER' )     || define( 'WP_ADMIN_USER',     'admin' );
defined( 'WP_ADMIN_PASSWORD' ) || define( 'WP_ADMIN_PASSWORD', 'admin' );
defined( 'WP_ADMIN_EMAIL' )    || define( 'WP_ADMIN_EMAIL',    'info@alexandersumma.de' );
defined( 'WP_THEME' )          || define( 'WP_THEME',          'V29' );

/** wp-mail-smtp: local Mailpit */
defined( 'WPMS_MAIL_FROM' )      || define( 'WPMS_MAIL_FROM', 'no-reply@localhost.invalid' );
defined( 'WPMS_MAIL_FROM_NAME' ) || define( 'WPMS_MAIL_FROM_NAME', 'Localhost' );
defined( 'WPMS_SMTP_HOST' )      || define( 'WPMS_SMTP_HOST', 'localhost' );
defined( 'WPMS_SMTP_PORT' )      || define( 'WPMS_SMTP_PORT', 1025 );
defined( 'WPMS_SSL' )            || define( 'WPMS_SSL', '' );
defined( 'WPMS_SMTP_AUTH' )      || define( 'WPMS_SMTP_AUTH', false );
defined( 'WPMS_SMTP_USER' )      || define( 'WPMS_SMTP_USER', '' );
defined( 'WPMS_SMTP_PASS' )      || define( 'WPMS_SMTP_PASS', '' );
