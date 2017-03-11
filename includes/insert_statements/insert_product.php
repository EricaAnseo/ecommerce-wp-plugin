<?php 

//5. Product Insert Statement
	$wpdb->insert( 
		$table_product, 
		array( 
			'product_id' => 1, 
			'product_sku' => '',
			'pname' => 'Dell Inspiron 15 Gaming', 
			'pdesc' => 'Gaming, Wireless and Bluetooth, Thermal Cooling, Discrete Graphic 4GB vRam, Subwoofer',
			'pshortdesc' => 'Gaming Laptop',
			'pprice' => 555.55,
		) 
	);

	$wpdb->insert( 
		$table_product, 
		array( 
			'product_id' => 2, 
			'product_sku' => '83hdkw',
			'pname' => 'Dell Inspiron', 
			'pdesc' => 'Gaming Laptop',
			'pshortdesc' => 'Gaming Laptop',
			'pprice' => 1125.95,
		) 
	);