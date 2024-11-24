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
function qkn_guru_enqueue_assets($hook_suffix) {
    // Only load assets on our plugin's pages
    if (strpos($hook_suffix, 'qkn') !== false) {
        // Enqueue DataTables CSS
        wp_enqueue_style('qkn-guru-datatables-styles', 'https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css');
        // Enqueue custom styles
        wp_enqueue_style('qkn-guru-styles', plugin_dir_url(__FILE__) . 'css/styles.css');
        // Enqueue DataTables JS
        wp_enqueue_script('qkn-guru-datatables', 'https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js', array('jquery'), null, true);
        // Enqueue custom scripts
        wp_enqueue_script('qkn-guru-scripts', plugin_dir_url(__FILE__) . 'js/scripts.js', array('jquery', 'qkn-guru-datatables'), null, true);
    }
}
add_action('admin_enqueue_scripts', 'qkn_guru_enqueue_assets');

// Add admin menus
function qkn_guru_admin_menu() {
    add_menu_page('Systems', 'Systems', 'manage_options', 'qkn-systems', 'qkn_list_all_systems_page', 'dashicons-admin-tools', 6);
    add_submenu_page('qkn-systems', 'Add New System', 'Add New System', 'manage_options', 'add-new-system', 'qkn_add_new_system_page');
    add_menu_page('Fixes', 'Fixes', 'manage_options', 'qkn-fixes', 'qkn_list_all_fixes_page', 'dashicons-hammer', 7);
    add_submenu_page('qkn-fixes', 'Add New Fix', 'Add New Fix', 'manage_options', 'add-new-fix', 'qkn_add_new_fix_page');
}
add_action('admin_menu', 'qkn_guru_admin_menu');
?>