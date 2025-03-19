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

    if (is_page('social') || is_page('web') || is_page('e-reputation') || is_page('web-en') || is_page('e-reputation-en') || is_page('social-en')) {
        wp_enqueue_script('fonctionnalites-script', get_stylesheet_directory_uri() . '/assets/js/fonctionnalites.js', ['jquery'], '1.0.0', true);
    }
    if (is_page('tarifs') || is_page('pricing')) {
        wp_enqueue_script('tarifs-script', get_stylesheet_directory_uri() . '/assets/js/tarifs.js', ['jquery'], '1.0.0', true);
    }
}
add_action('wp_enqueue_scripts', 'hello_elementor_child_enqueue_scripts', 20);

require_once get_stylesheet_directory() . '/includes/cpt-fonctionnalites.php';
require_once get_stylesheet_directory() . '/includes/breadcrumb-octoop.php';

// Query spéciale pour le widget "Publications" sur la page EN
// Correction : Prendre en compte la pagination
function filter_english_posts( $query ) {
    if ( isset( $query->query_vars['post_type'] ) && $query->query_vars['post_type'] === 'post' ) {
        if ( function_exists( 'pll_get_term' ) ) {
            $query->set('tax_query', array(
                array(
                    'taxonomy' => 'language',
                    'field'    => 'slug',
                    'terms'    => 'en'
                ),
            ));
        }
        // ✅ Ajout du paramètre paged pour que la pagination fonctionne
        if ( get_query_var('paged') ) {
            $query->set('paged', get_query_var('paged'));
        }
    }
}
add_action( 'elementor/query/english_posts', 'filter_english_posts' );







