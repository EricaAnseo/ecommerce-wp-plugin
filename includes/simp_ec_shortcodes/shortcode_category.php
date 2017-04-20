<?php 

function simp_ec_shortcode_category ($atts)
{
	include_once (SIMPLIFIED_ECOMMERCE_ROOT_PATH . 'includes/table_names.php');
	$results = null;
	$results_products = null;

	global $wpdb;
	$table_name = $wpdb->prefix . "test";
	$table_pa = $wpdb->prefix . "simp_ec_product_attribute"; 
	$table_pat = $wpdb->prefix . "simp_ec_product_attribute_type"; 
	$table_pt = $wpdb->prefix . "simp_ec_product_type"; 
	$table_pct = $wpdb->prefix . "simp_ec_product_category_type"; 
	$table_pc = $wpdb->prefix . "simp_ec_product_category"; 
	$table_pcs = $wpdb->prefix . "simp_ec_product_categories"; 
	$table_product = $wpdb->prefix . "simp_ec_product"; 
	$table_pv = $wpdb->prefix . "simp_ec_product_variable"; 
	$table_order = $wpdb->prefix . "simp_ec_order"; 
	$table_customer = $wpdb->prefix . "simp_ec_customer";

	$simp_ec_att = shortcode_atts( array(
        'name' => 'all',
        'description' => 'all',
        'slug' => 'all', 
        'product' => 'none'
    ), $atts );

	//[category] view all and/or hide some values
	if (($simp_ec_att['name'] == 'all' && $simp_ec_att['description'] == 'all' && $simp_ec_att['slug'] == 'all' && $simp_ec_att['product'] == 'none') || 
		($simp_ec_att['name'] == 'all' && $simp_ec_att['description'] == 'all' && $simp_ec_att['slug'] == 'hidden' && $simp_ec_att['product'] == 'none') || 
		($simp_ec_att['name'] == 'all' && $simp_ec_att['description'] == 'hidden' && $simp_ec_att['slug'] == 'hidden' && $simp_ec_att['product'] == 'none') || 
		($simp_ec_att['name'] == 'all' && $simp_ec_att['description'] == 'hidden' && $simp_ec_att['slug'] == 'all' && $simp_ec_att['product'] == 'none') || 
		($simp_ec_att['name'] == 'hidden' && $simp_ec_att['description'] == 'all' && $simp_ec_att['slug'] == 'all' && $simp_ec_att['product'] == 'none') || 
		($simp_ec_att['name'] == 'hidden' && $simp_ec_att['description'] == 'hidden' && $simp_ec_att['slug'] == 'all' && $simp_ec_att['product'] == 'none') || 
		($simp_ec_att['name'] == 'hidden' && $simp_ec_att['description'] == 'all' && $simp_ec_att['slug'] == 'hidden' && $simp_ec_att['product'] == 'none')){	
		$results = $wpdb->get_results( 'SELECT * FROM ' . $table_pc);
	} 

	//[category name=""] view all and/or hide some values
	else if (($simp_ec_att['name'] != 'all' && $simp_ec_att['name'] != null && $simp_ec_att['description'] == 'all' && $simp_ec_att['slug'] == 'all' && $simp_ec_att['product'] == 'none') || 
		($simp_ec_att['name'] != 'all' && $simp_ec_att['name'] != null && $simp_ec_att['description'] == 'hidden' && $simp_ec_att['slug'] == 'all' && $simp_ec_att['product'] == 'none') || 
		($simp_ec_att['name'] != 'all' && $simp_ec_att['name'] != null && $simp_ec_att['description'] == 'all' && $simp_ec_att['slug'] == 'hidden' && $simp_ec_att['product'] == 'none') || 
		($simp_ec_att['name'] != 'all' && $simp_ec_att['name'] != null && $simp_ec_att['description'] == 'hidden' && $simp_ec_att['slug'] == 'hidden' && $simp_ec_att['product'] == 'none')
		){	
		$results = $wpdb->get_results( 'SELECT * FROM ' . $table_pc . ' WHERE pcat_name = "' . $simp_ec_att['name'] . '"' );
	}

	//[category slug=""] view all and/or hide some values
	else if (($simp_ec_att['name'] == 'all' && $simp_ec_att['description'] == 'all' && $simp_ec_att['slug'] != 'all' && $simp_ec_att['slug'] != null && $simp_ec_att['product'] == 'none') || 
		($simp_ec_att['name'] == 'all' && $simp_ec_att['description'] == 'hidden' && $simp_ec_att['slug'] != 'all' && $simp_ec_att['slug'] != null && $simp_ec_att['product'] == 'none') || 
		($simp_ec_att['name'] == 'hidden' && $simp_ec_att['description'] == 'all' && $simp_ec_att['slug'] != 'all' && $simp_ec_att['slug'] != null && $simp_ec_att['product'] == 'none') || 
		($simp_ec_att['name'] == 'hidden' && $simp_ec_att['description'] == 'hidden' && $simp_ec_att['slug'] != 'all' && $simp_ec_att['slug'] != null && $simp_ec_att['product'] == 'none')){	
		$results = $wpdb->get_results( 'SELECT * FROM ' . $table_pc . ' WHERE pcat_slug = "' . $simp_ec_att['slug'] . '"' );
	}

	//[category product="all"] show all categories and products of each category
	else if (($simp_ec_att['name'] == 'all' && $simp_ec_att['description'] == 'all' && $simp_ec_att['slug'] == 'all' && $simp_ec_att['product'] == 'all') || 
		($simp_ec_att['name'] == 'all' && $simp_ec_att['description'] == 'all' && $simp_ec_att['slug'] == 'hidden' && $simp_ec_att['product'] == 'all') ||
		($simp_ec_att['name'] == 'all' && $simp_ec_att['description'] == 'hidden' && $simp_ec_att['slug'] == 'all' && $simp_ec_att['product'] == 'all') ||
		($simp_ec_att['name'] == 'hidden' && $simp_ec_att['description'] == 'all' && $simp_ec_att['slug'] == 'all' && $simp_ec_att['product'] == 'all') ||
		($simp_ec_att['name'] == 'hidden' && $simp_ec_att['description'] == 'all' && $simp_ec_att['slug'] == 'hidden' && $simp_ec_att['product'] == 'all') ||
		($simp_ec_att['name'] == 'hidden' && $simp_ec_att['description'] == 'hidden' && $simp_ec_att['slug'] == 'all' && $simp_ec_att['product'] == 'all') ||
		($simp_ec_att['name'] == 'all' && $simp_ec_att['description'] == 'hidden' && $simp_ec_att['slug'] == 'hidden' && $simp_ec_att['product'] == 'all') ||
		($simp_ec_att['name'] == 'hidden' && $simp_ec_att['description'] == 'hidden' && $simp_ec_att['slug'] == 'hidden' && $simp_ec_att['product'] == 'all')){
		$results = $wpdb->get_results( 'SELECT * FROM ' . $table_pc . ' JOIN ' . $table_pcs . ' ON ' . $table_pcs . '.pcat_id = ' . $table_pc . '.pcat_id JOIN ' . $table_product . ' ON ' . $table_product . '.product_id = ' . $table_pcs . '.product_id ');
		$results_products = $wpdb->get_results('SELECT * FROM ' . $table_product);
	}

	//[category name="" product="all"] show all categories and products of each category
	else if (($simp_ec_att['name'] != 'all' && $simp_ec_att['name'] != null && $simp_ec_att['description'] == 'all' && $simp_ec_att['slug'] == 'all' && $simp_ec_att['product'] == 'all') || 
		($simp_ec_att['name'] != 'all' && $simp_ec_att['name'] != null && $simp_ec_att['description'] == 'hidden' && $simp_ec_att['slug'] == 'hidden' && $simp_ec_att['product'] == 'all') || 
		($simp_ec_att['name'] != 'all' && $simp_ec_att['name'] != null && $simp_ec_att['description'] == 'hidden' && $simp_ec_att['slug'] == 'all' && $simp_ec_att['product'] == 'all') || 
		($simp_ec_att['name'] != 'all' && $simp_ec_att['name'] != null && $simp_ec_att['description'] == 'all' && $simp_ec_att['slug'] == 'hidden' && $simp_ec_att['product'] == 'all')){
		$results = $wpdb->get_results( 'SELECT * FROM ' . $table_pc . ' JOIN ' . $table_pcs . ' ON ' . $table_pcs . '.pcat_id = ' . $table_pc . '.pcat_id JOIN ' . $table_product . ' ON ' . $table_product . '.product_id = ' . $table_pcs . '.product_id WHERE ' . $table_pc . '.pcat_name = "' . $simp_ec_att['name'] . '"');
		$results_products = $wpdb->get_results('SELECT * FROM ' . $table_product);
	}

	//[category slug="" product="all"] show all categories and products of each category
	else if (($simp_ec_att['slug'] != 'all' && $simp_ec_att['slug'] != null && $simp_ec_att['description'] == 'all' && $simp_ec_att['name'] == 'all' && $simp_ec_att['product'] == 'all') || 
		($simp_ec_att['slug'] != 'all' && $simp_ec_att['slug'] != null && $simp_ec_att['description'] == 'hidden' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['product'] == 'all') || 
		($simp_ec_att['slug'] != 'all' && $simp_ec_att['slug'] != null && $simp_ec_att['description'] == 'hidden' && $simp_ec_att['name'] == 'all' && $simp_ec_att['product'] == 'all') || 
		($simp_ec_att['slug'] != 'all' && $simp_ec_att['slug'] != null && $simp_ec_att['description'] == 'all' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['product'] == 'all')){
		$results = $wpdb->get_results( 'SELECT * FROM ' . $table_pc . ' JOIN ' . $table_pcs . ' ON ' . $table_pcs . '.pcat_id = ' . $table_pc . '.pcat_id JOIN ' . $table_product . ' ON ' . $table_product . '.product_id = ' . $table_pcs . '.product_id WHERE ' . $table_pc . '.pcat_slug = "' . $simp_ec_att['slug'] . '"');
		$results_products = $wpdb->get_results('SELECT * FROM ' . $table_product);
	}

	ob_start();
		if($results){ 
			foreach ($results as $category){ ?>
				<span class="simp_ec_category category<?php echo $category->pcat_id; ?>" style="display: block;">
					<?php if(!empty($category->pcat_name) && ($simp_ec_att['name'] != 'hidden')) { ?>
						<span class="simp_ec_category_name"><?php echo $category->pcat_name; ?></span>
					<?php } if(!empty($category->pcat_slug) && ($simp_ec_att['slug'] != 'hidden')) { ?>
						<span class="simp_ec_category_slug"><?php echo $category->pcat_slug; ?></span>
					<?php }	if(!empty($category->pcat_desc) && ($simp_ec_att['description'] != 'hidden')) {?>
						<span class="simp_ec_category_desc"><?php echo $category->pcat_desc; ?></span>
					<?php } if($results_products) { ?>
								<span class="simp_ec_category_product">
							<?php foreach ($results_products as $product){
									if($product->product_id == $category->product_id) { 
										if(!empty($category->pname)){ ?>
										<span class="simp_ec_category_product product<?php echo $product->product_id; ?>">
											<?php echo $category->pname; ?>	
										</span>

							<?php 		}
									}
							 	} ?>
								</span>
					<?php } ?>
				</span>
	  <?php } //foreach

		}//if
	return ob_get_clean();

}

add_shortcode('category', 'simp_ec_shortcode_category');

?>