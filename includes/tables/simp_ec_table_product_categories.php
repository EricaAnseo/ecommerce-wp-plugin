<?php 
	//6. Product Categories Table - CREATED
	if($wpdb->get_var("SHOW TABLES LIKE '$table_pcs'") != $table_pcs) {
		$sql = "CREATE TABLE IF NOT EXISTS $table_pcs (
		pcat_id mediumint(3) NOT NULL,
		product_id mediumint(10) NOT NULL,
		PRIMARY KEY  (pcat_id, product_id),
		FOREIGN KEY  (pcat_id) REFERENCES $table_pc (pcat_id) ON DELETE CASCADE,
		FOREIGN KEY  (product_id) REFERENCES $table_product (product_id) ON DELETE CASCADE
		) $charset_collate;";

		dbDelta( $sql );
	}
?>