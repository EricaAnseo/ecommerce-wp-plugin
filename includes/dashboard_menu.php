<?php 
/**
 * @since 		1.0.0
 * @package		Simplified_Ecommerce
**/

function simp_ec_options_page() 
{
	//including the files which has the function 
	include_once(plugin_dir_path( __FILE__ ) . '/sub_menu_functions/sub_manage_product.php');
	include_once(plugin_dir_path( __FILE__ ) . '/sub_menu_functions/sub_add_product.php');	
	include_once(plugin_dir_path( __FILE__ ) . '/sub_menu_functions/sub_add_multi_products.php');
	include_once(plugin_dir_path( __FILE__ ) . '/sub_menu_functions/sub_add_multi_products_list.php');
	include_once(plugin_dir_path( __FILE__ ) . '/sub_menu_functions/sub_manage_variable_products.php');
	include_once(plugin_dir_path( __FILE__ ) . '/sub_menu_functions/sub_manage_category.php');
	include_once(plugin_dir_path( __FILE__ ) . '/sub_menu_functions/sub_manage_attribute.php');
	include_once(plugin_dir_path( __FILE__ ) . '/sub_menu_functions/sub_manage_product_type.php');

	//Name of the parent menu item
	$parent_page = "simplified-ecommerce"; 

	//Format for add_menu_page
	//Page Title, Menu Title, Capability as user can view the menu, menu_slug, function to be called, icon of the menu item, the position of the menu item 

    add_menu_page(
		'Simplified Ecommerce',
		'Simplified Ecommerce',
		'manage_options',
		$parent_page, 
    	'simp_ec_manage_products_page_html',
    	'dashicons-products',
    	20
	);

	//Format for add_submenu_page
	//Parent Slug, Page Title, Menu Title, Capability as user can view the menu, menu_slug, function to be called 

	//add_dashboard_page( $page_title, $menu_title, $capability, $menu_slug, $function);

	add_submenu_page( 
		$parent_page, 
		'Add Products', 
		'Product', 
		'manage_options', 
		'add_product_sub', 
		'simp_ec_products_page_html' 
	);

	add_submenu_page( 
		$parent_page, 
		'Add Products', 
		'Multiple Products', 
		'manage_options', 
		'add_multi_product_sub', 
		'simp_ec_add_multi_products_html' 
	);

	add_submenu_page( 
		$parent_page, 
		'Variable Product', 
		'Variable Products', 
		'manage_options', 
		'add_variable_product_sub', 
		'simp_ec_add_variable_products_html' 
	);

	add_submenu_page( 
		$parent_page, 
		'Add Category', 
		'Category', 
		'manage_options', 
		'add_category_sub', 
		'simp_ec_manage_category_page_html'
	);

	add_submenu_page( 
		$parent_page, 
		'Add Attributes', 
		'Attributes', 
		'manage_options', 
		'add_attribute_sub', 
		'simp_ec_manage_attribute_page_html'
	);

	add_submenu_page( 
		$parent_page, 
		'Add Product Type', 
		'Product Type', 
		'manage_options', 
		'add_ptype_sub', 
		'simp_ec_manage_product_types_page_html'
	);
}

add_action('admin_menu', 'simp_ec_options_page');


