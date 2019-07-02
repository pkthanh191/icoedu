<?php
include_once 'post_type.php';
include_once 'meta_box.php';
include_once 'short_code.php';

function bap_branch_include_script()
{
    wp_enqueue_script('validate-script-branch', get_stylesheet_directory_uri() . '/bap_branch/js/validate.js', array('jquery'), null, true);
    wp_enqueue_style('admin-styles-branch', get_template_directory_uri() . '/bap_branch/css/styles.css');
}

add_action('admin_enqueue_scripts', 'bap_branch_include_script');
add_action('get_header', function () {
    if (is_page('chi-nhanh') || is_page('branch') || is_page('en/branch') || is_page('vi/chi-nhanh') || is_page(4032)) {
        wp_enqueue_style('style-maps', get_template_directory_uri() . '/bap_branch/maps/maps.css');
        wp_enqueue_style('style-openlayers', 'https://openlayers.org/en/v4.6.5/css/ol.css');
        wp_enqueue_style('style-branch', get_template_directory_uri() . '/bap_branch/css/styles_frontend.css');
        wp_enqueue_script('script-openlayers', 'https://openlayers.org/en/v4.6.5/build/ol.js', array(), null, true);
        wp_enqueue_script('script-jquery', '//code.jquery.com/jquery-3.3.1.js', array(), null, true);
        wp_enqueue_script('script-ol3gm', 'http://dev5.mapgears.com/ol3-google-maps/dist/ol3gm.js', array('jquery'), null, true);
        wp_enqueue_script('script-googleapis', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyCmnkYZJlSdQK26Lub78DSS-_k248zGKmw', array('jquery'), null, true);
        wp_enqueue_script('script-mapsmaps', get_template_directory_uri() . '/bap_branch/maps/maps.js', array('jquery'), null, true);
        wp_enqueue_script('script-branch', get_template_directory_uri() . '/bap_branch/js/script_frontend.js', array('jquery'), null, true);
    }
});