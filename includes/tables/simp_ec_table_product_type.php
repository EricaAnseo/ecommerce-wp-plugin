<?php 
	///2. Product Type Table - CREATED		
 	if($wpdb->get_var("SHOW TABLES LIKE '$table_pt'") != $table_pt) {		
 		$sql_pt = "CREATE TABLE IF NOT EXISTS $table_pt (		
 		ptype_id mediumint(7) NOT NULL AUTO_INCREMENT,		
 		ptype_name varchar(200) DEFAULT '' NOT NULL,		
 		ptype_desc longtext DEFAULT '' NOT NULL,		
 		PRIMARY KEY  (ptype_id)		
 		) $charset_collate;";		
 		
 		dbDelta( $sql_pt );		
 	}
?>