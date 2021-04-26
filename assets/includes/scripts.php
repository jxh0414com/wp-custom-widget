<?php

function load_plugin_scripts()
{
    wp_enqueue_style('metro-style', 'https://cdn.metroui.org.ua/v4/css/metro-all.min.css', array(), '4.0', 'all');
    wp_enqueue_script('metro-js', 'https://cdn.metroui.org.ua/v4.3.2/js/metro.min.js', array(), '4.0', true);
    wp_enqueue_style('style', plugins_url() . '/custom-widgets/assets/css/style.css', array(), '1.0', 'all');
    wp_enqueue_script('js', plugins_url() . '/custom-widgets/assets/js/app.js', array(), '1.0', true);
}
add_action('wp_enqueue_scripts', 'load_plugin_scripts');
