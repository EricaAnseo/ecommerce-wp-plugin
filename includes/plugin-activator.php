<?php 

function simp_ec_update_db_check() {
    global $simp_ec_db_version;
    if ( get_site_option( 'simp_ec_db_version' ) != $simp_ec_db_version ) 
    {
		simp_ec_db_install();    
	}
}
add_action( 'plugins_loaded', 'simp_ec_update_db_check' );

simp_ec_db_install();

function simp_ec_db_install() {
	
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

	/*
	/1. Product Attributes Table - CREATED
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

	//4. Product Category Table
	$sql = "CREATE TABLE IF NOT EXISTS $table_pc (
	pcat_id shortint(3) NOT NULL AUTO_INCREMENT,
	pcat_name varchar(200) NOT NULL,
	pcat_slug varchar(200) DEFAULT '' NOT NULL,
	pcat_desc varchar(200) DEFAULT '' NOT NULL,
	pcat_url varchar(55) DEFAULT '' NOT NULL,
	PRIMARY KEY  (pcat_id)
	) $charset_collate;";

	dbDelta( $sql );

	//5. Product Table
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
	ptype_id mediumint(7) NOT NULL,
	PRIMARY KEY  (vproduct_id),
	FOREIGN KEY (product_id) REFERENCES $table_product (product_id)
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

	//10. Order Table
	$sql = "CREATE TABLE IF NOT EXISTS $table_order (
	customer_id mediumint(6) NOT NULL,
	product_id mediumint(10) NOT NULL,
	order_amount int(7) NOT NULL,
	PRIMARY KEY  (customer_id, product_id),
	FOREIGN KEY (product_id) REFERENCES $table_product (product_id),
	FOREIGN KEY (customer_id) REFERENCES $table_customer (customer_id)
	) $charset_collate;";

	dbDelta( $sql );*/


	//Storing the version of the db table
	//add_option( 'simp_ec_db_version', $simp_ec_db_version );
	
	update_option( 'simp_ec_db_version', $simp_ec_db_version );


}

