<?php 
/**
 * @since 		1.0.0
 * @package		Simplified_Ecommerce
**/

function simp_ec_options_page() 
{
	//including the files which has the function 
	include_once(plugin_dir_path( __FILE__ ) . '/sub_menu_functions/sub_add_category.php');
	include_once(plugin_dir_path( __FILE__ ) . '/sub_menu_functions/sub_add_attribute.php');
	include_once(plugin_dir_path( __FILE__ ) . '/sub_menu_functions/sub_add_product.php');
	include_once(plugin_dir_path( __FILE__ ) . '/sub_menu_functions/sub_add_product_type.php');
	include_once(plugin_dir_path( __FILE__ ) . '/sub_menu_functions/sub_view_product.php');

	//Name of the parent menu item
	$parent_page = "simplified-ecommerce";

	//Format for add_menu_page
	//Page Title, Menu Title, Capability as user can view the menu, menu_slug, function to be called, icon of the menu item, the position of the menu item 

    add_menu_page(
		'Simplified Ecommerce',
		'Simplified Ecommerce',
		'manage_options',
		$parent_page, 
    	'simp_ec_view_products_page_html',
    	'dashicons-carrot',
    	20
	);

	 add_menu_page(
		'Simplified Ecommerce Attributes',
		'Attribute',
		'manage_options',
		'simplified-ecommerce-attributes', 
    	'simp_ec_add_attribute_page_html',
    	'dashicons-carrot',
    	20
	);

	//Format for add_submenu_page
	//Parent Slug, Page Title, Menu Title, Capability as user can view the menu, menu_slug, function to be called 

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

	add_submenu_page( 
		$parent_page, 
		'Add Product Type', 
		'Add Product Type', 
		'manage_options', 
		'add_ptype_sub', 
		'simp_ec_product_types_page_html'
	);
}

add_action('admin_menu', 'simp_ec_options_page');



