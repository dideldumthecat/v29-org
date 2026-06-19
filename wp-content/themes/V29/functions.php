<?php

function v29_enqueue_assets() {
    wp_enqueue_style( 'v29-style', get_stylesheet_uri(), [], '1.0' );
    wp_enqueue_script( 'v29-script', get_template_directory_uri() . '/script.js', [], '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'v29_enqueue_assets' );

add_filter( 'show_admin_bar', '__return_false' );

/**
 * PHP includes
 */
require_once get_template_directory() . '/inc/rows-config.php';
require_once get_template_directory() . '/inc/rows-dragdrop-config.php';
require_once get_template_directory() . '/inc/timeline-item-order.php';