<?php 

function tags_filter($query){

    if(isset($_GET['tags'])){
        $query->set('tax_query', array(
            array(
                'taxonomy' => 'post_tag',
                'field' => 'slug',
                'terms' => $_GET['tags']
            )
        ));
    }
    return $query;
}

add_action('pre_get_posts', 'tags_filter');