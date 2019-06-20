<?php
include_once 'meta_box.php';

function bap_post_include_script()
{
    if (!did_action('wp_enqueue_media')) {
        wp_enqueue_media();
    }
    wp_enqueue_script('bap-script-common', get_stylesheet_directory_uri() . '/bap_post/js/bap_script.js', array('jquery'), null, false);
}

add_action('admin_enqueue_scripts', 'bap_post_include_script');