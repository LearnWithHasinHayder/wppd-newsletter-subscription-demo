<?php
/*
Plugin Name: WP DB Demo
Description: Demo plugin for WordPress DB operations (newsletter subscription with AJAX, admin listing, and custom table).
Version: 1.0
Author: Your Name
*/

if (!defined('ABSPATH'))
    exit;

// Define plugin paths
if (!defined('WPDBDEMO_PATH')) {
    define('WPDBDEMO_PATH', plugin_dir_path(__FILE__));
}
if (!defined('WPDBDEMO_URL')) {
    define('WPDBDEMO_URL', plugin_dir_url(__FILE__));
}

// Include core files
require_once WPDBDEMO_PATH . 'includes/class-wpdbdemo-db.php';
require_once WPDBDEMO_PATH . 'includes/class-wpdbdemo-ajax.php';
require_once WPDBDEMO_PATH . 'includes/class-wpdbdemo-admin.php';
require_once WPDBDEMO_PATH . 'includes/class-wpdbdemo-shortcode.php';

// Activation: create table
register_activation_hook(__FILE__, ['WPDBDemo_DB', 'create_table']);
