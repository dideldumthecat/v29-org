<?php

add_filter( 'auto_update_plugin', function ( $update, $item ) {
    $managed = [
        'secure-custom-fields/secure-custom-fields.php',
        'wp-mail-smtp/wp_mail_smtp.php',
        'wp-super-cache/wp-cache.php',
    ];
    return in_array( $item->plugin, $managed, true ) ? true : $update;
}, 10, 2 );
