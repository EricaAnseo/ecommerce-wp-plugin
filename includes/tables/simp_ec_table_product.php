<?php 
	//5. Product Table  - CREATED
	if($wpdb->get_var("SHOW TABLES LIKE '$table_product'") != $table_product) {
		$sql = "CREATE TABLE IF NOT EXISTS $table_product (
		product_id mediumint(10) NOT NULL AUTO_INCREMENT,
		product_sku text,
		pname text,
		pdesc longtext, 
		pshortdesc longtext, 
		pprice decimal(6,2),
		date_added datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		PRIMARY  KEY (product_id)
		) $charset_collate;";

		dbDelta( $sql );
	}
	
?>