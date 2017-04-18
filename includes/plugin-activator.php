<?php 
/**
 * @since 		1.0.0
 * @package		Simplified_Ecommerce
**/

function simp_ec_update_db_check() {
    global $simp_ec_db_version;
    if ( get_site_option( 'simp_ec_db_version' ) != $simp_ec_db_version ) 
    {
		simp_ec_db_install();  
		update_option( 'simp_ec_db_version', $simp_ec_db_version );
	}
}
add_action( 'plugins_loaded', 'simp_ec_update_db_check' );

//register_activation_hook( __FILE__, 'simp_ec_db_install' );

function simp_ec_update_database_table() {
	global $wpdb;
	
}

function simp_ec_db_install() {

	include_once (SIMPLIFIED_ECOMMERCE_ROOT_PATH . 'includes/table_names.php');
	require_once (ABSPATH . 'wp-admin/includes/upgrade.php');

	global $simp_ec_db_version;
	$simp_ec_db_version = '1.01';

	include_once (SIMPLIFIED_ECOMMERCE_ROOT_PATH . 'includes/tables/simp_ec_table_test.php');
	include_once (SIMPLIFIED_ECOMMERCE_ROOT_PATH . 'includes/tables/simp_ec_table_product_attribute.php');
	include_once (SIMPLIFIED_ECOMMERCE_ROOT_PATH . 'includes/tables/simp_ec_table_product_type.php');
	include_once (SIMPLIFIED_ECOMMERCE_ROOT_PATH . 'includes/tables/simp_ec_table_product_attribute_types.php');
	include_once (SIMPLIFIED_ECOMMERCE_ROOT_PATH . 'includes/tables/simp_ec_table_product_category.php');
	include_once (SIMPLIFIED_ECOMMERCE_ROOT_PATH . 'includes/tables/simp_ec_table_product.php');
	include_once (SIMPLIFIED_ECOMMERCE_ROOT_PATH . 'includes/tables/simp_ec_table_product_category_type.php');
	include_once (SIMPLIFIED_ECOMMERCE_ROOT_PATH . 'includes/tables/simp_ec_table_product_categories.php');
	include_once (SIMPLIFIED_ECOMMERCE_ROOT_PATH . 'includes/tables/simp_ec_table_variable_product.php');
	include_once (SIMPLIFIED_ECOMMERCE_ROOT_PATH . 'includes/tables/simp_ec_table_customer.php');
	include_once (SIMPLIFIED_ECOMMERCE_ROOT_PATH . 'includes/tables/simp_ec_table_order.php');
	include_once (SIMPLIFIED_ECOMMERCE_ROOT_PATH . 'includes/tables/simp_ec_table_options.php');

	//Used to check errors.
	//echo $wpdb->show_errors();
	//$wpdb->print_error();  

	//Storing the version of the db table
	add_option( 'simp_ec_db_version', $simp_ec_db_version );
	

}




//register_activation_hook( __FILE__, 'simp_ec_install_data' );

function simp_ec_install_data() {
	include_once (SIMPLIFIED_ECOMMERCE_ROOT_PATH . 'includes/table_names.php');

	global $wpdb;

	$table_name = $wpdb->prefix . "test";
	
	$welcome_name = 'Mr. WordPress';
	$welcome_text = 'Congratulations, you just completed the installation!';


	if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {

		$wpdb->insert($table_name, array( 
				'time' => current_time( 'mysql' ), 
				'name' => $welcome_name, 
				'text' => $welcome_text), null   
		);
	}

	/*
	include_once (SIMPLIFIED_ECOMMERCE_ROOT_PATH . 'includes/tables/insert_product_attributes.php');
	include_once (SIMPLIFIED_ECOMMERCE_ROOT_PATH . 'includes/tables/insert_product_types.php');
	include_once (SIMPLIFIED_ECOMMERCE_ROOT_PATH . 'includes/tables/insert_product_attributes_types.php');
	include_once (SIMPLIFIED_ECOMMERCE_ROOT_PATH . 'includes/tables/insert_product_category.php');
	include_once (SIMPLIFIED_ECOMMERCE_ROOT_PATH . 'includes/tables/insert_products.php');
	include_once (SIMPLIFIED_ECOMMERCE_ROOT_PATH . 'includes/tables/insert_product_categories.php');
	include_once (SIMPLIFIED_ECOMMERCE_ROOT_PATH . 'includes/tables/insert_product_category_type.php');
	include_once (SIMPLIFIED_ECOMMERCE_ROOT_PATH . 'includes/tables/insert_product_variable.php');
	include_once (SIMPLIFIED_ECOMMERCE_ROOT_PATH . 'includes/tables/insert_customer.php');
	include_once (SIMPLIFIED_ECOMMERCE_ROOT_PATH . 'includes/tables/insert_order.php');*/
}



?>