<?php
/*
Plugin Name: JxH Custom Widgets
Description: Display most comment post, Custom recent comments, Recent Posts Sidebar Widget, Subscribe Widget
Version: 1.0.0
Author: Juhuang Xue (Simon)
Author URI: jxh0414.com@gmail.com
*/

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Load Script and Style
require_once(plugin_dir_path(__FILE__) . '/assets/includes/scripts.php');
// Load Class
require_once(plugin_dir_path(__FILE__) . '/assets/includes/sidebar-class.php');
require_once(plugin_dir_path(__FILE__) . '/assets/includes/subscribe-class.php');

// Register Widget
function custom_widgets()
{
    register_widget('Sidebar_Widget');
    register_widget('Subscribe_Widget');
}

add_action('widgets_init', 'custom_widgets');
