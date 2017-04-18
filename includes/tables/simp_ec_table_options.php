<?php 
	//11 Options Table
	if($wpdb->get_var("SHOW TABLES LIKE '$table_options'") != $table_options) {
     	//table not in database. Create new table
		$sql = "CREATE TABLE IF NOT EXISTS $table_options (
			company_id mediumint(9) NOT NULL AUTO_INCREMENT,
			company_name text,
			company_address text, 
			company_email text, 
			default_currency text, 
			shop_template text,
			PRIMARY KEY  (company_id)
		) $charset_collate;";

		dbDelta($sql);
	}
?>