<?php

    function webartisan_register_custom_post_type(){
        register_post_type('actualities', [
            'label' => 'actualités',
            'labels' => [
                'singular-name' => 'actualité',
                'add_new_item' => 'ajouter une nouvelle actualité'
            ],
            'description' => 'Toutes les actus de webartisan',
            'public' => true,
            'menu_position' => 5,
            'menu_icon' => 'dashicons-welcome-write-blog',
            'rewrite' => ['slug' => 'actualities'],
            'taxonomies' => array('post_tag')
        ]);

        register_post_type('jobs', [
            'label' => 'offres d‘emplois',
            'labels' => [
                'singular-name' => 'offre d‘emploi',
                'add_new_item' => 'ajouter une nouvelle offre'
            ],
            'description' => 'Toutes les offres d‘emplois de webartian',
            'public' => true,
            'menu_position' => 5,
            'menu_icon' => 'dashicons-businessman',
            'rewrite' => ['slug' => 'jobs'],
            'taxonomies' => array('post_tag')
        ]);

        register_post_type('worker', [
            'label' => 'les métiers du web',
            'labels' => [
                'singular-name' => 'métier du web',
                'add_new_item' => 'ajouter un nouveau métier'
            ],
            'description' => 'Tous les métiers',
            'public' => true,
            'menu_position' => 5,
            'menu_icon' => 'dashicons-welcome-learn-more',
            'rewrite' => ['slug' => 'worker'],
            'taxonomies' => array('post_tag')
        ]);
    }

    add_action('init', 'webartisan_register_custom_post_type');


?>