<?php 
/**
 * @since 		1.0.0
 * @package		Simplified_Ecommerce
 * 
 * This file will call all of the shortcodes. 
*/

	//test shortcode
	require_once( plugin_dir_path( __FILE__ ) . 'simp_ec_shortcodes/call_from_db.php' );

	//This file contains all of the shortcodes for products. 
	require_once( plugin_dir_path( __FILE__ ) . 'simp_ec_shortcodes/shortcode_products.php' );

	//This file contains all of the shortcodes for products. 
	require_once( plugin_dir_path( __FILE__ ) . 'simp_ec_shortcodes/shortcode_category.php' );

	//This file contains all of the shortcodes for products. 
	require_once( plugin_dir_path( __FILE__ ) . 'simp_ec_shortcodes/shortcode_variable_products.php' );



?>