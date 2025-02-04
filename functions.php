<?php
/**
 * Theme functions and definitions
 *
 * @package HelloElementorChild
 */

/**
 * Load child theme css and optional scripts
 *
 * @return void
 */
function hello_elementor_child_enqueue_scripts() {
    wp_enqueue_style(
        'hello-elementor-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        ['hello-elementor-theme-style'],
        '1.0.0'
    );

    wp_enqueue_script('hello-elementor-theme-script', get_stylesheet_directory_uri() . '/script.js', ['jquery'], '1.0.0', true);

    if (is_page('fonctionnalites')) {
        wp_enqueue_script('fonctionnalites-script', get_stylesheet_directory_uri() . '/assets/js//fonctionnalites.js', ['jquery'], '1.0.0', true);
    }
    if (is_page('tarifs')) {
        wp_enqueue_script('tarifs-script', get_stylesheet_directory_uri() . '/assets/js/tarifs.js', ['jquery'], '1.0.0', true);
    }
}
add_action('wp_enqueue_scripts', 'hello_elementor_child_enqueue_scripts', 20);

require_once get_stylesheet_directory() . '/includes/cpt-fonctionnalites.php';
require_once get_stylesheet_directory() . '/includes/breadcrumb-octoop.php';