<?php

    function webartisan_register_custom_post_type(){
        register_post_type('actualities', [
            'label' => 'actualités',
            'labels' => [
                'singular-name' => 'actualité',
                'add_new_item' => 'ajouter une nouvelle actualité'
            ],
            'description' => 'All the actualities from la cité école vivante',
            'public' => true,
            'menu_position' => 5,
            'menu_icon' => 'dashicons-welcome-write-blog',
            'rewrite' => ['slug' => 'actualities'],
            'taxonomies' => array('post_tag')
        ]);
    }

    add_action('init', 'webartisan_register_custom_post_type');


?>