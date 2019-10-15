<?php

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

?>