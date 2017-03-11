<?php
//4. Product Category Insert Statement
	$wpdb->insert( 
		$table_pc, 
		array( 
			'pcat_id' => 1, 
			'pcat_name' => 'Laptop',
			'pcat_slug' => 'laptop', 
			'pcat_desc' => 'A portable PC. Ranges fromm a number of products.',
			'pcat_url' => '',
		) 
	);

	$wpdb->insert( 
		$table_pc, 
		array( 
			'pcat_id' => 2, 
			'pcat_name' => 'Desktop',
			'pcat_slug' => 'desktop', 
			'pcat_desc' => 'A personal computer designed for regular use at a single location on or near a desk or table due to its size and power requirements.',
			'pcat_url' => '',
		) 
	);

	$wpdb->insert( 
		$table_pc, 
		array( 
			'pcat_id' => 3, 
			'pcat_name' => 'Mobile',
			'pcat_slug' => 'mobile', 
			'pcat_desc' => '',
			'pcat_url' => '',
		) 
	);