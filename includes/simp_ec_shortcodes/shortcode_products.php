<?php 

function simp_ec_shortcode_all_product ($atts)
{

	$results_prod = null;
	$results_prod_cat = null;

	$simp_ec_att = shortcode_atts( array(
        'product' => 'all',
        'category' => 'none',
    ), $atts );

	global $wpdb; 
	$table_product = $wpdb->prefix . "simp_ec_product"; 
	$table_pc = $wpdb->prefix . "simp_ec_product_category"; 
	$table_pcs = $wpdb->prefix . "simp_ec_product_categories"; 


	if ($simp_ec_att['category'] == 'none' && $simp_ec_att['product'] == 'all'){	
		$results_prod = $wpdb->get_results( 'SELECT * FROM ' . $table_product);
	} 

	else if ($simp_ec_att['category'] == 'all')
	{
		$results_cat = $wpdb->get_results( 'SELECT * FROM ' . $table_pc);
	}
	
	else if ($simp_ec_att['category'] != null || $simp_ec_att['category'] != '')
	{
		$results_prod_cat = $wpdb->get_results( 'SELECT * FROM ' . $table_product . 
			' INNER JOIN ' . $table_pcs . ' ON ' .  $table_pcs .'.product_id = ' . $table_product . '.product_id INNER JOIN ' . $table_pc . ' ON ' . $table_pcs . '.pcat_id = ' . $table_pc . '.pcat_id WHERE ' . $table_pc . '.pcat_name = \'' . $simp_ec_att['category'] . '\''  );
	}
		
	if($results_prod){ 
		foreach ( $results_prod as $product ){ ?>
			<span class="simp_ec_product product<?php echo $product->product_id; ?>">
				<?php if($product->pname != null || $product->pname != '') { ?>
					<span class="simp_ec_product_name"><?php echo $product->pname; ?></span>
				<?php } 
					if($product->product_sku != null || $product->product_sku != '') {
				 ?>
					<span class="simp_ec_product_sku"><?php echo $product->product_sku; ?></span>
				<?php } 
					if($product->pdesc != null || $product->pdesc != '') {
				?>	
					<span class="simp_ec_product_desc"><?php echo $product->pdesc; ?></span>
				<?php } 
					if($product->pshortdesc || $product->pshortdesc != '') {
				?>	
					<span class="simp_ec_product_short_desc"><?php echo $product->pshortdesc; ?></span>
				<?php } 
					if($product->pprice != null || $product->pprice != '') {
				 ?>	
					<span class="simp_ec_product_price"><?php echo $product->pprice; ?></span>
				<?php } ?>
			</span>
   	<?php }
		//echo $simp_ec_att['category']; 
	}

	if($results_prod_cat){
		foreach ( $results_prod_cat as $prod_category ){ ?>
			<span>
				<span class="simp_ec_category_name"><?php echo $prod_category->pname; ?></span>
				<span class="simp_ec_category_name"><?php echo $prod_category->pcat_name; ?></span>
			</span>


<?php 
		}
	}

}

add_shortcode('product', 'simp_ec_shortcode_all_product');





?>