function simp_ec_install_data() {
	global $wpdb;
	
	$welcome_name = 'Mr. WordPress';
	$welcome_text = 'Congratulations, you just completed the installation!';

	//table created for testing purposes
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
	

	$wpdb->insert( 
		$table_name, 
		array( 
			'time' => current_time( 'mysql' ), 
			'name' => $welcome_name, 
			'text' => $welcome_text, 
		)   
	);

	//1. Product Attributes Insert Statements
	/*$wpdb->insert( 
		$table_pa, 
		array( 
			'pattribute_id' => 1, 
			'pattribute_name' => 'Red',
		) 
	);

	$wpdb->insert( 
		$table_pa, 
		array( 
			'pattribute_id' => 2, 
			'pattribute_name' => 'Green',
		) 
	);

	$wpdb->insert( 
		$table_pa, 
		array( 
			'pattribute_id' => 3, 
			'pattribute_name' => 'Blue',
		) 
	);

	$wpdb->insert( 
		$table_pa, 
		array( 
			'pattribute_id' => 4, 
			'pattribute_name' => 'Purple',
		) 
	);

	$wpdb->insert( 
		$table_pa, 
		array( 
			'pattribute_id' => 5, 
			'pattribute_name' => '2GB',
		) 
	);

	$wpdb->insert( 
		$table_pa, 
		array( 
			'pattribute_id' => 6, 
			'pattribute_name' => '4GB',
		) 
	);

	$wpdb->insert( 
		$table_pa, 
		array( 
			'pattribute_id' => 7, 
			'pattribute_name' => '8GB',
		) 
	);

	$wpdb->insert( 
		$table_pa, 
		array( 
			'pattribute_id' => 8, 
			'pattribute_name' => '12GB',
		) 
	);

	$wpdb->insert( 
		$table_pa, 
		array( 
			'pattribute_id' => 9, 
			'pattribute_name' => '16GB',
		) 
	);

	$wpdb->insert( 
		$table_pa, 
		array( 
			'pattribute_id' => 10, 
			'pattribute_name' => '140',
		) 
	);

	$wpdb->insert( 
		$table_pa, 
		array( 
			'pattribute_id' => 11, 
			'pattribute_name' => '240',
		) 
	);

	$wpdb->insert( 
		$table_pa, 
		array( 
			'pattribute_id' => 12, 
			'pattribute_name' => '360',
		) 
	);

	$wpdb->insert( 
		$table_pa, 
		array( 
			'pattribute_id' => 13, 
			'pattribute_name' => '480',
		) 
	);

	$wpdb->insert( 
		$table_pa, 
		array( 
			'pattribute_id' => 14, 
			'pattribute_name' => '720',
		) 
	);

	$wpdb->insert( 
		$table_pa, 
		array( 
			'pattribute_id' => 15, 
			'pattribute_name' => '1080HD',
		) 
	);

	$wpdb->insert( 
		$table_pa, 
		array( 
			'pattribute_id' => 16, 
			'pattribute_name' => '2k',
		) 
	);

	$wpdb->insert( 
		$table_pa, 
		array( 
			'pattribute_id' => 17, 
			'pattribute_name' => '4k',
		) 
	);

	$wpdb->insert( 
		$table_pa, 
		array( 
			'pattribute_id' => 18, 
			'pattribute_name' => '5.6 inch',
		) 
	);

	$wpdb->insert( 
		$table_pa, 
		array( 
			'pattribute_id' => 18, 
			'pattribute_name' => '7 inch',
		) 
	);

	$wpdb->insert( 
		$table_pa, 
		array( 
			'pattribute_id' => 19, 
			'pattribute_name' => '12 inch',
		) 
	);

	//2. Product Type Insert Statement

	$wpdb->insert( 
		$table_pat, 
		array( 
			'ptype_id' => 1, 
			'ptype_name' => 'Colour',
			'ptype_desc' => 'The colour of a given product. A product can be available in a varity of colours. This type does not include a product that comes in a mix of colours.',
		) 
	);

	$wpdb->insert( 
		$table_pat, 
		array( 
			'ptype_id' => 2, 
			'ptype_name' => 'RAM',
			'ptype_desc' => 'Random Access Memorry. Only appliable to technical products such as computers, tablets, and phones.',
		) 
	);

	$wpdb->insert( 
		$table_pat, 
		array( 
			'ptype_id' => 3, 
			'ptype_name' => 'Resolution',
			'ptype_desc' => 'The quality of the screen. Pixels per inch. Only appliable to technical products such as computers, tablets, and phones.',
		) 
	);

	$wpdb->insert( 
		$table_pat, 
		array( 
			'ptype_id' => 4, 
			'ptype_name' => 'Screen Size',
			'ptype_desc' => 'The size of the display, measured in inches. Only appliable to technical products such as computers, tablets, and phones.',
		) 
	);

	//3. Product Attribute Types Insert Statement

	$wpdb->insert( 
		$table_pt, 
		array( 
			'ptype_id' => 1, 
			'pattribute_id' => 1,
		) 
	);

	$wpdb->insert( 
		$table_pt, 
		array( 
			'ptype_id' => 1, 
			'pattribute_id' => 2,
		) 
	);

	$wpdb->insert( 
		$table_pt, 
		array( 
			'ptype_id' => 1, 
			'pattribute_id' => 3,
		) 
	);

	$wpdb->insert( 
		$table_pt, 
		array( 
			'ptype_id' => 1, 
			'pattribute_id' => 4,
		) 
	);

	$wpdb->insert( 
		$table_pt, 
		array( 
			'ptype_id' => 2, 
			'pattribute_id' => 5,
		) 
	);

	$wpdb->insert( 
		$table_pt, 
		array( 
			'ptype_id' => 2, 
			'pattribute_id' => 6,
		) 
	);

	$wpdb->insert( 
		$table_pt, 
		array( 
			'ptype_id' => 2, 
			'pattribute_id' => 7,
		) 
	);

	$wpdb->insert( 
		$table_pt, 
		array( 
			'ptype_id' => 2, 
			'pattribute_id' => 8,
		) 
	);

	$wpdb->insert( 
		$table_pt, 
		array( 
			'ptype_id' => 2, 
			'pattribute_id' => 9,
		) 
	);

	$wpdb->insert( 
		$table_pt, 
		array( 
			'ptype_id' => 3, 
			'pattribute_id' => 10,
		) 
	);

	$wpdb->insert( 
		$table_pt, 
		array( 
			'ptype_id' => 3, 
			'pattribute_id' => 11,
		) 
	);

	$wpdb->insert( 
		$table_pt, 
		array( 
			'ptype_id' => 3, 
			'pattribute_id' => 12,
		) 
	);

	$wpdb->insert( 
		$table_pt, 
		array( 
			'ptype_id' => 3, 
			'pattribute_id' => 13,
		) 
	);

	$wpdb->insert( 
		$table_pt, 
		array( 
			'ptype_id' => 3, 
			'pattribute_id' => 14,
		) 
	);

	$wpdb->insert( 
		$table_pt, 
		array( 
			'ptype_id' => 3, 
			'pattribute_id' => 15,
		) 
	);

	$wpdb->insert( 
		$table_pt, 
		array( 
			'ptype_id' => 3, 
			'pattribute_id' => 16,
		) 
	);

	$wpdb->insert( 
		$table_pt, 
		array( 
			'ptype_id' => 3, 
			'pattribute_id' => 17,
		) 
	);

	$wpdb->insert( 
		$table_pt, 
		array( 
			'ptype_id' => 4, 
			'pattribute_id' => 18,
		) 
	);

	$wpdb->insert( 
		$table_pt, 
		array( 
			'ptype_id' => 4, 
			'pattribute_id' => 19,
		) 
	);

	$wpdb->insert( 
		$table_pt, 
		array( 
			'ptype_id' => 4, 
			'pattribute_id' => 20,
		) 
	);

	//4. Product Category Insert Statement
	$wpdb->insert( 
		$table_pc, 
		array( 
			'pcat_id' => 1, 
			'pcat_name' => 'Laptop',
			'pcat_slug' => 'laptop', 
			'pcat_desc' => 'A portable PC. Ranges fromm a number of products.',
			'pcat_url' => '',
		) 
	);

	$wpdb->insert( 
		$table_pc, 
		array( 
			'pcat_id' => 2, 
			'pcat_name' => 'Desktop',
			'pcat_slug' => 'desktop', 
			'pcat_desc' => 'A personal computer designed for regular use at a single location on or near a desk or table due to its size and power requirements.',
			'pcat_url' => '',
		) 
	);

	$wpdb->insert( 
		$table_pc, 
		array( 
			'pcat_id' => 3, 
			'pcat_name' => 'Mobile',
			'pcat_slug' => 'mobile', 
			'pcat_desc' => '',
			'pcat_url' => '',
		) 
	);

	//5. Product Insert Statement
	$wpdb->insert( 
		$table_product, 
		array( 
			'product_id' => 1, 
			'product_sku' => '',
			'pname' => 'Dell Inspiron 15 Gaming', 
			'pdesc' => 'Gaming, Wireless and Bluetooth, Thermal Cooling, Discrete Graphic 4GB vRam, Subwoofer',
			'pshortdesc' => 'Gaming Laptop',
			'pprice' => 555.55,
		) 
	);

	$wpdb->insert( 
		$table_product, 
		array( 
			'product_id' => 2, 
			'product_sku' => '83hdkw',
			'pname' => 'Dell Inspiron', 
			'pdesc' => 'Gaming Laptop',
			'pshortdesc' => 'Gaming Laptop',
			'pprice' => 1125.95,
		) 
	);

	//6. Product Categories Insert Statements
	$wpdb->insert( 
		$table_pcs, 
		array( 
			'pcat_id' => 1, 
			'product_id' => 1,
		) 
	);

	$wpdb->insert( 
		$table_pcs, 
		array( 
			'pcat_id' => 2, 
			'product_id' => 2,
		) 
	);

	//7. Product Category Type Insert Statements
	$wpdb->insert( 
		$table_pcs, 
		array( 
			'ptype_id' => 1, 
			'pcat_id' => 1,
		) 
	);

	$wpdb->insert( 
		$table_pcs, 
		array( 
			'ptype_id' => 1, 
			'pcat_id' => 2,
		) 
	);

	//8. Variable Product Insert Statements	
	$wpdb->insert( 
		$table_pcs, 
		array(
			'product_id' => 1, 
			'vproduct_id' => 1, 
			'vproduct_name' => 'Product name in Pink',
			'vproduct_price' => 34.56,
			'vproduct_stock' => 4,
			'vproduct_sku' => 'nn4k32',
			'ptype_id' => '1',
		) 
	);

	//9. Customer Table
	$wpdb->insert( 
		$table_pcs, 
		array(
			'customer_id' => 1, 
			'customer_name' => 'Koda Chai', 
			'customer_address' => '123 Address Goes here, Dublin, Ireland.',
			'customer_email ' => 'mail@mail.mail',
		) 
	);

	//10. Order Table
	$wpdb->insert( 
		$table_pcs, 
		array(
			'customer_id' => 1, 
			'product_id' => 1, 
			'order_amount' => 1,
		) 
	);*/

}