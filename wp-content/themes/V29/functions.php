<?php

if ( class_exists( 'Timber\Timber' ) ) {
    Timber\Timber::init();
}

function v29_enqueue_assets() {
    wp_enqueue_style( 'v29-style', get_template_directory_uri() . '/assets/css/style.css', [], substr( md5_file( get_template_directory() . '/assets/css/style.css' ), 0, 8 ) );
    wp_enqueue_script( 'v29-script', get_template_directory_uri() . '/assets/js/script.js', [], substr( md5_file( get_template_directory() . '/assets/js/script.js' ), 0, 8 ), true );

    $config = v29_get_timeline_js_config();
    if ( $config ) {
        wp_add_inline_script( 'v29-script', 'window.V29Timeline = ' . wp_json_encode( $config ) . ';', 'before' );
    }
}
add_action( 'wp_enqueue_scripts', 'v29_enqueue_assets' );

add_filter( 'show_admin_bar', '__return_false' );
// Force WordPress to NOT organize uploads into month/year folders
add_filter('pre_option_uploads_use_yearmonth_folders', '__return_zero');

/**
 * PHP includes
 */
require_once get_template_directory() . '/inc/admin-rows-config.php';
require_once get_template_directory() . '/inc/admin-rows-dragdrop-config.php';
require_once get_template_directory() . '/inc/admin-timeline-item-order.php';
require_once get_template_directory() . '/inc/admin-timeline-item-columns.php';
require_once get_template_directory() . '/inc/admin-timeline-item-title-hint.php';
require_once get_template_directory() . '/inc/admin-autoupdate-plugins.php';
require_once get_template_directory() . '/inc/admin-notifications.php';
require_once get_template_directory() . '/inc/template-timeline.php';
