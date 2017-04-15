<?php 
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
		pattribute_id mediumint(9) NOT NULL,
		PRIMARY KEY  (vproduct_id),
		FOREIGN KEY  (product_id) REFERENCES $table_product (product_id) ON DELETE CASCADE,
		FOREIGN KEY  (ptype_id) REFERENCES $table_pt (ptype_id) ON DELETE CASCADE, 
		FOREIGN KEY  (pattribute_id) REFERENCES $table_pa (pattribute_id) ON DELETE CASCADE
		) $charset_collate;";

		dbDelta( $sql );
	}
	
?>