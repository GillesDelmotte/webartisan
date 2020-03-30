<?php 

function tags_filter($query){

    if( 'nav_menu_item' !== $query->get('post_type') && !empty($_GET['tags']) ){
        $query->set('tax_query', array(
            array(
                'taxonomy' => 'post_tag',
                'field' => 'slug',
                'terms' => $_GET['tags']
            )
        ));
        return $query;

    }
    return $query;
}

add_action('pre_get_posts', 'tags_filter');