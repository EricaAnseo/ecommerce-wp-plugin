<?php 
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
?>