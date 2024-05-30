<?php
/**
 * Plugin Name: QKN Guru
 * Description: Custom plugin to manage systems and fixes.
 * Version: 1.0
 * Author: Your Name
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// Include custom post types and taxonomies
require_once plugin_dir_path( __FILE__ ) . 'includes/custom-post-types.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/custom-taxonomies.php';

// Shortcodes for custom pages
require_once plugin_dir_path( __FILE__ ) . 'includes/add-new-system.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/add-new-fix.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/list-all-systems.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/list-all-fixes.php';

// Enqueue scripts and styles
function qkn_guru_enqueue_scripts() {
    wp_enqueue_style( 'qkn-guru-styles', plugin_dir_url( __FILE__ ) . 'css/styles.css' );
    wp_enqueue_script( 'qkn-guru-scripts', plugin_dir_url( __FILE__ ) . 'js/scripts.js', array('jquery'), null, true );
}
add_action( 'wp_enqueue_scripts', 'qkn_guru_enqueue_scripts' );
