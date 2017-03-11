<?php 	
	//2. Product Type Insert Statement
	$wpdb->insert( 
		$table_pat, 
		array( 
			'ptype_id' => 1, 
			'ptype_name' => 'Colour',
			'ptype_desc' => 'The colour of a given product. A product can be available in a varity of colours. This type does not include a product that comes in a mix of colours.',
		) 
	);

	$wpdb->insert( 
		$table_pat, 
		array( 
			'ptype_id' => 2, 
			'ptype_name' => 'RAM',
			'ptype_desc' => 'Random Access Memorry. Only appliable to technical products such as computers, tablets, and phones.',
		) 
	);

	$wpdb->insert( 
		$table_pat, 
		array( 
			'ptype_id' => 3, 
			'ptype_name' => 'Resolution',
			'ptype_desc' => 'The quality of the screen. Pixels per inch. Only appliable to technical products such as computers, tablets, and phones.',
		) 
	);

	$wpdb->insert( 
		$table_pat, 
		array( 
			'ptype_id' => 4, 
			'ptype_name' => 'Screen Size',
			'ptype_desc' => 'The size of the display, measured in inches. Only appliable to technical products such as computers, tablets, and phones.',
		) 
	);