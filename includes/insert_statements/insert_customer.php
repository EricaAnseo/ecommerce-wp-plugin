<?php 
//9. Customer Table
	$wpdb->insert( 
		$table_pcs, 
		array(
			'customer_id' => 1, 
			'customer_name' => 'Koda Chai', 
			'customer_address' => '123 Address Goes here, Dublin, Ireland.',
			'customer_email ' => 'mail@mail.mail',
		) 
	);