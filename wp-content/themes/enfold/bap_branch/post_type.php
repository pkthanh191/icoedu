<?php
function create_branch_post_type()
{
    $label = array(
        'name' => 'Chi nhánh',
        'singular_name' => 'Chi nhánh'
    );

    $args = array(
        'labels' => $label,
        'description' => 'Post type đăng chi nhánh',
        'supports' => array(
            'title',
            'thumbnail'
        ),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-location-alt',
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'post'
    );
    register_post_type('branch', $args);
}

add_action('init', 'create_branch_post_type');