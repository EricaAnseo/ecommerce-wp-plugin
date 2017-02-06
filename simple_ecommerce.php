<?php
/*
	Plugin Name: Simplified Ecommerce 
	Plugin URI: http://ericachai.ie/
	Description: A plugin to add multiple products to your store.
	Version: 1.0.1
	Author: Erica Chai
	Author URI: http://ericachai.ie/
*/
/**
 * Comment above is used by WordPress to define the plugin. 
 */

// 5/2/2017 - Used for referring to the plugin file or basename
if ( ! defined( 'SIMPLIFIED_ECOMMERCE_FILE' ) ) {
	define( 'SIMPLIFIED_ECOMMERCE_FILE', plugin_basename( __FILE__ ) );
}

// 6/2/2017 - Used to test new features.  
require_once plugin_dir_path( __FILE__ ) . 'includes/test.php';
require_once( plugin_dir_path( __FILE__ ) . 'includes/shop_filter_widget.php' );
require_once( plugin_dir_path( __FILE__ ) . 'includes/shortcode_master.php' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-now-hiring-activator.php
 */
function simp_ec_activate_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/plugin-activator.php';
	// Simp_Ec_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-now-hiring-deactivator.php
 */
function simp_ec_deactivate_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/plugin-deactivator.php';
	//Simp_Ec_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'simp_ec_activate_plugin' );
register_deactivation_hook( __FILE__, 'simp_ec_deactivate_plugin' );









