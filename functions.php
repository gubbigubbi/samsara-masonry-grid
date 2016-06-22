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
  wp_enqueue_script( 'isotope-latest', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/2.2.2/isotope.pkgd.min.js', null, null, true );  
  //wp_enqueue_script( 'blazy', child_theme_uri . '/js/blazy.min.js', null, null, true );
}

/**
 * Dequeue the Parent Theme scripts.
 *
 * Hooked to the wp_print_scripts action, with a late priority (100),
 * so that it is after the script was enqueued.
 */
function my_site_WI_dequeue_script() {
 wp_dequeue_script( 'van_portfolios_js' ); //Deregister van portfolios script - added into child theme js
 wp_dequeue_script( 'isotope' ); //Deregister van portfolios script - added into child theme js 
}
 
add_action( 'wp_enqueue_scripts', 'my_site_WI_dequeue_script', 100 );

/**
 * Woocommerce Archive Page
 */
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );

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


/**
 * This code should be added to functions.php of your theme
 **/
add_filter('woocommerce_default_catalog_orderby', 'custom_default_catalog_orderby');

function custom_default_catalog_orderby() {
     return 'date'; // Can also use title and price
}

//
function blazyLoaderClasses($i) {
  if ($i > 10) {
	return 'non-isotope';
  } else {
	return 'isotope';
  }
}

// add classes to next and prev filters
add_filter('next_posts_link_attributes', 'posts_link_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_attributes');

function posts_link_attributes() {
    return 'class="van_large_btn"';
}


?>