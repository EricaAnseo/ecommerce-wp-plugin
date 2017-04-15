<?php 
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
?>