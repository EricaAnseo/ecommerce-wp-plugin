<?php 
	//10. Order Table - CREATED
	if($wpdb->get_var("SHOW TABLES LIKE '$table_order'") != $table_order) {
		$sql = "CREATE TABLE IF NOT EXISTS $table_order (
		order_id mediumint(12) NOT NULL AUTO_INCREMENT,
		customer_id mediumint(6) NOT NULL,
		product_id mediumint(10) NOT NULL,
		order_amount int(7) NOT NULL,
		date_ordered datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		PRIMARY KEY  (order_id),
		FOREIGN KEY  (product_id) REFERENCES $table_product (product_id) ON DELETE CASCADE,
		FOREIGN KEY  (customer_id) REFERENCES $table_customer (customer_id) ON DELETE CASCADE
		) $charset_collate;";

		dbDelta( $sql );
	}
?> 