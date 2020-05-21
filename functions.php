<?php


require_once 'functions/cpt.php';
require_once 'functions/thumb.php';
require_once 'functions/paginate.php';
require_once 'functions/taxo.php';
require_once 'functions/filters.php';


function assets($path)
{
	return get_template_directory_uri() . '/' . trim($path, '/');
};

if (function_exists('acf_add_options_page')) {

	acf_add_options_page();
}


register_nav_menu('main', 'menu principal');

/* 
 * Customize Menu Item Classes
 * @author Bill Erickson
 * @link http://www.billerickson.net/customize-which-menu-item-is-marked-active/
 *
 * @param array $classes, current menu classes
 * @param object $item, current menu item
 * @param object $args, menu arguments
 * @return array $classes
 */

function be_menu_item_classes($classes, $item, $args)
{
	if ('header' !== $args->theme_location)
		return $classes;
	if ((is_singular('post') || is_category() || is_tag()) && 'Blog' == $item->title)
		$classes[] = 'current-menu-item';

	if ((is_singular('code') || is_tax('code-tag')) && 'Code' == $item->title)
		$classes[] = 'current-menu-item';

	if (is_singular('projects') && 'Case Studies' == $item->title)
		$classes[] = 'current-menu-item';

	return array_unique($classes);
}
add_filter('nav_menu_css_class', 'be_menu_item_classes', 10, 3);


function post_login()
{
	session_start();
	session_destroy();
	session_start();

	$info = array();
	$info['user_login'] = $_POST['name'];
	$info['user_password'] = $_POST['password'];
	$info['remember'] = true;

	$user_signon = wp_signon($info, false);


	if (!is_wp_error($user_signon)) {
		wp_redirect(home_url());
		exit;
	} else {
		$_SESSION['connection_error'] = $user_signon->get_error_message();
		wp_redirect(home_url('/connexion-inscription'));
		exit;
	}
}

add_action('admin_post_post_login', 'post_login');
add_action('admin_post_nopriv_post_login', 'post_login');


function post_register()
{
	session_start();
	session_destroy();
	session_start();
	$username=$_POST['name'];
    $useremail=$_POST['email'];
	$password=$_POST['password'];
	$confirmPassword = $_POST['passwordConfirm'];


	if(empty( $username ) || empty( $useremail ) || empty($password) || empty( $confirmPassword ))
    {
		$_SESSION['field'] = 'Certains champs requis sont manquant';
	} 
	
	if ( 6 > strlen( $username ) )
    {
		$_SESSION['username_length'] = 'Nom d‘utilisateur trop court. 6 caractère sont requis';
		
	}
	
	if ( username_exists( $username ) )
    {
		$_SESSION['username'] = 'Ce nom d‘utilisateur est déjâ pris';
		
	}
	
	if ( !is_email( $useremail ) )
    {
		$_SESSION['email_invalid'] = 'Email invalide';
		
	}
	
	if ( email_exists( $useremail ) )
    {
		$_SESSION['email'] = 'Cet email existe déjâ';
	}
	
	if( $password != $confirmPassword){
		$_SESSION['confirmPassword'] = 'Votre mot de passe et la confirmation sont différents';

	}

	

	if ( empty($_SESSION) ){
		global $username, $useremail;
        $username   =   sanitize_user( $_POST['name'] );
        $useremail  =   sanitize_email( $_POST['email'] );
        $password   =   esc_attr( $_POST['password'] );
        
        $userdata = array(
			'user_login'    =>   $username,
			'user_email'    =>   $useremail,
			'user_nicename' => $username,
			'display_name' => $username,
			'nickname' => $username,
			'user_nicename' => $username,
			'user_pass' => $password,
			'role' => 'subscriber'
            );
		$user = wp_insert_user( $userdata );


		$info = array();
		$info['user_login'] = $username;
		$info['user_password'] = $password;
		$info['remember'] = true;

		$user_signon = wp_signon($info, false);
		
		wp_redirect(home_url());
		exit;

	}else{
		wp_redirect(home_url('/connexion-inscription'));
		exit;
	}

	
	
}

add_action('admin_post_post_register', 'post_register');
add_action('admin_post_nopriv_post_register', 'post_register');


function post_newOffer()
{

	if (!is_user_logged_in()) {
		wp_redirect(home_url('/offres-demplois-stage'));
		exit;
	}

	if(empty($_POST['title']) || empty($_POST['name']) || empty($_POST['tags']) || empty($_POST['type']) || empty($_POST['city']) || empty($_POST['tel']) || empty($_POST['email'])){
		wp_redirect(home_url('/offres-demplois-stage'));
		exit;
	}

	
	$my_post = array(
		'post_type' => 'jobs',
		'post_title' => $_POST['title'],
		'post_status' => 'publish',
	);

	// Insert the post into the database
	$post_id =  wp_insert_post($my_post);

	$tags = explode(",", $_POST['tags']);

	$array = [];

	foreach ($tags as $tag) {
		$array[] = $tag;
	}

	wp_set_post_tags($post_id, $array);

	update_field("offer__name", $_POST['name'], $post_id);
	update_field("offer__type", $_POST['type'], $post_id);
	update_field("offer__location", $_POST['city'], $post_id);
	update_field("offer__phone", $_POST['tel'], $post_id);
	update_field("offer__email", $_POST['email'], $post_id);
	update_field("offer__content", $_POST['desc'], $post_id);


	wp_redirect(home_url('/offres-demplois-stage'));
	exit;
}

