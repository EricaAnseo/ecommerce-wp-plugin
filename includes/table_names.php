<?php
	
	//Name of the tables used for Simplified Ecommerce Plugin
	global $wpdb;
	$table_name = $wpdb->prefix . "test";
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
	$charset_collate = $wpdb->get_charset_collate(); 

	//table created for test purposes
	if (! defined($table_name)){
        define($table_name, $wpdb->prefix . "test");
	} 

	if (! defined($table_pa)){
        define($table_pa, $wpdb->prefix . "simp_ec_product_attribute");
	}

	if (! defined($table_pat)){
        define($table_pat, $wpdb->prefix . "simp_ec_product_attribute_type");
	}

	if (! defined($table_pt)){
        define($table_pt, $wpdb->prefix . "simp_ec_product_type");
	}

	if (! defined($table_pct)){
        define($table_pct, $wpdb->prefix . "simp_ec_product_category_type");
	}

	if (! defined($table_pc)){
        define($table_pc, $wpdb->prefix . "simp_ec_product_category");
	}

	if (! defined($table_pcs)){
        define($table_pcs, $wpdb->prefix . "simp_ec_product_categories");
	}

	if (! defined($table_product)){
        define($table_product, $wpdb->prefix . "simp_ec_product");
	}

	if (! defined($table_pv)){
        define($table_pv, $wpdb->prefix . "simp_ec_product_variable");
	}

	if (! defined($table_order)){
        define($table_order, $wpdb->prefix . "simp_ec_order");
	}

	if (! defined($table_customer)){
        define($table_customer, $wpdb->prefix . "simp_ec_customer");
	}

	//Defaults character set, Used to prevent ? from appearing in the tables.
	if (! defined($charset_collate)){
        define($charset_collate, $wpdb->get_charset_collate());
	}


