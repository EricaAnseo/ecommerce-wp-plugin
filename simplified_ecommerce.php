<?php
/**
 * @since 		1.0.0
 * @package		Simplified_Ecommerce
 *
 * @wordpress-plugin
 * Plugin Name: Simplified Ecommerce 
 * Plugin URI: http://fyp.ericachai.ie/
 * Description: An ecommerce plugin with a user experience design approach that allows retailers to effectively add content onto their online store
 * Version: 1.0.2
 * Author: Erica Chai
 * Author URI: http://ericachai.ie/
 * License: GPL2

 * Simplified Ecommerce is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 2 of the License, or any later version.
 
 * Simplified Ecommerce is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 
 * You should have received a copy of the GNU General Public License along with Simplified Ecommerce. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
 *
**/

/**
 * Comment above is used by WordPress to define the plugin. 
 */

// 5/2/2017 - Used for referring to the plugin file or basename
if ( ! defined( 'SIMPLIFIED_ECOMMERCE_FILE' ) ) {
	define( 'SIMPLIFIED_ECOMMERCE_FILE', plugin_basename( __FILE__ ) );
}

if (!defined('SIMPLIFIED_ECOMMERCE_VERSION_KEY')){
	define('SIMPLIFIED_ECOMMERCE_VERSION_KEY', 'SIMPLIFIED_ECOMMERCE_version');
}

if (!defined('SIMPLIFIED_ECOMMERCE_VERSION_NUM')) {
	define('SIMPLIFIED_ECOMMERCE_VERSION_NUM', '1.0.0');
}

if ( ! defined( 'SIMPLIFIED_ECOMMERCE_ROOT_PATH' ) ) {
	define( 'SIMPLIFIED_ECOMMERCE_ROOT_PATH', plugin_dir_path( __FILE__ ) );
}

// 6/2/2017 - Used to test new features.  
require_once (plugin_dir_path( __FILE__) . 'includes/test.php');
require_once (plugin_dir_path( __FILE__) . 'includes/shop_filter_widget.php' );
require_once (plugin_dir_path( __FILE__) . 'includes/shortcode_master.php' );
require_once (plugin_dir_path( __FILE__) . 'includes/dashboard_menu.php' );

//include_once(plugin_dir_path( __FILE__ ) . 'includes/templates/template-test.php');

// Include the dependencies needed to instantiate the plugin.
//foreach ( glob( plugin_dir_path( __FILE__ ) . 'includes/*.php' ) as $file ) {
//    include_once $file;
//}

//Assets for the backend 
function simp_ec_load_custom_assets() {
	wp_register_style('fluidable-grid-css', plugins_url('public/andri-fluidable-10d8026/fluidable-min.css',__FILE__ ) );
	wp_enqueue_style( 'fluidable-grid-css' );
	wp_register_style('simp-ec-custom-css', plugins_url('public/css/main.min.css',__FILE__ ) );
	wp_enqueue_style( 'simp-ec-custom-css' );

}

add_action('admin_enqueue_scripts', 'simp_ec_load_custom_assets');

//Assets for the front end
function simp_ec_load_custom_assets_front_end() {
    wp_register_style('fluidable-grid-css', plugins_url('public/andri-fluidable-10d8026/fluidable-min.css',__FILE__ ) );
	wp_enqueue_style( 'fluidable-grid-css' );
	wp_register_style('simp-ec-custom-css', plugins_url('public/css/main.min.css',__FILE__ ) );
	wp_enqueue_style( 'simp-ec-custom-css' );
}
add_action( 'wp_enqueue_scripts', 'simp_ec_load_custom_assets_front_end' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/plugin-activator.php
 */
function simp_ec_activate_plugin() {

	$new_version = '2.0.0';

	// if (get_option(SIMPLIFIED_ECOMMERCE_VERSION_KEY) != $new_version) {
	//     simp_ec_update_database_table();
	//     update_option(SIMPLIFIED_ECOMMERCE_VERSION_KEY, $new_version);
	// }

	include_once(plugin_dir_path( __FILE__ ) . 'includes/plugin-activator.php');
	simp_ec_db_install();
	simp_ec_install_data();

    // clear the permalinks after the post type has been registered
    //flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'simp_ec_activate_plugin' );

function shop_page_template( $template ) {

	if ( is_page( 'shop' )  ) {
		$new_template = SIMPLIFIED_ECOMMERCE_ROOT_PATH. 'includes/templates/template-shop.php';
		if ( '' != $new_template ) {
			return $new_template ;
		}
	}

	return $template;
}

add_filter( 'template_include', 'shop_page_template', 99 );

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




?>