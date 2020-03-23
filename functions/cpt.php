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
            'menu_position' => 1,
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
            'menu_position' => 2,
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
            'menu_position' => 3,
            'menu_icon' => 'dashicons-welcome-learn-more',
            'rewrite' => ['slug' => 'worker'],
            'taxonomies' => array('post_tag')
        ]);

        register_post_type('forum', [
            'label' => 'les sujets du forum',
            'labels' => [
                'singular-name' => 'sujet du forum',
                'add_new_item' => 'ajouter un nouveau sujet'
            ],
            'description' => 'Tous les sujets',
            'public' => true,
            'menu_position' => 4,
            'menu_icon' => 'dashicons-admin-comments',
            'rewrite' => ['slug' => 'forum'],
            'taxonomies' => array('post_tag'),
            // 'support' => array(
            //     'comments'
            // )
        ]);

        register_post_type('mdn', [
            'label' => 'MDN',
            'labels' => [
                'singular-name' => 'MDN',
                'add_new_item' => 'Ajouter un mot/concept'
            ],
            'description' => 'Tous les mots/concepts',
            'public' => true,
            'menu_position' => 5,
            'menu_icon' => 'dashicons-admin-post',
            'rewrite' => ['slug' => 'mdn']
        ]);

        register_post_type('tutos', [
            'label' => 'Tutos',
            'labels' => [
                'singular-name' => 'Tuto',
                'add_new_item' => 'Ajouter un tutoriel'
            ],
            'description' => 'Tous les tutoriels',
            'public' => true,
            'menu_position' => 6,
            'menu_icon' => 'dashicons-admin-customizer',
            'rewrite' => ['slug' => 'tutos'],
            'taxonomies' => array('post_tag')
        ]);
    }

    add_action('init', 'webartisan_register_custom_post_type');

