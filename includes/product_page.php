<?php 
/**
 * @since 		1.0.0
 * @package		Simplified_Ecommerce
**/

//require_once('../../../wp-load.php');

function simp_ec_options_page()
{
	include_once(plugin_dir_path( __FILE__ ) . '/sub_menu_functions/sub_add_category.php');
	include_once(plugin_dir_path( __FILE__ ) . '/sub_menu_functions/sub_add_product.php');
	include_once(plugin_dir_path( __FILE__ ) . '/sub_menu_functions/sub_view_product.php');
	$parent_page = "simplified-ecommerce";

    add_menu_page(
		'Simplified Ecommerce',
		'Simplified Ecommerce',
		'manage_options',
		'simplified-ecommerce', 
    	'simp_ec_view_products_page_html',
    	'dashicons-carrot',
    	20
	);

	 add_menu_page(
		'Simplified Ecommerce Attributes',
		'Attribute',
		'manage_options',
		'simplified-ecommerce-attributes', 
    	'simp_ec_view_products_page_html',
    	'dashicons-carrot',
    	20
	);

	add_submenu_page( 
		$parent_page, 
		'Add Products', 
		'Add Products', 
		'manage_options', 
		'add_product_sub', 
		'simp_ec_products_page_html' 
	);

	add_submenu_page( 
		$parent_page, 
		'Add Category', 
		'Add Category', 
		'manage_options', 
		'add_category_sub', 
		'simp_ec_add_category_page_html'
	);
}

add_action('admin_menu', 'simp_ec_options_page');



function simp_ec_view_product_attribute_page_html()
{

}



