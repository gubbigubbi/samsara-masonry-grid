<?php
/*
--------------------------
Functions of Child Theme
--------------------------
*/

/* Define Child Theme directory */
define('child_theme_uri', dirname( get_bloginfo('stylesheet_url')) );

/* Load New Javascript file in Child Theme */
add_action('wp_enqueue_scripts', 'samsara_child_script');
function samsara_child_script(){
  wp_register_script( 'samsara_child', child_theme_uri . '/js/samsara_child.js', null, null, true );
  wp_enqueue_script( 'samsara_child' );
  
}

/**
 * Dequeue the Parent Theme scripts.
 *
 * Hooked to the wp_print_scripts action, with a late priority (100),
 * so that it is after the script was enqueued.
 */
function my_site_WI_dequeue_script() {
 wp_dequeue_script( 'van_portfolios_js' ); //Deregister van portfolios script - added into child theme js
}
 
add_action( 'wp_enqueue_scripts', 'my_site_WI_dequeue_script', 100 );

/* 
Example: Modify and override the php function of parent theme
Let's change the default menu for child theme.
*/

add_filter('van_default_menu', 'child_default_menu');
if( !function_exists( 'child_default_menu') ){
	function child_default_menu() {
		$default_menu= '<ul>'.PHP_EOL;
		$default_menu.= '<li><a href="' . get_home_url() . '">Home</a></li>'.PHP_EOL;
		$pages = get_pages('number=3&sort_column=menu_order&sort_order=ASC');
		$count = count($pages);
		for($i = 0; $i < $count; $i++)
		{
			$default_menu.= '<li><a href="' . get_home_url() . '/' . $pages[$i]->post_name . '">' . $pages[$i]->post_title . '</a></li>' . PHP_EOL;
		}
		$default_menu.= '</ul>'.PHP_EOL;
		echo $default_menu;
	}
}
?>