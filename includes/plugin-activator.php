<?php 

function simp_ec_update_db_check() {
    global $simp_ec_db_version;
    if ( get_site_option( 'simp_ec_db_version' ) != $simp_ec_db_version ) 
    {
		simp_ec_db_install();  
		update_option( 'simp_ec_db_version', $simp_ec_db_version );
	}
}
add_action( 'plugins_loaded', 'simp_ec_update_db_check' );

register_activation_hook( __FILE__, 'simp_ec_db_install' );

function simp_ec_update_database_table() {
	global $wpdb;
	
}

function simp_ec_db_install() {
	
	global $wpdb;

	global $simp_ec_db_version;
	$simp_ec_db_version = '1.01';

	require_once plugin_dir_path( __FILE__ ) . 'tables/table_names.php';

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

	//Test Table, ignore
	if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
     	//table not in database. Create new table
		$sql_test = "CREATE TABLE IF NOT EXISTS $table_name (
			id mediumint(9) NOT NULL AUTO_INCREMENT,
			time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
			name tinytext NOT NULL,
			text text NOT NULL,
			url varchar(55) DEFAULT '' NOT NULL,
			PRIMARY KEY  (id)
		) $charset_collate;";

		dbDelta($sql_test);
	}

	//1. Product Attributes Table - CREATED
	if($wpdb->get_var("SHOW TABLES LIKE '$table_pa'") != $table_pa) {
     	//table not in database. Create new table
		$sql_pa = "CREATE TABLE IF NOT EXISTS $table_pa (
		pattribute_id mediumint(9) NOT NULL AUTO_INCREMENT,
		pattribute_name varchar(200) DEFAULT '' NOT NULL,
		PRIMARY KEY  (pattribute_id)
		) $charset_collate;";

		dbDelta( $sql_pa );
	}

	///2. Product Type Table - CREATED
	if($wpdb->get_var("SHOW TABLES LIKE '$table_pt'") != $table_pt) {
		$sql_pt = "CREATE TABLE IF NOT EXISTS $table_pt (
		ptype_id mediumint(7) NOT NULL AUTO_INCREMENT,
		ptype_name varchar(200) DEFAULT '' NOT NULL,
		ptype_desc longtext DEFAULT '' NOT NULL,
		PRIMARY KEY  (ptype_id)
		) $charset_collate;";

		dbDelta( $sql_pt );
	}
	
	//3. Product Attribute Types Table - CREATED
	if($wpdb->get_var("SHOW TABLES LIKE '$table_pat'") != $table_pat) {
		$sql = "CREATE TABLE IF NOT EXISTS $table_pat (
		ptype_id mediumint(7) NOT NULL,
		pattribute_id mediumint(9) NOT NULL,
		PRIMARY KEY  (ptype_id, pattribute_id), 
		FOREIGN KEY (ptype_id) REFERENCES $table_pt (ptype_id),
		FOREIGN KEY (pattribute_id) REFERENCES $table_pa (pattribute_id)
		) $charset_collate;";

		dbDelta( $sql );
	}

	//4. Product Category Table - CREATED
	if($wpdb->get_var("SHOW TABLES LIKE '$table_pc'") != $table_pc) {
		$sql = "CREATE TABLE IF NOT EXISTS $table_pc (
		pcat_id mediumint(3) NOT NULL AUTO_INCREMENT,
		pcat_name text NOT NULL,
		pcat_slug varchar(200) DEFAULT '' NOT NULL,
		pcat_desc longtext DEFAULT '' NOT NULL,
		pcat_url text DEFAULT '' NOT NULL,
		PRIMARY KEY  (pcat_id)
		) $charset_collate;";

		dbDelta( $sql );
	}

	//5. Product Table  - CREATED
	if($wpdb->get_var("SHOW TABLES LIKE '$table_product'") != $table_product) {
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
	}

	//6. Product Categories Table - CREATED
	if($wpdb->get_var("SHOW TABLES LIKE '$table_pcs'") != $table_pcs) {
		$sql = "CREATE TABLE IF NOT EXISTS $table_pcs (
		pcat_id mediumint(3) NOT NULL,
		product_id mediumint(10) NOT NULL,
		PRIMARY KEY  (pcat_id, product_id),
		FOREIGN KEY (pcat_id) REFERENCES $table_pc (pcat_id),
		FOREIGN KEY (product_id) REFERENCES $table_product (product_id)
		) $charset_collate;";

		dbDelta( $sql );
	}

	//7. Product Category Type Table - CREATED
	if($wpdb->get_var("SHOW TABLES LIKE '$table_pct'") != $table_pct) {
		$sql = "CREATE TABLE IF NOT EXISTS $table_pct (
		ptype_id mediumint(7) NOT NULL,
		pcat_id mediumint(3) NOT NULL,
		PRIMARY KEY  (ptype_id, pcat_id),
		FOREIGN KEY (ptype_id) REFERENCES $table_pat (ptype_id),
		FOREIGN KEY (pcat_id) REFERENCES $table_pc (pcat_id)
		) $charset_collate;";

		dbDelta( $sql );
	}

	//8. Variable Product Table
	if($wpdb->get_var("SHOW TABLES LIKE '$table_pv'") != $table_pv) {
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
	}

	//9. Customer Table - CREATED
	if($wpdb->get_var("SHOW TABLES LIKE '$table_customer'") != $table_customer) {
		$sql = "CREATE TABLE IF NOT EXISTS $table_customer (
		customer_id mediumint(6) NOT NULL AUTO_INCREMENT,
		customer_name longtext,
		customer_address longtext,
		customer_email longtext,
		PRIMARY KEY  (customer_id)
		) $charset_collate;";

		dbDelta( $sql );
	}

	//10. Order Table - CREATED
	if($wpdb->get_var("SHOW TABLES LIKE '$table_order'") != $table_order) {
		$sql = "CREATE TABLE IF NOT EXISTS $table_order (
		customer_id mediumint(6) NOT NULL,
		product_id mediumint(10) NOT NULL,
		order_amount shortint(7) NOT NULL,
		PRIMARY KEY  (customer_id, product_id),
		FOREIGN KEY (product_id) REFERENCES $table_product (product_id),
		FOREIGN KEY (customer_id) REFERENCES $table_customer (customer_id)
		) $charset_collate;";

		dbDelta( $sql );
	}

	//Used to check errors.
	//$wpdb->hide_errors();
	//echo $wpdb->show_errors();
	//$wpdb->print_error();  

	//Storing the version of the db table
	add_option( 'simp_ec_db_version', $simp_ec_db_version );

}

