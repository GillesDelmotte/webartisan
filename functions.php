<?php

function assets($path){
    return get_template_directory_uri() . '/' . trim($path, '/');
};

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page();
	
}

function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

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


add_image_size('thumb_1184x500', 1184, 500, true);
add_image_size('thumb_690x300', 690, 300, array( 'left', 'top' ));



if( !function_exists( 'theme_pagination' ) ) {
	
    function theme_pagination() {
	
	global $wp_query, $wp_rewrite;
	$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
	
	$pagination = array(
		'base' => @add_query_arg('page','%#%'),
		'format' => '',
		'total' => $wp_query->max_num_pages,
		'current' => $current,
	        'show_all' => false,
	        'end_size'     => 1,
	        'mid_size'     => 2,
		'type' => 'list',
		'next_text' => '»',
		'prev_text' => '«'
	);
	
	if( $wp_rewrite->using_permalinks() )
		$pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );
	
	if( !empty($wp_query->query_vars['s']) )
		$pagination['add_args'] = array( 's' => str_replace( ' ' , '+', get_query_var( 's' ) ) );
		
	echo str_replace('page/1/','', paginate_links( $pagination ) );
    }	
}
