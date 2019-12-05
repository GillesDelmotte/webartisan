<?php

function webartisan_add_taxonomies() {
    register_taxonomy(
        'categorymdn',
        'mdn',
        array(
            'label'                 => 'Catégorie',
            'sort'                  => true,
            'show_ui'               => true,
            'show_admin_column'     => true,
            'hierarchical'          => true,
            'query_var'             => true,
            'rewrite'               => array( 'slug' => 'mdn' )
        )
    );

};
add_action( 'init', 'webartisan_add_taxonomies', 0 );