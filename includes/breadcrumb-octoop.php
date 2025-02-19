<?php

if (!defined('ABSPATH')) {
    exit;
}

class Breadcrumb_Octoop {

    public function __construct() {
        add_filter('term_link', array($this, 'custom_category_permalink'), 10, 3);
        add_shortcode('blog_breadcrumb', array($this, 'blog_breadcrumb_shortcode'));
    }

    // 📌 Appliquer "/blog/" uniquement aux catégories d'articles
    public function custom_category_permalink($termlink, $term, $taxonomy) {
        if ($taxonomy === 'category') {
            $termlink = home_url('/blog/' . $term->slug . '/');
        }
        return $termlink;
    }
    public function blog_breadcrumb() {
        ob_start();
        $current_lang = function_exists('pll_current_language') ? pll_current_language() : 'fr';
        $home_label = ($current_lang === 'en') ? 'Home' : 'Accueil';
        echo '<nav class="breadcrumb">';
        if (!is_home()) {
            echo '<a href="' . home_url() . '">' . esc_html($home_label) . '</a> &raquo; ';
            if (is_singular('post')) {
                echo '<a href="' . home_url('/blog/') . '">Blog</a> &raquo; ';
                $category = get_the_category();
                if (!empty($category)) {
                    $first_category = $category[0];
                    echo '<a href="' . get_category_link($first_category->term_id) . '">' . $first_category->name . '</a> &raquo; ';
                }
                echo '<span>' . get_the_title() . '</span>';
            } elseif (is_category()) {
                echo '<a href="' . home_url('/blog/') . '">Blog</a> &raquo; ';
                echo '<span>' . single_cat_title('', false) . '</span>';
            } elseif (is_singular('fonctionnalites')) {
                $terms = get_the_terms(get_the_ID(), 'fonctionnalites_category');
                if (!empty($terms) && !is_wp_error($terms)) {
                    $first_term = array_shift($terms);
                    $category_slug = $first_term->slug;
                    $category_name = $first_term->name;
                    $category_pages = [
                        'web' => '/fonctionnalites/web/',
                        'social' => '/fonctionnalites/social/',
                        'e-reputation' => '/fonctionnalites/e-reputation/'
                    ];
                    if (array_key_exists($category_slug, $category_pages)) {
                        echo '<a href="' . home_url($category_pages[$category_slug]) . '">' . $category_name . '</a> &raquo; ';
                    }
                }
                echo '<span>' . get_the_title() . '</span>';
            } elseif (is_page(['web', 'social', 'e-reputation'])) {
                echo '<span>' . get_the_title() . '</span>';
            } elseif (is_page()) {
                echo '<span>' . get_the_title() . '</span>';
            } elseif (is_archive()) {
                echo '<a href="' . home_url('/blog/') . '">Blog</a> &raquo; ';
                echo '<span>' . post_type_archive_title('', false) . '</span>';
            } elseif (is_search()) {
                echo '<span>' . __('Search results for', 'textdomain') . ' "' . get_search_query() . '"</span>';
            } elseif (is_404()) {
                echo '<span>' . __('Error 404', 'textdomain') . '</span>';
            }
        }
        echo '</nav>';
        return ob_get_clean();
    }

    public function blog_breadcrumb_shortcode() {
        return $this->blog_breadcrumb();
    }
}

new Breadcrumb_Octoop();