add_action('admin_post_post_newOffer', 'post_newOffer');
add_action('admin_post_nopriv_post_newOffer', 'post_newOffer');


function modify_offer()
{
	$post = get_post($_POST['post_id']);

	if(intVal($post->post_author) !== get_current_user_id()){	
		wp_redirect(home_url('/offres-demplois-stage'));
		exit; 
	}

	if(empty($_POST['title']) || empty($_POST['name']) || empty($_POST['tags']) || empty($_POST['type']) || empty($_POST['city']) || empty($_POST['tel']) || empty($_POST['email'])){
		wp_redirect(home_url('/offres-demplois-stage/?id=' . $_POST['post_id'] . '#formulaire'));
		exit;
	}

	$post = get_post( $_POST['post_id'] );

	$post->post_title = $_POST['title'];

	wp_update_post( $post );	

	$tags = explode(",", $_POST['tags']);

	$array = [];

	foreach ($tags as $tag) {
		$array[] = $tag;
	}

	wp_set_post_tags($_POST['post_id'], $array);


	update_field( "offer__name", $_POST['name'], $_POST['post_id'] );
	update_field( "offer__type", $_POST['type'], $_POST['post_id'] );
	update_field( "offer__location", $_POST['city'], $_POST['post_id'] );
	update_field( "offer__phone", $_POST['tel'], $_POST['post_id'] );
	update_field( "offer__email", $_POST['email'], $_POST['post_id'] );
	update_field( "offer__content", $_POST['desc'], $_POST['post_id'] );

	wp_redirect(home_url('/offres-demplois-stage'));
	exit;

}
add_action('admin_post_modify_offer', 'modify_offer');
add_action('admin_post_nopriv_modify_offer', 'modify_offer');

function post_newsletter()
{
	$email = $_POST['email'];
	//update_field('newsletter__rep', $email, 'options');

	$row = array(
		'email' => $email,
	);

	add_row('newsletter__rep', $row, 'options');

	wp_redirect(home_url('/'));
	exit;
}

add_action('admin_post_post_newsletter', 'post_newsletter');
add_action('admin_post_nopriv_post_newsletter', 'post_newsletter');


function post_newArticle()
{

	if (!is_user_logged_in()) {
		wp_redirect(home_url('/forum'));
		exit;
	}

	if(empty($_POST['title']) || empty($_POST['desc']) || empty($_POST['tags']) || empty($_POST['resume'])){
		wp_redirect(home_url('/forum'));
		exit;
	}

	$my_post = array(
		'post_type' => 'forum',
		'post_title' => $_POST['title'],
		'post_content' => $_POST['desc'],
		'post_status' => 'publish',
	);

	// Insert the post into the database
	$post_id =  wp_insert_post($my_post);

	$tags = explode(",", $_POST['tags']);

	$array = [];

	foreach ($tags as $tag) {
		$array[] = $tag;
	}

	wp_set_post_tags($post_id, $array);

	update_field("forum__resume", $_POST['resume'], $post_id);

	wp_redirect(home_url('/forum'));
	exit;
}

add_action('admin_post_post_newArticle', 'post_newArticle');
add_action('admin_post_nopriv_post_newArticle', 'post_newArticle');


function post_newComment()
{
	if (!is_user_logged_in()) {
		wp_redirect(home_url('/'));
		exit;
	}

	if(empty($_POST['comment'])){
		wp_redirect(get_permalink($_POST['id']));
		exit;
	}

	$current_user = wp_get_current_user();

	$comment = array(
		'user_id' => get_current_user_id(),
		'comment_post_ID' => $_POST['id'],
		'comment_content' => $_POST['comment'],
		'comment_author_url' => $current_user->user_email,
		'comment_author' => $current_user->display_name
	);

	wp_insert_comment( $comment );

	// $row = array(
	// 	'comment__author' => get_current_user_id(),
	// 	'comment' => $_POST['comment'],
	// 	'comment__date' => (new \DateTime())->format('m/d/Y')
	// );
	// add_row('comments', $row, $_POST['id']);

	wp_redirect(get_permalink($_POST['id']));
	exit;
};

add_action('admin_post_post_newComment', 'post_newComment');
add_action('admin_post_nopriv_post_newComment', 'post_newComment');

function wa_show_admin_bar()
{
    return false;
}
add_filter( 'show_admin_bar' , 'wa_show_admin_bar' );


function remove_menu(){
	remove_menu_page('edit.php');
};
add_action('admin_menu', 'remove_menu');


function wpse_custom_menu_order( $menu_ord ) {
    if ( !$menu_ord ) return true;

    return array(
        'index.php', // Dashboard
        'separator1', // First separator
		'edit.php?post_type=actualities',
		'edit.php?post_type=jobs',
		'edit.php?post_type=forum',
		'edit.php?post_type=worker',
		'edit.php?post_type=tutos',
		'edit.php?post_type=mdn',
		'separator2',
    );
}
add_filter( 'custom_menu_order', 'wpse_custom_menu_order', 10, 1 );
add_filter( 'menu_order', 'wpse_custom_menu_order', 10, 1 );