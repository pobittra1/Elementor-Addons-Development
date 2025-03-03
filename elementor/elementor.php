<?php

/**
 * Plugin Name: Elementor oEmbed Widget
 * Description: Auto embed any embbedable content from external URLs into Elementor.
 * Plugin URI:  https://elementor.com/
 * Version:     1.0.0
 * Author:      Elementor Developer
 * Author URI:  https://developers.elementor.com/
 * Text Domain: elementor-oembed-widget
 *
 * Requires Plugins: elementor
 * Elementor tested up to: 3.25.0
 * Elementor Pro tested up to: 3.25.0
 */

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

function register_service_widget($widgets_manager)
{

    require_once(__DIR__ . '/widgets/serviceCard.php');

    $widgets_manager->register(new \Elementor_service_Widget());
}
add_action('elementor/widgets/register', 'register_service_widget');
