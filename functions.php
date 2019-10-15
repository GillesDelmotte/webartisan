<?php


require_once 'functions/cpt.php';
require_once 'functions/thumb.php';
require_once 'functions/paginate.php';


function assets($path){
    return get_template_directory_uri() . '/' . trim($path, '/');
};

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page();
	
}

