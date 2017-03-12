<?php 

	//If autosave is occuring, abort. 
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {return;
	}

	global $wpdb;
	$table_product = $wpdb->prefix . "simp_ec_product"; 

	$pname=$_POST["pname"]; 
	$sku=$_POST["sku"]; 
	$pdesc=$_POST["pdesc"]; 
	$pshortdesc=$_POST["pshortdesc"]; 
	$pprice=$_POST["pprice"]; 

	$wpdb->insert( 
		$table_product, 
		array( 
			//'product_id' => 1, 
			'product_sku' => $sku,
			'pname' => $pname, 
			'pdesc' => $pdesc,
			'pshortdesc' => $pshortdesc,
			'pprice' => $pprice,
		) 
	);
