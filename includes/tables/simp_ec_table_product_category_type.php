<?php 
	//7. Product Category Type Table - CREATED
	if($wpdb->get_var("SHOW TABLES LIKE '$table_pct'") != $table_pct) {
		$sql = "CREATE TABLE IF NOT EXISTS $table_pct (
		ptype_id mediumint(7) NOT NULL,
		pcat_id mediumint(3) NOT NULL,
		PRIMARY KEY  (ptype_id, pcat_id),
		FOREIGN KEY  (ptype_id) REFERENCES $table_pat (ptype_id) ON DELETE CASCADE,
		FOREIGN KEY  (pcat_id) REFERENCES $table_pc (pcat_id) ON DELETE CASCADE
		) $charset_collate;";

		dbDelta( $sql );
	}
?>