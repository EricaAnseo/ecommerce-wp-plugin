<?php 
//8. Variable Product Insert Statements	
	$wpdb->insert( 
		$table_pcs, 
		array(
			'product_id' => 1, 
			'vproduct_id' => 1, 
			'vproduct_name' => 'Product name in Pink',
			'vproduct_price' => 34.56,
			'vproduct_stock' => 4,
			'vproduct_sku' => 'nn4k32',
			'ptype_id' => '1',
		) 
	);