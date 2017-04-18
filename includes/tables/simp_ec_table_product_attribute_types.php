<?php 
	//3. Product Attribute Types Table - CREATED		
 	if($wpdb->get_var("SHOW TABLES LIKE '$table_pat'") != $table_pat) {		
 		$sql = "CREATE TABLE IF NOT EXISTS $table_pat (		
 		ptype_id mediumint(7) NOT NULL,		
 		pattribute_id mediumint(9) NOT NULL,		
 		PRIMARY KEY  (ptype_id, pattribute_id), 		
 		FOREIGN KEY  (ptype_id) REFERENCES $table_pt (ptype_id) ON DELETE CASCADE,		
 		FOREIGN KEY  (pattribute_id) REFERENCES $table_pa (pattribute_id) ON DELETE CASCADE		
 		) $charset_collate;";		
 		
 		dbDelta( $sql );		
 	}


?>