<?php
// Register Custom Post Types
function qkn_register_custom_post_types() {
    // Systems Post Type
    $labels = array(
        'name'                  => _x( 'Systems', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'System', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'             => __( 'Systems', 'text_domain' ),
        'name_admin_bar'        => __( 'System', 'text_domain' ),
        'archives'              => __( 'System Archives', 'text_domain' ),
        'attributes'            => __( 'System Attributes', 'text_domain' ),
        'parent_item_colon'     => __( 'Parent System:', 'text_domain' ),
        'all_items'             => __( 'All Systems', 'text_domain' ),
        'add_new_item'          => __( 'Add New System', 'text_domain' ),
        'add_new'               => __( 'Add New', 'text_domain' ),
        'new_item'              => __( 'New System', 'text_domain' ),
        'edit_item'             => __( 'Edit System', 'text_domain' ),
        'update_item'           => __( 'Update System', 'text_domain' ),
        'view_item'             => __( 'View System', 'text_domain' ),
        'view_items'            => __( 'View Systems', 'text_domain' ),
        'search_items'          => __( 'Search System', 'text_domain' ),
        'not_found'             => __( 'Not found', 'text_domain' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
        'featured_image'        => __( 'Featured Image', 'text_domain' ),
        'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
        'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
        'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
        'insert_into_item'      => __( 'Insert into system', 'text_domain' ),
        'uploaded_to_this_item' => __( 'Uploaded to this system', 'text_domain' ),
        'items_list'            => __( 'Systems list', 'text_domain' ),
        'items_list_navigation' => __( 'Systems list navigation', 'text_domain' ),
        'filter_items_list'     => __( 'Filter systems list', 'text_domain' ),
    );
    $args = array(
        'label'                 => __( 'System', 'text_domain' ),
        'description'           => __( 'Post Type Description', 'text_domain' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields' ),
        'taxonomies'            => array( 'category', 'post_tag' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
    );
    register_post_type( 'system', $args );

    // Fixes Post Type
    $labels = array(
        'name'                  => _x( 'Fixes', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'Fix', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'             => __( 'Fixes', 'text_domain' ),
        'name_admin_bar'        => __( 'Fix', 'text_domain' ),
        'archives'              => __( 'Fix Archives', 'text_domain' ),
        'attributes'            => __( 'Fix Attributes', 'text_domain' ),
        'parent_item_colon'     => __( 'Parent Fix:', 'text_domain' ),
        'all_items'             => __( 'All Fixes', 'text_domain' ),
        'add_new_item'          => __( 'Add New Fix', 'text_domain' ),
        'add_new'               => __( 'Add New', 'text_domain' ),
        'new_item'              => __( 'New Fix', 'text_domain' ),
        'edit_item'             => __( 'Edit Fix', 'text_domain' ),
        'update_item'           => __( 'Update Fix', 'text_domain' ),
        'view_item'             => __( 'View Fix', 'text_domain' ),
        'view_items'            => __( 'View Fixes', 'text_domain' ),
        'search_items'          => __( 'Search Fix', 'text_domain' ),
        'not_found'             => __( 'Not found', 'text_domain' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
        'featured_image'        => __( 'Featured Image', 'text_domain' ),
        'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
        'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
        'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
        'insert_into_item'      => __( 'Insert into fix', 'text_domain' ),
        'uploaded_to_this_item' => __( 'Uploaded to this fix', 'text_domain' ),
        'items_list'            => __( 'Fixes list', 'text_domain' ),
        'items_list_navigation' => __( 'Fixes list navigation', 'text_domain' ),
        'filter_items_list'     => __( 'Filter fixes list', 'text_domain' ),
    );
    $args = array(
        'label'                 => __( 'Fix', 'text_domain' ),
        'description'           => __( 'Post Type Description', 'text_domain' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields' ),
        'taxonomies'            => array( 'category', 'post_tag' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
    );
    register_post_type( 'fix', $args );
}
add_action( 'init', 'qkn_register_custom_post_types', 0 );
