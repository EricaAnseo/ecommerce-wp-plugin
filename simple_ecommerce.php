<?php
/*
	Plugin Name: Simplified Ecommerce 
	Plugin URI: http://fyp.ericachai.ie/
	Description: A plugin to add multiple products to your store.
	Version: 1.0.2
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
	//require_once plugin_dir_path( __FILE__ ) . 'includes/plugin-activator.php';
	// Simp_Ec_Activator::activate();

	global $wpdb;

	global $simp_ec_db_version;
	$simp_ec_db_version = '1.01';

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

	//table created for test purposes
	$table_name = $wpdb->prefix . "test"; 

	//Name of the tables used for Simplified Ecommerce Plugin
	$table_pa = $wpdb->prefix . "simp_ec_product_attribute"; 
	$table_pat = $wpdb->prefix . "simp_ec_product_attribute_type"; 
	$table_pt = $wpdb->prefix . "simp_ec_product_type"; 
	$table_pct = $wpdb->prefix . "simp_ec_product_category_type"; 
	$table_pc = $wpdb->prefix . "simp_ec_product_category"; 
	$table_pcs = $wpdb->prefix . "simp_ec_product_categories"; 
	$table_product = $wpdb->prefix . "simp_ec_product"; 
	$table_pv = $wpdb->prefix . "simp_ec_product_variable"; 
	$table_order = $wpdb->prefix . "simp_ec_order"; 
	$table_customer = $wpdb->prefix . "simp_ec_customer"; 

	//Defaults character set, Used to prevent ? from appearing in the tables.
	$charset_collate = $wpdb->get_charset_collate();

	//$sql[] = array;

	//Test Table, ignore
	$sql_test = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		name tinytext NOT NULL,
		text text NOT NULL,
		url varchar(55) DEFAULT '' NOT NULL,
		PRIMARY KEY  (id)
	) $charset_collate;";

	dbDelta($sql_test);

	//$wpdb->hide_errors();
	echo $wpdb->show_errors();

	$wpdb->print_error();  

	//1. Product Attributes Table - CREATED
	$sql_pa = "CREATE TABLE IF NOT EXISTS $table_pa (
	pattribute_id mediumint(9) NOT NULL AUTO_INCREMENT,
	pattribute_name varchar(200) DEFAULT '' NOT NULL,
	PRIMARY KEY  (pattribute_id)
	) $charset_collate;";

	dbDelta( $sql_pa );

	///2. Product Type Table - CREATED
	$sql_pt = "CREATE TABLE IF NOT EXISTS $table_pt (
	ptype_id mediumint(7) NOT NULL AUTO_INCREMENT,
	ptype_name varchar(200) DEFAULT '' NOT NULL,
	ptype_desc longtext DEFAULT '' NOT NULL,
	PRIMARY KEY  (ptype_id)
	) $charset_collate;";

	dbDelta( $sql_pt );

	//3. Product Attribute Types Table - CREATED
	$sql = "CREATE TABLE IF NOT EXISTS $table_pat (
	ptype_id mediumint(7) NOT NULL,
	pattribute_id mediumint(9) NOT NULL,
	PRIMARY KEY  (ptype_id, pattribute_id), 
	FOREIGN KEY (ptype_id) REFERENCES $table_pt (ptype_id),
	FOREIGN KEY (pattribute_id) REFERENCES $table_pa (pattribute_id)
	) $charset_collate;";

	dbDelta( $sql );

	//4. Product Category Table - CREATED
	$sql = "CREATE TABLE IF NOT EXISTS $table_pc (
	pcat_id mediumint(3) NOT NULL AUTO_INCREMENT,
	pcat_name text NOT NULL,
	pcat_slug varchar(200) DEFAULT '' NOT NULL,
	pcat_desc longtext DEFAULT '' NOT NULL,
	pcat_url text DEFAULT '' NOT NULL,
	PRIMARY KEY  (pcat_id)
	) $charset_collate;";

	dbDelta( $sql );

	//5. Product Table  - CREATED
	$sql = "CREATE TABLE IF NOT EXISTS $table_product (
	product_id mediumint(10) NOT NULL AUTO_INCREMENT,
	product_sku text,
	pname text,
	pdesc longtext, 
	pshortdesc longtext, 
	pprice decimal(6,2),
	PRIMARY KEY  (product_id)
	) $charset_collate;";

	dbDelta( $sql );

	//6. Product Categories Table - CREATED
	$sql = "CREATE TABLE IF NOT EXISTS $table_pcs (
	pcat_id mediumint(3) NOT NULL,
	product_id mediumint(10) NOT NULL,
	PRIMARY KEY  (pcat_id, product_id),
	FOREIGN KEY (pcat_id) REFERENCES $table_pc (pcat_id),
	FOREIGN KEY (product_id) REFERENCES $table_product (product_id)
	) $charset_collate;";

	dbDelta( $sql );

	//7. Product Category Type Table - CREATED
	$sql = "CREATE TABLE IF NOT EXISTS $table_pct (
	ptype_id mediumint(7) NOT NULL,
	pcat_id mediumint(3) NOT NULL,
	PRIMARY KEY  (ptype_id, pcat_id),
	FOREIGN KEY (ptype_id) REFERENCES $table_pat (ptype_id),
	FOREIGN KEY (pcat_id) REFERENCES $table_pc (pcat_id)
	) $charset_collate;";

	dbDelta( $sql );

	//8. Variable Product Table
	$sql = "CREATE TABLE IF NOT EXISTS $table_pv (
	vproduct_id mediumint(12) NOT NULL AUTO_INCREMENT,
	vproduct_name longtext,
	vproduct_price decimal(6,2),
	vproduct_stock mediumint(5),
	vproduct_sku varchar(200),
	product_id mediumint(10) NOT NULL,
	ptype_id mediumint(7) NOT NULL,
	PRIMARY KEY  (vproduct_id),
	FOREIGN KEY (product_id) REFERENCES $table_product (product_id),
	FOREIGN KEY (ptype_id) REFERENCES $table_pt (ptype_id)
	) $charset_collate;";

	dbDelta( $sql );

	//9. Customer Table - CREATED
	$sql = "CREATE TABLE IF NOT EXISTS $table_customer (
	customer_id mediumint(6) NOT NULL AUTO_INCREMENT,
	customer_name longtext,
	customer_address longtext,
	customer_email longtext,
	PRIMARY KEY  (customer_id)
	) $charset_collate;";

	dbDelta( $sql );

	//10. Order Table - CREATED
	$sql = "CREATE TABLE IF NOT EXISTS $table_order (
	customer_id mediumint(6) NOT NULL,
	product_id mediumint(10) NOT NULL,
	order_amount shortint(7) NOT NULL,
	PRIMARY KEY  (customer_id, product_id),
	FOREIGN KEY (product_id) REFERENCES $table_product (product_id),
	FOREIGN KEY (customer_id) REFERENCES $table_customer (customer_id)
	) $charset_collate;";

	dbDelta( $sql );


	//Storing the version of the db table
	//add_option( 'simp_ec_db_version', $simp_ec_db_version );

	/*Only used for testing. Delete once testing for table creation has occured.

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

	global $wpdb;
	$charset_collate = $wpdb->get_charset_collate();

	$table_name = $wpdb->prefix . "simp_ec_tableX"; 
	$table_name2 = $wpdb->prefix . "simp_ec_tableY"; 

	$sql = "CREATE TABLE $table_name (
  	id mediumint(9) NOT NULL AUTO_INCREMENT,
  	time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
  	name tinytext NOT NULL,
  	text text NOT NULL,
  	url varchar(55) DEFAULT '' NOT NULL,
  	PRIMARY KEY  (id)
	) $charset_collate;";

	//require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );

	$sql = "CREATE TABLE $table_name2 (
  	id mediumint(9) NOT NULL AUTO_INCREMENT,
  	time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
  	name tinytext NOT NULL,
  	text text NOT NULL,
  	url varchar(55) DEFAULT '' NOT NULL,
  	PRIMARY KEY  (id)
	) $charset_collate;";

	dbDelta( $sql );
	*/
	//simp_ec_setup_post_types();
	
 
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









