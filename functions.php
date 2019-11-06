<?php


require_once 'functions/cpt.php';
require_once 'functions/thumb.php';
require_once 'functions/paginate.php';


function assets($path)
{
	return get_template_directory_uri() . '/' . trim($path, '/');
};

if (function_exists('acf_add_options_page')) {

	acf_add_options_page();
}

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

	$info = array();
	$info['user_login'] = $_POST['name'];
	$info['user_password'] = $_POST['password'];
	$info['remember'] = true;

	$user_signon = wp_signon($info, false);


	if (!is_wp_error($user_signon)) {
		wp_redirect(home_url());
		exit;
	} else {
		wp_redirect(home_url('/connexion-inscription'));
		exit;
	}
}

add_action('admin_post_post_login', 'post_login');
add_action('admin_post_nopriv_post_login', 'post_login');


function post_newOffer()
{

	if (!is_user_logged_in()) {
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
