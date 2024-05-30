<?php
function qkn_register_sites_taxonomy() {
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
        'hierarchical'               => false,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );
    register_taxonomy('site', array('system'), $args);
}
add_action('init', 'qkn_register_sites_taxonomy', 0);

