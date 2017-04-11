<?php 

function simp_ec_shortcode_product ($atts)
{
	include_once (SIMPLIFIED_ECOMMERCE_ROOT_PATH . 'includes/table_names.php');
	$results = null;


	$simp_ec_att = shortcode_atts( array(
        'product_id' => 'all',
        'product_name' => 'all',
        'category' => 'none',
        'heading' => 'off'
    ), $atts );

	if ($simp_ec_att['category'] == 'none' && $simp_ec_att['product_id'] == 'all' && $simp_ec_att['product_name'] == 'all'){	
		$results = $wpdb->get_results( 'SELECT * FROM ' . $table_product);
	} 

	else if ($simp_ec_att['category'] == 'all' && $simp_ec_att['product_id'] == 'all' && $simp_ec_att['product_name'] == 'all')
	{
		$results = $wpdb->get_results( 'SELECT * FROM ' . $table_product . ' LEFT JOIN ' . $table_pcs . ' ON ' .  $table_pcs .'.product_id = ' . $table_product . '.product_id LEFT JOIN ' . $table_pc . ' ON ' . $table_pcs . '.pcat_id = ' . $table_pc . '.pcat_id GROUP BY ' . $table_product . '.product_id' );

		//$results = $wpdb->get_results( 'SELECT '  . $table_product .  '*, GROUP_CONCAT(DISTINCT ' . $table_product . '.product_id SEPARATOR \',\' )  FROM ' . $table_product . ' LEFT JOIN ' . $table_pcs . ' ON ' .  $table_pcs .'.product_id = ' . $table_product . '.product_id LEFT JOIN ' . $table_pc . ' ON ' . $table_pcs . '.pcat_id = ' . $table_pc . '.pcat_id GROUP BY ' . $table_product . '.product_id');
	}
	
	else if ($simp_ec_att['category'] != null && $simp_ec_att['category'] != '')
	{
		$results = $wpdb->get_results( 'SELECT * FROM ' . $table_product . ' INNER JOIN ' . $table_pcs . ' ON ' .  $table_pcs .'.product_id = ' . $table_product . '.product_id INNER JOIN ' . $table_pc . ' ON ' . $table_pcs . '.pcat_id = ' . $table_pc . '.pcat_id WHERE ' . $table_pc . '.pcat_name = \'' . $simp_ec_att['category'] . '\''  );
	}


		
	if($results){ 
		$no_results = count($results);
		foreach ( $results as $product ){ 

			?>
			<span class="simp_ec_product product<?php echo $product->product_id; ?>" style="display: block;">
				<!-- -->
				<?php if(!empty($product->pname)) { ?>
					<span class="simp_ec_product_name"><?php echo $product->pname; ?></span>
				<?php } if(!empty($product->product_sku)) { ?>
					<span class="simp_ec_product_sku"><?php echo $product->product_sku; ?></span>
				<?php } if(!empty($product->pdesc)) { ?>	
					<span class="simp_ec_product_desc"><?php echo $product->pdesc; ?></span>
				<?php } if(!empty($product->pshortdesc)) { ?>	
					<span class="simp_ec_product_short_desc"><?php echo $product->pshortdesc; ?></span>
				<?php } if(!empty($product->pprice)) { ?>	
					<span class="simp_ec_product_price"><?php echo $product->pprice; ?></span>
				<?php } if(!empty($product->pcat_name)) {?>	
					<span class="simp_ec_product_price"><?php echo $product->pcat_name; ?></span>
				<?php } ?>	
			</span>
			<hr >
  <?php }

  		echo $no_results;

	}

}

add_shortcode('product', 'simp_ec_shortcode_product');

?>