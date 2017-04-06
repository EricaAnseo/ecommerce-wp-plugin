<?php 

function simp_ec_shortcode_all_product ($atts)
{

	$results = null;

	$simp_ec_att = shortcode_atts( array(
        'product' => 'all',
        'category' => 'none',
    ), $atts );

	global $wpdb; 
	$table_product = $wpdb->prefix . "simp_ec_product"; 
	$table_pc = $wpdb->prefix . "simp_ec_product_category"; 



	if ($simp_ec_att['category'] == 'none'){	
		$results = $wpdb->get_results( 'SELECT * FROM ' . $table_product);
	} 
	
	else 
	{
		//$results = $wpdb->get_results( 'SELECT * FROM ' . $table_pc . ' WHERE pcat_name = \'' . $simp_ec_att['category'] . '\'' );
	}
		
	if($results){ 
		foreach ( $results as $product ){ ?>
			<span class="simp_ec_product product<?php echo $product->product_id; ?>">
				<span class="simp_ec_product_name"><?php echo $product->pname; ?></span>
				<span class="simp_ec_product_sku"><?php echo $product->product_sku; ?></span>
				<span class="simp_ec_product_desc"><?php echo $product->pdesc; ?></span>
				<span class="simp_ec_product_short_desc"><?php echo $product->pshortdesc; ?></span>
				<span class="simp_ec_product_price"><?php echo $product->pprice; ?></span>
			</span>
   <?php }
		//echo $simp_ec_att['category']; 
	}

	

}

add_shortcode('product', 'simp_ec_shortcode_all_product');





?>