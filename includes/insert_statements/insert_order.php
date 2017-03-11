<?php 
//10. Order Table
	$wpdb->insert( 
		$table_pcs, 
		array(
			'customer_id' => 1, 
			'product_id' => 1, 
			'order_amount' => 1,
		) 
	);