<?php 
	$table_pa = $wpdb->prefix . "simp_ec_product_attribute"; 

	//1. Product Attributes Table
	$sql = "CREATE TABLE IF NOT EXISTS $table_pa (
	pattribute_id mediumint(9) NOT NULL AUTO_INCREMENT,
	pattribute_name varchar(200) DEFAULT '' NOT NULL,
	PRIMARY KEY  (pattribute_id)
	) $charset_collate;";

	dbDelta( $sql );








?>