<?php
/*
Plugin Name: QKN Guru Post Types
Description: Custom post types for Fixes and Systems with their respective fields and functionalities.
Version: 1.0
Author: Jens Bellander
*/

// Include custom post types and taxonomies
require_once plugin_dir_path(__FILE__) . 'includes/custom-post-types.php';
require_once plugin_dir_path(__FILE__) . 'includes/custom-taxonomies.php';

// Enqueue scripts and styles
function qkn_guru_enqueue_scripts() {
    wp_enqueue_style('qkn-guru-styles', plugin_dir_url(__FILE__) . 'css/styles.css');
    wp_enqueue_script('qkn-guru-scripts', plugin_dir_url(__FILE__) . 'js/scripts.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'qkn_guru_enqueue_scripts');

// Include custom pages
function qkn_guru_include_custom_pages() {
    add_menu_page('Add New System', 'Add New System', 'manage_options', 'add-new-system', 'qkn_guru_add_new_system_page');
    add_submenu_page('add-new-system', 'List All Systems', 'List All Systems', 'manage_options', 'list-all-systems', 'qkn_guru_list_all_systems_page');
    add_menu_page('Add New Fix', 'Add New Fix', 'manage_options', 'add-new-fix', 'qkn_guru_add_new_fix_page');
    add_submenu_page('add-new-fix', 'List All Fixes', 'List All Fixes', 'manage_options', 'list-all-fixes', 'qkn_guru_list_all_fixes_page');
}
add_action('admin_menu', 'qkn_guru_include_custom_pages');

// Include functions for custom pages
require_once plugin_dir_path(__FILE__) . 'includes/add-new-system.php';
require_once plugin_dir_path(__FILE__) . 'includes/list-all-systems.php';
require_once plugin_dir_path(__FILE__) . 'includes/add-new-fix.php';
require_once plugin_dir_path(__FILE__) . 'includes/list-all-fixes.php';

// Functions for custom pages
function qkn_guru_add_new_system_page() {
    include plugin_dir_path(__FILE__) . 'includes/add-new-system.php';
}

function qkn_guru_list_all_systems_page() {
    include plugin_dir_path(__FILE__) . 'includes/list-all-systems.php';
}

function qkn_guru_add_new_fix_page() {
    include plugin_dir_path(__FILE__) . 'includes/add-new-fix.php';
}

function qkn_guru_list_all_fixes_page() {
    include plugin_dir_path(__FILE__) . 'includes/list-all-fixes.php';
}
