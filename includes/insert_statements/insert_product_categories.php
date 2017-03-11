<?php 

//6. Product Categories Insert Statements
	$wpdb->insert( 
		$table_pcs, 
		array( 
			'pcat_id' => 1, 
			'product_id' => 1,
		) 
	);

	$wpdb->insert( 
		$table_pcs, 
		array( 
			'pcat_id' => 2, 
			'product_id' => 2,
		) 
	);