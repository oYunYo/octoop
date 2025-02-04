<?php

if (!defined('ABSPATH')) {
    exit;
}

class Breadcrumb_Octoop {

    public function __construct() {
        add_filter('term_link', array($this, 'custom_category_permalink'), 10, 3);
        add_shortcode('blog_breadcrumb', array($this, 'blog_breadcrumb_shortcode'));
    }

    // Appliquer "/blog/" uniquement aux catégories d'articles
    public function custom_category_permalink($termlink, $term, $taxonomy) {
        if ($taxonomy === 'category') {
            $termlink = home_url('/blog/' . $term->slug . '/');
        }
        return $termlink;
    }

    // Générer le fil d'arianne parce que celui de SEO Press Pro n'est pas fonctionnel après les changements
    public function blog_breadcrumb() {
        ob_start();
        echo '<nav class="breadcrumb">';
        if (!is_home()) {
            echo '<a href="' . home_url() . '">Accueil</a> &raquo; ';
            if (is_single()) {
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
            } elseif (is_page()) {
                echo '<span>' . get_the_title() . '</span>';
            } elseif (is_archive()) {
                echo '<a href="' . home_url('/blog/') . '">Blog</a> &raquo; ';
                echo '<span>' . post_type_archive_title('', false) . '</span>';
            } elseif (is_search()) {
                echo '<span>Résultats de recherche pour "' . get_search_query() . '"</span>';
            } elseif (is_404()) {
                echo '<span>Erreur 404</span>';
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
