<?php 

global $simp_ec_db_version;
$simp_ec_db_version = '1.0';

function simp_ec_db_install () {
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	global $wpdb;

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


	//Test Table, ignore
	$sql = "CREATE TABLE IF NOT EXISTS $table_name (
	id mediumint(9) NOT NULL AUTO_INCREMENT,
	time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
	name tinytext NOT NULL,
	text text NOT NULL,
	url varchar(55) DEFAULT '' NOT NULL,
	PRIMARY KEY  (id)
	) $charset_collate;";

	dbDelta( $sql );

	//1. Product Attributes Table
	$sql = "CREATE TABLE IF NOT EXISTS $table_pa (
	pattribute_id mediumint(9) NOT NULL AUTO_INCREMENT,
	pattribute_name varchar(200) DEFAULT '' NOT NULL,
	PRIMARY KEY  (pattribute_id)
	) $charset_collate;";

	dbDelta( $sql );

	//2. Product Type Table
	$sql = "CREATE TABLE IF NOT EXISTS $table_pt (
	ptype_id mediumint(7) NOT NULL AUTO_INCREMENT,
	ptype_name varchar(200) DEFAULT '' NOT NULL,
	ptype_desc longtext DEFAULT '' NOT NULL,
	PRIMARY KEY  (ptype_id)
	) $charset_collate;";

	dbDelta( $sql );

	//3. Product Attribute Types Table
	$sql = "CREATE TABLE IF NOT EXISTS $table_pat (
	ptype_id mediumint(7) NOT NULL,
	pattribute_id mediumint(9) NOT NULL,
	PRIMARY KEY  (ptype_id, pattribute_id), 
	FOREIGN KEY (ptype_id) REFERENCES $table_pt (ptype_id),
	FOREIGN KEY (pattribute_id) REFERENCES $table_pa (pattribute_id)
	) $charset_collate;";

	dbDelta( $sql );

	//4. Product Table
	$sql = "CREATE TABLE IF NOT EXISTS $table_product (
	product_id mediumint(10) NOT NULL AUTO_INCREMENT,
	product_sku text,
	pname text,
	pdesc longtext, 
	pshortdesc longtext, 
	PRIMARY KEY  (product_id)
	) $charset_collate;";

	dbDelta( $sql );
	
	//5. Product Category Table
	$sql = "CREATE TABLE IF NOT EXISTS $table_pc (
	pcat_id mediumint(3) NOT NULL AUTO_INCREMENT,
	pcat_name varchar(200) NOT NULL,
	pcat_slug varchar(200) DEFAULT '' NOT NULL
	pcat_desc varchar(200) DEFAULT '' NOT NULL
	pcat_url varchar(55) DEFAULT '' NOT NULL,
	PRIMARY KEY  (pcat_id)
	) $charset_collate;";

	dbDelta( $sql );

	//6. Product Categories Table
	$sql = "CREATE TABLE IF NOT EXISTS $table_pcs (
	pcat_id mediumint(9) NOT NULL,
	product_id mediumint(10) NOT NULL,
	PRIMARY KEY  (pcat_id, product_id),
	FOREIGN KEY (pcat_id) REFERENCES $table_pc (pcat_id),
	FOREIGN KEY (product_id) REFERENCES $table_product (product_id)
	) $charset_collate;";

	dbDelta( $sql );

	//7. Product Category Type Table
	$sql = "CREATE TABLE IF NOT EXISTS $table_pct (
	ptype_id mediumint(7) NOT NULL,
	pcat_id mediumint(9) NOT NULL,
	PRIMARY KEY  (ptype_id, pcat_id),
	FOREIGN KEY (ptype_id) REFERENCES $table_pat (ptype_id),
	FOREIGN KEY (pcat_id) REFERENCES $table_pc (pcat_id)
	) $charset_collate;";

	dbDelta( $sql );

	//8. Variable Product Table
	$sql = "CREATE TABLE IF NOT EXISTS $table_pv (
	vproduct_id mediumint(12) NOT NULL AUTO_INCREMENT,
	vproduct_name longtext,
	vproduct_price mediumint(10) DEFAULT '',
	vproduct_stock int(5),
	vproduct_sku varchar(200) DEFAULT '',
	product_id mediumint(10) NOT NULL,
	PRIMARY KEY  (vproduct_id),
	FOREIGN KEY (product_id) REFERENCES $table_product (product_id)
	) $charset_collate;";

	dbDelta( $sql );

	//9. Customer Table
	$sql = "CREATE TABLE IF NOT EXISTS $table_customer (
	customer_id mediumint(6) NOT NULL AUTO_INCREMENT,
	customer_name,
	customer_address longtext,
	customer_email longtext,
	PRIMARY KEY  (customer_id)
	) $charset_collate;";

	dbDelta( $sql );

	//10. Order Table
	$sql = "CREATE TABLE IF NOT EXISTS $table_order (
	customer_id mediumint(6) NOT NULL,
	product_id mediumint(10) NOT NULL,
	PRIMARY KEY  (customer_id, product_id),
	FOREIGN KEY (product_id) REFERENCES $table_product (product_id),
	FOREIGN KEY (customer_id) REFERENCES $table_customer (customer_id)
	) $charset_collate;";

	
	dbDelta( $sql );


	//Storing the version of the db table
	add_option( 'simp_ec_db_version', $simp_ec_db_version );


}

function simp_ec_install_data() {
	global $wpdb;
	
	$welcome_name = 'Mr. WordPress';
	$welcome_text = 'Congratulations, you just completed the installation!';
	
	$table_name = $wpdb->prefix . 'test';
	
	$wpdb->insert( 
		$table_name, 
		array( 
			'time' => current_time( 'mysql' ), 
			'name' => $welcome_name, 
			'text' => $welcome_text, 
		) 
	);
}