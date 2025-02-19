<?php

if (!defined('ABSPATH')) {
    exit;
}

class CPT_Fonctionnalites {
    
    public function __construct() {
        add_action('init', array($this, 'register_cpt_fonctionnalites'));
        add_action('init', array($this, 'register_taxonomy_fonctionnalites'));
        add_action('init', array($this, 'add_elementor_support'));
        add_action('init', array($this, 'add_seopress_support'));
    }

    public function register_cpt_fonctionnalites() {
        $labels = array(
            'name'               => 'Fonctionnalités',
            'singular_name'      => 'Fonctionnalité',
            'menu_name'          => 'Fonctionnalités',
            'name_admin_bar'     => 'Fonctionnalité',
            'add_new'            => 'Ajouter une fonctionnalité',
            'add_new_item'       => 'Ajouter une fonctionnalité',
            'new_item'           => 'Nouvelle fonctionnalité',
            'edit_item'          => 'Modifier la fonctionnalité',
            'view_item'          => 'Voir la fonctionnalité',
            'all_items'          => 'Toutes les fonctionnalités',
            'search_items'       => 'Rechercher une fonctionnalité',
            'not_found'          => 'Aucune fonctionnalité trouvée.',
            'not_found_in_trash' => 'Aucune fonctionnalité trouvée dans la corbeille.',
        );

        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'has_archive'        => true,
            'show_in_menu'       => true,
            'menu_icon'          => 'dashicons-lightbulb',
            'supports'           => array('title', 'editor', 'thumbnail'),
            'taxonomies'         => array('fonctionnalites_category'), 
            'show_in_rest'       => true,
        );

        register_post_type('fonctionnalites', $args);
    }

    public function register_taxonomy_fonctionnalites() {
        $labels = array(
            'name'              => 'Catégories de Fonctionnalités',
            'singular_name'     => 'Catégorie de Fonctionnalité',
            'search_items'      => 'Rechercher une catégorie',
            'all_items'         => 'Toutes les catégories',
            'parent_item'       => 'Catégorie parente',
            'parent_item_colon' => 'Catégorie parente :',
            'edit_item'         => 'Modifier la catégorie',
            'update_item'       => 'Mettre à jour la catégorie',
            'add_new_item'      => 'Ajouter une nouvelle catégorie',
            'new_item_name'     => 'Nom de la nouvelle catégorie',
            'menu_name'         => 'Catégories'
        );

        $args = array(
            'labels'            => $labels,
            'hierarchical'      => true, 
            'public'            => true,
            'show_admin_column' => true,
            'show_in_rest'      => false, 
        );

        register_taxonomy('fonctionnalites_category', array('fonctionnalites'), $args);
    }

    public function add_elementor_support() {
        add_post_type_support('fonctionnalites', 'elementor');
    }
    public function add_seopress_support() {
        add_post_type_support('fonctionnalites', 'seopress_analysis');
    }
}

new CPT_Fonctionnalites();
