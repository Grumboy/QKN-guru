<?php
/**
 * Plugin Name: QKN Guru
 * Description: Custom plugin to manage systems and fixes.
 * Version: 1.0
 * Author: Jens Bellander
 */

// Include necessary files
require_once plugin_dir_path(__FILE__) . 'includes/custom-post-types.php';
require_once plugin_dir_path(__FILE__) . 'includes/custom-taxonomies.php';
require_once plugin_dir_path(__FILE__) . 'includes/add-new-system.php';
require_once plugin_dir_path(__FILE__) . 'includes/add-new-fix.php';
require_once plugin_dir_path(__FILE__) . 'includes/list-all-systems.php';
require_once plugin_dir_path(__FILE__) . 'includes/list-all-fixes.php';

// Enqueue styles and scripts
function qkn_guru_enqueue_assets() {
    wp_enqueue_style('qkn-guru-styles', plugin_dir_url(__FILE__) . 'css/styles.css');
    wp_enqueue_script('qkn-guru-scripts', plugin_dir_url(__FILE__) . 'js/scripts.js', array('jquery'), null, true);
}
add_action('admin_enqueue_scripts', 'qkn_guru_enqueue_assets');

// Add admin menus
add_action('admin_menu', 'qkn_guru_admin_menu');

function qkn_guru_admin_menu() {
    add_menu_page('Add New System', 'Add New System', 'manage_options', 'add-new-system', 'qkn_add_new_system_page', 'dashicons-admin-tools', 6);
    add_submenu_page('add-new-system', 'List All Systems', 'List All Systems', 'manage_options', 'list-all-systems', 'qkn_list_all_systems_page');
    add_menu_page('Add New Fix', 'Add New Fix', 'manage_options', 'add-new-fix', 'qkn_add_new_fix_page', 'dashicons-hammer', 7);
    add_submenu_page('add-new-fix', 'List All Fixes', 'List All Fixes', 'manage_options', 'list-all-fixes', 'qkn_list_all_fixes_page');
}
