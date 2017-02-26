<?php
/*
	Plugin Name: Simplified Ecommerce 
	Plugin URI: http://fyp.ericachai.ie/
	Description: A plugin to add multiple products to your store.
	Version: 1.0.1
	Author: Erica Chai
	Author URI: http://ericachai.ie/
	License: GPL2

	Simplified Ecommerce is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 2 of the License, or
	any later version.
	 
	Simplified Ecommerce is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
	GNU General Public License for more details.
	 
	You should have received a copy of the GNU General Public License
	along with Simplified Ecommerce. If not, see https://www.gnu.org/licenses/gpl-2.0.html.

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
	
	simp_ec_setup_post_types();
 
    // clear the permalinks after the post type has been registered
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'simp_ec_activate_plugin' );

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-now-hiring-deactivator.php
 */
function simp_ec_deactivate_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/plugin-deactivator.php';
	//Simp_Ec_Deactivator::deactivate();

	// clear the permalinks to remove our post type's rules
    flush_rewrite_rules();
}


register_deactivation_hook( __FILE__, 'simp_ec_deactivate_plugin' );









