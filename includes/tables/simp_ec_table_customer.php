<?php 
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
?>