register_activation_hook( __FILE__, 'simp_ec_install_data' );

function simp_ec_install_data() {
	global $wpdb;
	
	$welcome_name = 'Mr. WordPress';
	$welcome_text = 'Congratulations, you just completed the installation!';

	$wpdb->insert( 
		$table_name, 
		array( 
			'time' => current_time( 'mysql' ), 
			'name' => $welcome_name, 
			'text' => $welcome_text, 
		)   
	);

	/*require_once plugin_dir_path( __FILE__ ) . 'insert_statements/insert_product_attributes.php';

	require_once plugin_dir_path( __FILE__ ) . 'insert_statements/insert_product_types.php';

	require_once plugin_dir_path( __FILE__ ) . 'insert_statements/insert_product_attributes_types.php';

	require_once plugin_dir_path( __FILE__ ) . 'insert_statements/insert_product_category.php';

	require_once plugin_dir_path( __FILE__ ) . 'insert_statements/insert_products.php';


	require_once plugin_dir_path( __FILE__ ) . 'insert_statements/insert_product_categories.php';

	require_once plugin_dir_path( __FILE__ ) . 'insert_statements/insert_product_category_type.php';

	require_once plugin_dir_path( __FILE__ ) . 'insert_statements/insert_product_variable.php';

	require_once plugin_dir_path( __FILE__ ) . 'insert_statements/insert_customer.php';

	require_once plugin_dir_path( __FILE__ ) . 'insert_statements/insert_order.php';*/
}

?>