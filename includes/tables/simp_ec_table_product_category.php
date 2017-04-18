<?php 
	//4. Product Category Table - CREATED
	if($wpdb->get_var("SHOW TABLES LIKE '$table_pc'") != $table_pc) {
		$sql = "CREATE TABLE IF NOT EXISTS $table_pc (
		pcat_id mediumint(3) NOT NULL AUTO_INCREMENT,
		pcat_name text NOT NULL,
		pcat_slug varchar(200) DEFAULT '' NOT NULL,
		pcat_desc longtext DEFAULT '' NOT NULL
		PRIMARY KEY  (pcat_id)
		) $charset_collate;";

		dbDelta( $sql );
	}
?>