<?php 
/**
 * @since 		1.0.0
 * @package		Simplified_Ecommerce
**/
function simp_ec_shortcode_product ($atts)
{
	include_once (SIMPLIFIED_ECOMMERCE_ROOT_PATH . 'includes/table_names.php');
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
	$results = null;
	$results_product_category = null;

	$simp_ec_att = shortcode_atts( array(
        'id' => 'all',
        'name' => 'all',
        'sku' => 'all',
        'price' => 'all',
        'short_description' => 'show',
        'description' => 'show',
        'category' => 'none',
       	'product_type' => 'none',
        'attributes' => 'none'
    ), $atts );

	//[product]
	if (($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['category'] == 'none' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['category'] == 'none' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') ||
		($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['category'] == 'none' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') ||
		($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['category'] == 'none' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') ||
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['category'] == 'none' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') ||
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['category'] == 'none' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') ||
		($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['category'] == 'none' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') ||
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['category'] == 'none' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none')){	
		$results = $wpdb->get_results( 'SELECT * FROM ' . $table_product);
	}

	//[product id="<number>"]
	else if (($simp_ec_att['id'] != 'all' && $simp_ec_att['id'] != null && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['category'] == 'none' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['id'] != 'all' && $simp_ec_att['id'] != null && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['category'] == 'none' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['id'] != 'all' && $simp_ec_att['id'] != null && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['category'] == 'none' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') ||
		($simp_ec_att['id'] != 'all' && $simp_ec_att['id'] != null && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['category'] == 'none' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none')){	
		$results = $wpdb->get_results( 'SELECT * FROM ' . $table_product . ' WHERE product_id = "' . $simp_ec_att['id'] . '"');
	}

	//[product name="name"]
	else if (($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] != null && $simp_ec_att['name'] != 'all' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['category'] == 'none' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') ||
		($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] != null && $simp_ec_att['name'] != 'all' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['category'] == 'none' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] != null && $simp_ec_att['name'] != 'all' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['category'] == 'none' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] != null && $simp_ec_att['name'] != 'all' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['category'] == 'none' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none')){	
		$results = $wpdb->get_results( 'SELECT * FROM ' . $table_product . ' WHERE pname = "' . $simp_ec_att['name'] . '"');
	}

	//[product sku="sku code"] 
	else if (($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] != null && $simp_ec_att['sku'] != 'all' && $simp_ec_att['category'] == 'none' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] != null && $simp_ec_att['sku'] != 'all' && $simp_ec_att['category'] == 'none' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] != null && $simp_ec_att['sku'] != 'all' && $simp_ec_att['category'] == 'none' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] != null && $simp_ec_att['sku'] != 'all' && $simp_ec_att['category'] == 'none' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none')){	
		$results = $wpdb->get_results( 'SELECT * FROM ' . $table_product . ' WHERE product_sku = "' . $simp_ec_att['sku'] . '"');
	}

	//[product category="all"]
	else if (($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['category'] == 'all' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['category'] == 'all' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') ||
		($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['category'] == 'all' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') ||
		($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['category'] == 'all' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') ||
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['category'] == 'all' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') ||
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['category'] == 'all' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') ||
		($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['category'] == 'all' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') ||
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['category'] == 'all' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none')){
		//Join tables product, product category, and product categories 
		$results = $wpdb->get_results( 'SELECT * FROM ' . $table_product . ' JOIN ' . $table_pcs . ' ON ' .  $table_pcs .'.product_id = ' . $table_product . '.product_id JOIN ' . $table_pc . ' ON ' . $table_pcs . '.pcat_id = ' . $table_pc . '.pcat_id GROUP BY ' . $table_product . '.product_id' );
		$results_product_category = $wpdb->get_results( 'SELECT * FROM ' . $table_pcs . ' JOIN ' . $table_pc . ' ON ' .  $table_pcs .'.pcat_id = ' . $table_pc . '.pcat_id JOIN ' . $table_product . ' ON ' .  $table_product .'.product_id = ' . $table_pcs . '.product_id');
	}

	//[product id="<number>" category="all"] 
	else if (($simp_ec_att['id'] != 'all' && $simp_ec_att['id'] != null && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['category'] == 'all' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['id'] != 'all' && $simp_ec_att['id'] != null && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['category'] == 'all' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') ||
		($simp_ec_att['id'] != 'all' && $simp_ec_att['id'] != null && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['category'] == 'all' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') ||
		($simp_ec_att['id'] != 'all' && $simp_ec_att['id'] != null && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['category'] == 'all' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none')){
		//Join tables product, product category, and product categories 
		$results = $wpdb->get_results( 'SELECT * FROM ' . $table_product . ' JOIN ' . $table_pcs . ' ON ' .  $table_pcs .'.product_id = ' . $table_product . '.product_id JOIN ' . $table_pc . ' ON ' . $table_pcs . '.pcat_id = ' . $table_pc . '.pcat_id WHERE ' . $table_product . '.product_id = "' . $simp_ec_att['id'] . '" GROUP BY ' . $table_product . '.product_id' );
		$results_product_category = $wpdb->get_results( 'SELECT * FROM ' . $table_pcs . ' JOIN ' . $table_pc . ' ON ' .  $table_pcs .'.pcat_id = ' . $table_pc . '.pcat_id JOIN ' . $table_product . ' ON ' .  $table_product .'.product_id = ' . $table_pcs . '.product_id WHERE ' . $table_product . '.product_id = "' . $simp_ec_att['id'] . '"' );
	}

	//[product name="<product name>" category="all"] 
	else if (($simp_ec_att['name'] != 'all' && $simp_ec_att['name'] != null && $simp_ec_att['id'] == 'all' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['category'] == 'all' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['name'] != 'all' && $simp_ec_att['name'] != null && $simp_ec_att['id'] == 'hidden' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['category'] == 'all' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') ||
		($simp_ec_att['name'] != 'all' && $simp_ec_att['name'] != null && $simp_ec_att['id'] == 'all' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['category'] == 'all' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') ||
		($simp_ec_att['name'] != 'all' && $simp_ec_att['name'] != null && $simp_ec_att['id'] == 'hidden' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['category'] == 'all' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none')){ 
		$results = $wpdb->get_results( 'SELECT * FROM ' . $table_product . ' JOIN ' . $table_pcs . ' ON ' .  $table_pcs .'.product_id = ' . $table_product . '.product_id JOIN ' . $table_pc . ' ON ' . $table_pcs . '.pcat_id = ' . $table_pc . '.pcat_id WHERE ' . $table_product . '.pname = "' . $simp_ec_att['name'] . '" GROUP BY ' . $table_product . '.product_id' );
		$results_product_category = $wpdb->get_results( 'SELECT * FROM ' . $table_pcs . ' JOIN ' . $table_pc . ' ON ' .  $table_pcs .'.pcat_id = ' . $table_pc . '.pcat_id JOIN ' . $table_product . ' ON ' .  $table_product .'.product_id = ' . $table_pcs . '.product_id WHERE ' . $table_product . '.pname = "' . $simp_ec_att['name'] . '"' );
	}

	//[product sku="<sku code>" category="all"]  
	else if (($simp_ec_att['sku'] != 'all' && $simp_ec_att['sku'] != null && $simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'all' && $simp_ec_att['category'] == 'all' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['sku'] != 'all' && $simp_ec_att['sku'] != null && $simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'all' && $simp_ec_att['category'] == 'all' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') ||
		($simp_ec_att['sku'] != 'all' && $simp_ec_att['sku'] != null && $simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['category'] == 'all' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') ||
		($simp_ec_att['sku'] != 'all' && $simp_ec_att['sku'] != null && $simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['category'] == 'all' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none')){ 
		$results = $wpdb->get_results( 'SELECT * FROM ' . $table_product . ' JOIN ' . $table_pcs . ' ON ' .  $table_pcs .'.product_id = ' . $table_product . '.product_id JOIN ' . $table_pc . ' ON ' . $table_pcs . '.pcat_id = ' . $table_pc . '.pcat_id WHERE ' . $table_product . '.product_sku = "' . $simp_ec_att['sku'] . '" GROUP BY ' . $table_product . '.product_id' );
		$results_product_category = $wpdb->get_results( 'SELECT * FROM ' . $table_pcs . ' JOIN ' . $table_pc . ' ON ' .  $table_pcs .'.pcat_id = ' . $table_pc . '.pcat_id JOIN ' . $table_product . ' ON ' .  $table_product .'.product_id = ' . $table_pcs . '.product_id WHERE ' . $table_product . '.product_sku = "' . $simp_ec_att['sku'] . '"' );
	}

	//[product category="name"]
	else if (($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['category'] != 'all' && $simp_ec_att['category'] != null && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['category'] != 'all' && $simp_ec_att['category'] != null && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') ||
		($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'all' && $$simp_ec_att['category'] != 'all' && $simp_ec_att['category'] != null && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') ||
		($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['category'] != 'all' && $simp_ec_att['category'] != null && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') ||
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['category'] != 'all' && $simp_ec_att['category'] != null && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') ||
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['category'] != 'all' && $simp_ec_att['category'] != null && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') ||
		($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['category'] != 'all' && $simp_ec_att['category'] != null && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') ||
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'hidden' && $$simp_ec_att['category'] != 'all' && $simp_ec_att['category'] != null && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none')){
		$results = $wpdb->get_results( 'SELECT * FROM ' . $table_product . ' JOIN ' . $table_pcs . ' ON ' .  $table_pcs .'.product_id = ' . $table_product . '.product_id JOIN ' . $table_pc . ' ON ' . $table_pcs . '.pcat_id = ' . $table_pc . '.pcat_id  WHERE ' . $table_pc . '.pcat_name = "' . $simp_ec_att['category'] . '" GROUP BY ' . $table_product . '.product_id' );
	}

	//[product id="<number>" category="name"] 
	else if (($simp_ec_att['id'] != 'all' && $simp_ec_att['id'] != null && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['category'] != 'all' && $simp_ec_att['category'] != null && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['id'] != 'all' && $simp_ec_att['id'] != null && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['category'] != 'all' && $simp_ec_att['category'] != null && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') ||
		($simp_ec_att['id'] != 'all' && $simp_ec_att['id'] != null && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['category'] != 'all' && $simp_ec_att['category'] != null && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') ||
		($simp_ec_att['id'] != 'all' && $simp_ec_att['id'] != null && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['category'] != 'all' && $simp_ec_att['category'] != null && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none')){
		$results = $wpdb->get_results( 'SELECT * FROM ' . $table_product . ' JOIN ' . $table_pcs . ' ON ' .  $table_pcs .'.product_id = ' . $table_product . '.product_id JOIN ' . $table_pc . ' ON ' . $table_pcs . '.pcat_id = ' . $table_pc . '.pcat_id WHERE ' . $table_product . '.product_id = "' . $simp_ec_att['id'] . '" AND ' . $table_pc . '.pcat_name = "' . $simp_ec_att['category'] . '" GROUP BY ' . $table_product . '.product_id' );
		$results_product_category = $wpdb->get_results( 'SELECT * FROM ' . $table_pcs . ' JOIN ' . $table_pc . ' ON ' .  $table_pcs .'.pcat_id = ' . $table_pc . '.pcat_id JOIN ' . $table_product . ' ON ' .  $table_product .'.product_id = ' . $table_pcs . '.product_id WHERE ' . $table_product . '.product_id = "' . $simp_ec_att['id'] . '" AND ' . $table_pc . '.pcat_name = "' . $simp_ec_att['category'] . '"' );
	}

	//[product name="<product name>" category="name"] 
	else if (($simp_ec_att['name'] != 'all' && $simp_ec_att['name'] != null && $simp_ec_att['id'] == 'all' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['category'] != 'all' && $simp_ec_att['category'] != null && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['name'] != 'all' && $simp_ec_att['name'] != null && $simp_ec_att['id'] == 'hidden' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['category'] != 'all' && $simp_ec_att['category'] != null && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') ||
		($simp_ec_att['name'] != 'all' && $simp_ec_att['name'] != null && $simp_ec_att['id'] == 'all' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['category'] != 'all' && $simp_ec_att['category'] != null && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') ||
		($simp_ec_att['name'] != 'all' && $simp_ec_att['name'] != null && $simp_ec_att['id'] == 'hidden' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['category'] != 'all' && $simp_ec_att['category'] != null && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none')){
		$results = $wpdb->get_results( 'SELECT * FROM ' . $table_product . ' JOIN ' . $table_pcs . ' ON ' .  $table_pcs .'.product_id = ' . $table_product . '.product_id JOIN ' . $table_pc . ' ON ' . $table_pcs . '.pcat_id = ' . $table_pc . '.pcat_id WHERE ' . $table_product . '.pname = "' . $simp_ec_att['name'] . '" AND ' . $table_pc . '.pcat_name = "' . $simp_ec_att['category'] . '" GROUP BY ' . $table_product . '.product_id' );
		$results_product_category = $wpdb->get_results( 'SELECT * FROM ' . $table_pcs . ' JOIN ' . $table_pc . ' ON ' .  $table_pcs .'.pcat_id = ' . $table_pc . '.pcat_id JOIN ' . $table_product . ' ON ' .  $table_product .'.product_id = ' . $table_pcs . '.product_id WHERE ' . $table_product . '.pname = "' . $simp_ec_att['name'] . '" AND ' . $table_pc . '.pcat_name = "' . $simp_ec_att['category'] . '"' );
	}

	//[product sku="<sku>" category="name"] 
	else if (($simp_ec_att['sku'] != 'all' && $simp_ec_att['sku'] != null && $simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'all' && $simp_ec_att['category'] != 'all' && $simp_ec_att['category'] != null && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['sku'] != 'all' && $simp_ec_att['sku'] != null && $simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'all' && $simp_ec_att['category'] != 'all' && $simp_ec_att['category'] != null && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') ||
		($simp_ec_att['sku'] != 'all' && $simp_ec_att['sku'] != null && $simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['category'] != 'all' && $simp_ec_att['category'] != null && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') ||
		($simp_ec_att['sku'] != 'all' && $simp_ec_att['sku'] != null && $simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['category'] != 'all' && $simp_ec_att['category'] != null && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none')){
		$results = $wpdb->get_results( 'SELECT * FROM ' . $table_product . ' JOIN ' . $table_pcs . ' ON ' .  $table_pcs .'.product_id = ' . $table_product . '.product_id JOIN ' . $table_pc . ' ON ' . $table_pcs . '.pcat_id = ' . $table_pc . '.pcat_id WHERE ' . $table_product . '.product_sku = "' . $simp_ec_att['sku'] . '" AND ' . $table_pc . '.pcat_name = "' . $simp_ec_att['category'] . '" GROUP BY ' . $table_product . '.product_id' );
		$results_product_category = $wpdb->get_results( 'SELECT * FROM ' . $table_pcs . ' JOIN ' . $table_pc . ' ON ' .  $table_pcs .'.pcat_id = ' . $table_pc . '.pcat_id JOIN ' . $table_product . ' ON ' .  $table_product .'.product_id = ' . $table_pcs . '.product_id WHERE ' . $table_product . '.product_sku = "' . $simp_ec_att['sku'] . '" AND ' . $table_pc . '.pcat_name = "' . $simp_ec_att['category'] . '"' );
	}

	//[product product_type="all"]
	else if (($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['category'] == 'none' && $simp_ec_att['product_type'] == 'all' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['category'] == 'none' && $simp_ec_att['product_type'] == 'all' && $simp_ec_att['attributes'] == 'none') ||
		($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['category'] == 'none' && $simp_ec_att['product_type'] == 'all' && $simp_ec_att['attributes'] == 'none') ||
		($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['category'] == 'none' && $simp_ec_att['product_type'] == 'all' && $simp_ec_att['attributes'] == 'none') ||
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['category'] == 'none' && $simp_ec_att['product_type'] == 'all' && $simp_ec_att['attributes'] == 'none') ||
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['category'] == 'none' && $simp_ec_att['product_type'] == 'all' && $simp_ec_att['attributes'] == 'none') ||
		($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['category'] == 'none' && $simp_ec_att['product_type'] == 'all' && $simp_ec_att['attributes'] == 'none') ||
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['category'] == 'none' && $simp_ec_att['product_type'] == 'all' && $simp_ec_att['attributes'] == 'none')){
		//Join tables product, product category, and product categories 
		$results = $wpdb->get_results( 'SELECT * FROM ' . $table_product . ' JOIN ' . $table_pv . ' ON ' .  $table_pv .'.product_id = ' . $table_product . '.product_id JOIN ' . $table_pt . ' ON ' . $table_pt . '.ptype_id = ' . $table_pv . '.ptype_id  GROUP BY ' . $table_product . '.product_id' );

		$results_product_type = $wpdb->get_results( 'SELECT * FROM ' . $table_pv . ' JOIN ' . $table_pt . ' ON ' . $table_pt . '.ptype_id = ' . $table_pv . '.ptype_id ' );
	}

	//[product id="<number>" product_type="all"]
	else if (($simp_ec_att['id'] != 'all' && $simp_ec_att['id'] != null && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['category'] == 'none' && $simp_ec_att['product_type'] == 'all' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['id'] != 'all' && $simp_ec_att['id'] != null && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['category'] == 'none' && $simp_ec_att['product_type'] == 'all' && $simp_ec_att['attributes'] == 'none') ||
		($simp_ec_att['id'] != 'all' && $simp_ec_att['id'] != null && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['category'] == 'none' && $simp_ec_att['product_type'] == 'all' && $simp_ec_att['attributes'] == 'none') ||
		($simp_ec_att['id'] != 'all' && $simp_ec_att['id'] != null && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['category'] == 'none' && $simp_ec_att['product_type'] == 'all' && $simp_ec_att['attributes'] == 'none')){
		//Join tables product, product category, and product categories 
		$results = $wpdb->get_results( 'SELECT * FROM ' . $table_product . ' JOIN ' . $table_pv . ' ON ' .  $table_pv .'.product_id = ' . $table_product . '.product_id JOIN ' . $table_pt . ' ON ' . $table_pt . '.ptype_id = ' . $table_pv . '.ptype_id WHERE ' . $table_product  . '.product_id = "' . $simp_ec_att['id'] . '" GROUP BY ' . $table_product . '.product_id');

		$results_product_type = $wpdb->get_results( 'SELECT * FROM ' . $table_pv . ' JOIN ' . $table_pt . ' ON ' . $table_pt . '.ptype_id = ' . $table_pv . '.ptype_id');
	}

	//[product name="<product name>" product_type="all"] 
	else if (($simp_ec_att['name'] != 'all' && $simp_ec_att['name'] != null && $simp_ec_att['id'] == 'all' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['category'] == 'none' && $simp_ec_att['product_type'] == 'all' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['name'] != 'all' && $simp_ec_att['name'] != null && $simp_ec_att['id'] == 'hidden' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['category'] == 'none' && $simp_ec_att['product_type'] == 'all' && $simp_ec_att['attributes'] == 'none') ||
		($simp_ec_att['name'] != 'all' && $simp_ec_att['name'] != null && $simp_ec_att['id'] == 'all' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['category'] == 'none' && $simp_ec_att['product_type'] == 'all' && $simp_ec_att['attributes'] == 'none') ||
		($simp_ec_att['name'] != 'all' && $simp_ec_att['name'] != null && $simp_ec_att['id'] == 'hidden' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['category'] == 'none' && $simp_ec_att['product_type'] == 'all' && $simp_ec_att['attributes'] == 'none')){
		//Join tables product, product category, and product categories 
		$results = $wpdb->get_results( 'SELECT * FROM ' . $table_product . ' JOIN ' . $table_pv . ' ON ' .  $table_pv .'.product_id = ' . $table_product . '.product_id JOIN ' . $table_pt . ' ON ' . $table_pt . '.ptype_id = ' . $table_pv . '.ptype_id WHERE ' . $table_product  . '.pname = "' . $simp_ec_att['name'] . '" GROUP BY ' . $table_product . '.product_id');

		$results_product_type = $wpdb->get_results( 'SELECT * FROM ' . $table_pv . ' JOIN ' . $table_pt . ' ON ' . $table_pt . '.ptype_id = ' . $table_pv . '.ptype_id');
	}

	//[product sku="<sku code>" product_type="all"]
	else if (($simp_ec_att['sku'] != 'all' && $simp_ec_att['sku'] != null && $simp_ec_att['name'] == 'all' && $simp_ec_att['id'] == 'all' && $simp_ec_att['category'] == 'none' && $simp_ec_att['product_type'] == 'all' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['sku'] != 'all' && $simp_ec_att['sku'] != null && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['id'] == 'all' && $simp_ec_att['category'] == 'none' && $simp_ec_att['product_type'] == 'all' && $simp_ec_att['attributes'] == 'none') ||
		($simp_ec_att['sku'] != 'all' && $simp_ec_att['sku'] != null && $simp_ec_att['name'] == 'all' && $simp_ec_att['id'] == 'hidden' && $simp_ec_att['category'] == 'none' && $simp_ec_att['product_type'] == 'all' && $simp_ec_att['attributes'] == 'none') ||
		($simp_ec_att['sku'] != 'all' && $simp_ec_att['sku'] != null && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['id'] == 'hidden' && $simp_ec_att['category'] == 'none' && $simp_ec_att['product_type'] == 'all' && $simp_ec_att['attributes'] == 'none')){
		$results = $wpdb->get_results( 'SELECT * FROM ' . $table_product . ' JOIN ' . $table_pv . ' ON ' .  $table_pv .'.product_id = ' . $table_product . '.product_id JOIN ' . $table_pt . ' ON ' . $table_pt . '.ptype_id = ' . $table_pv . '.ptype_id WHERE ' . $table_product  . '.product_sku = "' . $simp_ec_att['sku'] . '" GROUP BY ' . $table_product . '.product_id');

		$results_product_type = $wpdb->get_results( 'SELECT * FROM ' . $table_pv . ' JOIN ' . $table_pt . ' ON ' . $table_pt . '.ptype_id = ' . $table_pv . '.ptype_id');
	}

	//[product product_type="productName"]
	else if (($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['category'] == 'none' &&  $simp_ec_att['product_type'] != null  && $simp_ec_att['product_type'] != 'none' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['category'] == 'none' &&  $simp_ec_att['product_type'] != null  && $simp_ec_att['product_type'] != 'none' && $simp_ec_att['attributes'] == 'none') ||
		($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['category'] == 'none' && $simp_ec_att['product_type'] != null  && $simp_ec_att['product_type'] != 'none' && $simp_ec_att['attributes'] == 'none') ||
		($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['category'] == 'none' && $simp_ec_att['product_type'] != null  && $simp_ec_att['product_type'] != 'none' && $simp_ec_att['attributes'] == 'none') ||
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['category'] == 'none' && $simp_ec_att['product_type'] != null  && $simp_ec_att['product_type'] != 'none' && $simp_ec_att['attributes'] == 'none') ||
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['category'] == 'none' && $simp_ec_att['product_type'] != null  && $simp_ec_att['product_type'] != 'none' && $simp_ec_att['attributes'] == 'none') ||
		($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['category'] == 'none' && $simp_ec_att['product_type'] != null  && $simp_ec_att['product_type'] != 'none' && $simp_ec_att['attributes'] == 'none') ||
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['category'] == 'none' && $simp_ec_att['product_type'] != null  && $simp_ec_att['product_type'] != 'none' && $simp_ec_att['attributes'] == 'none')){
		//Join tables product, product category, and product categories 
		$results = $wpdb->get_results( 'SELECT * FROM ' . $table_product . ' JOIN ' . $table_pv . ' ON ' .  $table_pv .'.product_id = ' . $table_product . '.product_id JOIN ' . $table_pt . ' ON ' . $table_pt . '.ptype_id = ' . $table_pv . '.ptype_id  WHERE ' . $table_pt . '.ptype_name = "' . $simp_ec_att['product_type'] . '" GROUP BY ' . $table_product . '.product_id' );
		$product_types = $wpdb->get_results( 'SELECT * FROM ' . $table_pt . ' WHERE ptype_name = "' . $simp_ec_att['product_type'] . '"');
	}

	//[product id="<id>" product_type="<ptype_name>"]
	else if (($simp_ec_att['id'] != 'all' && $simp_ec_att['id'] != null && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['category'] == 'none' && $simp_ec_att['product_type'] != null  && $simp_ec_att['product_type'] != 'none' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['id'] != 'all' && $simp_ec_att['id'] != null && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['category'] == 'none' && $simp_ec_att['product_type'] != null  && $simp_ec_att['product_type'] != 'none' && $simp_ec_att['attributes'] == 'none') ||
		($simp_ec_att['id'] != 'all' && $simp_ec_att['id'] != null && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['category'] == 'none' && $simp_ec_att['product_type'] != null  && $simp_ec_att['product_type'] != 'none' && $simp_ec_att['attributes'] == 'none') ||
		($simp_ec_att['id'] != 'all' && $simp_ec_att['id'] != null && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['category'] == 'none' && $simp_ec_att['product_type'] != null  && $simp_ec_att['product_type'] != 'none' && $simp_ec_att['attributes'] == 'none')){
		$results = $wpdb->get_results( 'SELECT * FROM ' . $table_product . ' JOIN ' . $table_pv . ' ON ' .  $table_pv .'.product_id = ' . $table_product . '.product_id JOIN ' . $table_pt . ' ON ' . $table_pt . '.ptype_id = ' . $table_pv . '.ptype_id WHERE ' . $table_product  . '.product_id = "' . $simp_ec_att['id'] . '" AND ' . $table_pt . '.ptype_name = "' . $simp_ec_att['product_type'] . '" GROUP BY ' . $table_product . '.product_id');

		$results_product_type = $wpdb->get_results( 'SELECT * FROM ' . $table_pv . ' JOIN ' . $table_pt . ' ON ' . $table_pt . '.ptype_id = ' . $table_pv . '.ptype_id');
	}

	//[product name="<product name>" product_type="<ptype_name>"]
	else if (($simp_ec_att['name'] != 'all' && $simp_ec_att['name'] != null && $simp_ec_att['id'] == 'all' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['category'] == 'none' && $simp_ec_att['product_type'] != null  && $simp_ec_att['product_type'] != 'none' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['name'] != 'all' && $simp_ec_att['name'] != null && $simp_ec_att['id'] == 'hidden' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['category'] == 'none' && $simp_ec_att['product_type'] != null  && $simp_ec_att['product_type'] != 'none' && $simp_ec_att['attributes'] == 'none') ||
		($simp_ec_att['name'] != 'all' && $simp_ec_att['name'] != null && $simp_ec_att['id'] == 'all' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['category'] == 'none' && $simp_ec_att['product_type'] != null  && $simp_ec_att['product_type'] != 'none' && $simp_ec_att['attributes'] == 'none') ||
		($simp_ec_att['name'] != 'all' && $simp_ec_att['name'] != null && $simp_ec_att['id'] == 'hidden' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['category'] == 'none' && $simp_ec_att['product_type'] != null  && $simp_ec_att['product_type'] != 'none' && $simp_ec_att['attributes'] == 'none')){
		$results = $wpdb->get_results( 'SELECT * FROM ' . $table_product . ' JOIN ' . $table_pv . ' ON ' .  $table_pv .'.product_id = ' . $table_product . '.product_id JOIN ' . $table_pt . ' ON ' . $table_pt . '.ptype_id = ' . $table_pv . '.ptype_id WHERE ' . $table_product  . '.pname = "' . $simp_ec_att['name'] . '" AND ' . $table_pt . '.ptype_name = "' . $simp_ec_att['product_type'] . '" GROUP BY ' . $table_product . '.product_id');

		$results_product_type = $wpdb->get_results( 'SELECT * FROM ' . $table_pv . ' JOIN ' . $table_pt . ' ON ' . $table_pt . '.ptype_id = ' . $table_pv . '.ptype_id');
	}

	//[product sku="<sku code>" product_type="<ptype_name>"]
	else if (($simp_ec_att['sku'] != 'all' && $simp_ec_att['sku'] != null && $simp_ec_att['name'] == 'all' && $simp_ec_att['id'] == 'all' && $simp_ec_att['category'] == 'none' && $simp_ec_att['product_type'] != null  && $simp_ec_att['product_type'] != 'none' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['sku'] != 'all' && $simp_ec_att['sku'] != null && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['id'] == 'all' && $simp_ec_att['category'] == 'none' && $simp_ec_att['product_type'] != null  && $simp_ec_att['product_type'] != 'none' && $simp_ec_att['attributes'] == 'none') ||
		($simp_ec_att['sku'] != 'all' && $simp_ec_att['sku'] != null && $simp_ec_att['name'] == 'all' && $simp_ec_att['id'] == 'hidden' && $simp_ec_att['category'] == 'none' && $simp_ec_att['product_type'] != null  && $simp_ec_att['product_type'] != 'none' && $simp_ec_att['attributes'] == 'none') ||
		($simp_ec_att['sku'] != 'all' && $simp_ec_att['sku'] != null && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['id'] == 'hidden' && $simp_ec_att['category'] == 'none' && $simp_ec_att['product_type'] != null  && $simp_ec_att['product_type'] != 'none' && $simp_ec_att['attributes'] == 'none')){
		$results = $wpdb->get_results( 'SELECT * FROM ' . $table_product . ' JOIN ' . $table_pv . ' ON ' .  $table_pv .'.product_id = ' . $table_product . '.product_id JOIN ' . $table_pt . ' ON ' . $table_pt . '.ptype_id = ' . $table_pv . '.ptype_id WHERE ' . $table_product  . '.product_sku = "' . $simp_ec_att['sku'] . '" AND ' . $table_pt . '.ptype_name = "' . $simp_ec_att['product_type'] . '" GROUP BY ' . $table_product . '.product_id');

		$results_product_type = $wpdb->get_results( 'SELECT * FROM ' . $table_pv . ' JOIN ' . $table_pt . ' ON ' . $table_pt . '.ptype_id = ' . $table_pv . '.ptype_id');
	}

	//[product product_type="all" category="all"]
	else if (($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['category'] == 'all' && $simp_ec_att['product_type'] == 'all' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['category'] == 'all' && $simp_ec_att['product_type'] == 'all' && $simp_ec_att['attributes'] == 'none') ||
		($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['category'] == 'all' && $simp_ec_att['product_type'] == 'all' && $simp_ec_att['attributes'] == 'none') ||
		($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['category'] == 'all' && $simp_ec_att['product_type'] == 'all' && $simp_ec_att['attributes'] == 'none') ||
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['category'] == 'all' && $simp_ec_att['product_type'] == 'all' && $simp_ec_att['attributes'] == 'none') ||
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['category'] == 'all' && $simp_ec_att['product_type'] == 'all' && $simp_ec_att['attributes'] == 'none') ||
		($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['category'] == 'all' && $simp_ec_att['product_type'] == 'all' && $simp_ec_att['attributes'] == 'none') ||
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['category'] == 'none' && $simp_ec_att['product_type'] == 'all' && $simp_ec_att['attributes'] == 'none')){
		$results = $wpdb->get_results( 'SELECT * FROM ' . $table_product . ' JOIN ' . $table_pv . ' ON ' .  $table_pv .'.product_id = ' . $table_product . '.product_id JOIN ' . $table_pt . ' ON ' . $table_pt . '.ptype_id = ' . $table_pv . '.ptype_id JOIN ' . $table_pcs . ' ON ' .  $table_pcs .'.product_id = ' . $table_product . '.product_id JOIN ' . $table_pc . ' ON ' . $table_pcs . '.pcat_id = ' . $table_pc . '.pcat_id GROUP BY ' . $table_product . '.product_id');

		$results_product_type = $wpdb->get_results( 'SELECT * FROM ' . $table_pv . ' JOIN ' . $table_pt . ' ON ' . $table_pt . '.ptype_id = ' . $table_pv . '.ptype_id');

		$results_product_category = $wpdb->get_results( 'SELECT * FROM ' . $table_pcs . ' JOIN ' . $table_pc . ' ON ' .  $table_pcs .'.pcat_id = ' . $table_pc . '.pcat_id JOIN ' . $table_product . ' ON ' .  $table_product .'.product_id = ' . $table_pcs . '.product_id');

	}

	ob_start();
		if($results){ 
			foreach ( $results as $product ){ ?>
				<span class="simp_ec_product product<?php echo $product->product_id; ?>" style="display: block;">
					<?php if(!empty($product->pname) && ($simp_ec_att['name'] != 'hidden')) { ?>
						<span class="simp_ec_product_name"><?php echo $product->pname; ?></span>
					<?php } if(!empty($product->product_sku) && ($simp_ec_att['sku'] != 'hidden')) { ?>
						<span class="simp_ec_product_sku"><?php echo $product->product_sku; ?></span>
						<?php } if(!empty($product->pprice) && ($simp_ec_att['price'] != 'hidden')) { ?>	
						<span class="simp_ec_product_price"><?php echo $product->pprice; ?></span>
					<?php } if(!empty($product->pdesc) && ($simp_ec_att['description'] != 'hidden')) { ?>	
						<span class="simp_ec_product_desc"><?php echo $product->pdesc; ?></span>
					<?php } if(!empty($product->pshortdesc) && ($simp_ec_att['short_description'] != 'hidden')) { ?>	
						<span class="simp_ec_product_short_desc"><?php echo $product->pshortdesc; ?></span>
					<?php } if($results_product_category) {?>	
						<span class="simp_ec_product_category">
							<?php foreach ( $results_product_category as $product_category ){ 
									if($product_category->pcat_id == $product->pcat_id){
											echo $product_category->pcat_name;
										}//if	
		
							 	} // foreach ?>
						</span>
				<?php	} //if empty 
						if(!empty($results_product_type)) {?>	
						<span class="simp_ec_product_type">
							<?php foreach ( $results_product_type as $product_type ){ 
									if($product->ptype_id == $product_type->ptype_id){
											echo $product_type->ptype_name . ' ';
										}//if	
		
							 	} // foreach ?>
						</span>
				<?php	} //if empty 
						if(!empty($product_types)) {?>	
						<span class="simp_ec_product_type">
							<?php foreach ( $product_types as $ptype ){ 
									if($product->ptype_id == $ptype->ptype_id){
											echo $ptype->ptype_name;
										}//if	
		
							 	} // foreach ?>
						</span>
					<?php	} //if empty ?>
				</span>
	  <?php } //foreach

		}//if
		else 
		{
			echo "Sorry, we couldn't find anything with that description";
		}
	return ob_get_clean();

}//function

add_shortcode('product', 'simp_ec_shortcode_product');

?>