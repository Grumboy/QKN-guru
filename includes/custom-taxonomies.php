<?php
// Register Custom Taxonomies
function qkn_register_custom_taxonomies() {
    // Sites Taxonomy
    $labels = array(
        'name'                       => _x('Sites', 'Taxonomy General Name', 'text_domain'),
        'singular_name'              => _x('Site', 'Taxonomy Singular Name', 'text_domain'),
        'menu_name'                  => __('Sites', 'text_domain'),
        'all_items'                  => __('All Sites', 'text_domain'),
        'parent_item'                => __('Parent Site', 'text_domain'),
        'parent_item_colon'          => __('Parent Site:', 'text_domain'),
        'new_item_name'              => __('New Site Name', 'text_domain'),
        'add_new_item'               => __('Add New Site', 'text_domain'),
        'edit_item'                  => __('Edit Site', 'text_domain'),
        'update_item'                => __('Update Site', 'text_domain'),
        'view_item'                  => __('View Site', 'text_domain'),
        'separate_items_with_commas' => __('Separate sites with commas', 'text_domain'),
        'add_or_remove_items'        => __('Add or remove sites', 'text_domain'),
        'choose_from_most_used'      => __('Choose from the most used', 'text_domain'),
        'popular_items'              => __('Popular Sites', 'text_domain'),
        'search_items'               => __('Search Sites', 'text_domain'),
        'not_found'                  => __('Not Found', 'text_domain'),
        'no_terms'                   => __('No sites', 'text_domain'),
        'items_list'                 => __('Sites list', 'text_domain'),
        'items_list_navigation'      => __('Sites list navigation', 'text_domain'),
        'filter_items_list'          => __('Filter sites list', 'text_domain'),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true, // Set to true for hierarchical taxonomy
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'rewrite'                    => array('slug' => 'site'),
    );
    register_taxonomy('sites', array('system'), $args);
}
add_action('init', 'qkn_register_custom_taxonomies', 0);