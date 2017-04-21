<?php 
/**
 * @since 		1.0.0
 * @package		Simplified_Ecommerce
 * 
 */

function simp_ec_shortcode_variable_product ($atts)
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
	$results_parent_product = null;

	$simp_ec_att = shortcode_atts( array(
        'id' => 'all',
        'name' => 'all',
        'sku' => 'all',
        'price' => 'all',
        'stock' => 'all', 
        'parent_product' => 'none', 
        'product_type' => 'none', 
        'attributes' => 'none', 
        'heading' => 'show'
    ), $atts );

    //($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['parent_product'] == 'none' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') || 

    //[variable_product]
	if (($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['parent_product'] == 'none' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['parent_product'] == 'none' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['parent_product'] == 'none' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['parent_product'] == 'none' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['parent_product'] == 'none' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['parent_product'] == 'none' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['parent_product'] == 'none' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['parent_product'] == 'none' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none')){	
		$results = $wpdb->get_results( 'SELECT * FROM ' . $table_pv); 
	}

	//[variable_product id=""] 
	else if (($simp_ec_att['id'] != 'all' && $simp_ec_att['id'] != null && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['parent_product'] == 'none' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['id'] != 'all' && $simp_ec_att['id'] != null && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['parent_product'] == 'none' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['id'] != 'all' && $simp_ec_att['id'] != null && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['parent_product'] == 'none' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['id'] != 'all' && $simp_ec_att['id'] != null && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['parent_product'] == 'none' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none')
		){	
		$results = $wpdb->get_results( 'SELECT * FROM ' . $table_pv . ' WHERE vproduct_id = "'. $simp_ec_att['id'] . '"'); 
	}

	//[variable_product name=""] 
	else if (($simp_ec_att['name'] != 'all' && $simp_ec_att['name'] != null && $simp_ec_att['id'] == 'all' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['parent_product'] == 'none' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['name'] != 'all' && $simp_ec_att['name'] != null && $simp_ec_att['id'] == 'hidden' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['parent_product'] == 'none' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['name'] != 'all' && $simp_ec_att['name'] != null && $simp_ec_att['id'] == 'all' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['parent_product'] == 'none' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['name'] != 'all' && $simp_ec_att['name'] != null && $simp_ec_att['id'] == 'hidden' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['parent_product'] == 'none' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none')
		){	
		$results = $wpdb->get_results( 'SELECT * FROM ' . $table_pv . ' WHERE vproduct_name = "'. $simp_ec_att['name'] . '"'); 
	}

	//[variable_product sku=""] 
	else if (($simp_ec_att['sku'] != 'all' && $simp_ec_att['sku'] != null && $simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'all' && $simp_ec_att['parent_product'] == 'none' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['sku'] != 'all' && $simp_ec_att['sku'] != null && $simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'all' && $simp_ec_att['parent_product'] == 'none' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['sku'] != 'all' && $simp_ec_att['sku'] != null && $simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['parent_product'] == 'none' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['sku'] != 'all' && $simp_ec_att['sku'] != null && $simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['parent_product'] == 'none' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none')
		){	
		$results = $wpdb->get_results( 'SELECT * FROM ' . $table_pv . ' WHERE vproduct_sku = "'. $simp_ec_att['sku'] . '"'); 
	}

	//[variable_product parent_product="all"] 
	else if (($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['parent_product'] == 'all' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['parent_product'] == 'all' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['parent_product'] == 'all' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['parent_product'] == 'all' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['parent_product'] == 'all' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['parent_product'] == 'all' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['parent_product'] == 'all' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['parent_product'] == 'all' && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none')){	
		$results = $wpdb->get_results( 'SELECT * FROM ' . $table_pv . ' JOIN ' . $table_product . ' ON ' . $table_pv . '.product_id = ' . $table_product . '.product_id'); 
	}

	//[variable_product parent_product="<product name>"]  
	else if (($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['parent_product'] != 'all' && $simp_ec_att['parent_product'] != null && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['parent_product'] != 'all' && $simp_ec_att['parent_product'] != null && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['parent_product'] != 'all' && $simp_ec_att['parent_product'] != null && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['parent_product'] != 'all' && $simp_ec_att['parent_product'] != null && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['parent_product'] != 'all' && $simp_ec_att['parent_product'] != null && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['parent_product'] != 'all' && $simp_ec_att['parent_product'] != null && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['parent_product'] != 'all' && $simp_ec_att['parent_product'] != null && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['parent_product'] != 'all' && $simp_ec_att['parent_product'] != null && $simp_ec_att['product_type'] == 'none' && $simp_ec_att['attributes'] == 'none')){	
		$results = $wpdb->get_results( 'SELECT * FROM ' . $table_pv . ' JOIN ' . $table_product . ' ON ' . $table_pv . '.product_id = ' . $table_product . '.product_id WHERE ' . $table_product . '.pname = "' . $simp_ec_att['parent_product'] . '"'); 
	}

	//[variable_product product_type="all"]  
	else if (($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['product_type'] == 'all' && $simp_ec_att['parent_product'] == 'none' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['product_type'] == 'all' && $simp_ec_att['parent_product'] == 'none' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['product_type'] == 'all' && $simp_ec_att['parent_product'] == 'none' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['product_type'] == 'all' && $simp_ec_att['parent_product'] == 'none' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['product_type'] == 'all' && $simp_ec_att['parent_product'] == 'none' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['product_type'] == 'all' && $simp_ec_att['parent_product'] == 'none' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['product_type'] == 'all' && $simp_ec_att['parent_product'] == 'none' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['product_type'] == 'all' && $simp_ec_att['parent_product'] == 'none' && $simp_ec_att['attributes'] == 'none')){	
		$results = $wpdb->get_results( 'SELECT * FROM ' . $table_pv . ' JOIN ' . $table_pt . ' ON ' . $table_pv . '.ptype_id = ' . $table_pt . '.ptype_id'); 
	}

	//[variable_product product_type="<product type name>"]  
	else if (($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['product_type'] != 'all' && $simp_ec_att['product_type'] != null && $simp_ec_att['parent_product'] == 'none' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['product_type'] != 'all' && $simp_ec_att['product_type'] != null && $simp_ec_att['parent_product'] == 'none' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['product_type'] != 'all' && $simp_ec_att['product_type'] != null && $simp_ec_att['parent_product'] == 'none' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['product_type'] != 'all' && $simp_ec_att['product_type'] != null && $simp_ec_att['parent_product'] == 'none' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['product_type'] != 'all' && $simp_ec_att['product_type'] != null && $simp_ec_att['parent_product'] == 'none' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['product_type'] != 'all' && $simp_ec_att['product_type'] != null && $simp_ec_att['parent_product'] == 'none' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['product_type'] != 'all' && $simp_ec_att['product_type'] != null && $simp_ec_att['parent_product'] == 'none' && $simp_ec_att['attributes'] == 'none') || 
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['product_type'] != 'all' && $simp_ec_att['product_type'] != null && $simp_ec_att['parent_product'] == 'none' && $simp_ec_att['attributes'] == 'none')){	
		$results = $wpdb->get_results( 'SELECT * FROM ' . $table_pv . ' JOIN ' . $table_pt . ' ON ' . $table_pv . '.ptype_id = ' . $table_pt . '.ptype_id WHERE ' . $table_pt . '.ptype_name = "' . $simp_ec_att['product_type'] . '"'); 
	}

	//[variable_product attribute="all"]  
	else if (($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['attributes'] == 'all' && $simp_ec_att['parent_product'] == 'none' && $simp_ec_att['product_type'] == 'none') || 
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['attributes'] == 'all' && $simp_ec_att['parent_product'] == 'none' && $simp_ec_att['product_type'] == 'none') || 
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['attributes'] == 'all' && $simp_ec_att['parent_product'] == 'none' && $simp_ec_att['product_type'] == 'none') || 
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['attributes'] == 'all' && $simp_ec_att['parent_product'] == 'none' && $simp_ec_att['product_type'] == 'none') || 
		($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['attributes'] == 'all' && $simp_ec_att['parent_product'] == 'none' && $simp_ec_att['product_type'] == 'none') || 
		($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['attributes'] == 'all' && $simp_ec_att['parent_product'] == 'none' && $simp_ec_att['product_type'] == 'none') || 
		($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['attributes'] == 'all' && $simp_ec_att['parent_product'] == 'none' && $simp_ec_att['product_type'] == 'none') || 
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['attributes'] == 'all' && $simp_ec_att['parent_product'] == 'none' && $simp_ec_att['product_type'] == 'none')){	
		$results = $wpdb->get_results( 'SELECT * FROM ' . $table_pv . ' JOIN ' . $table_pa . ' ON ' . $table_pv . '.pattribute_id = ' . $table_pa . '.pattribute_id'); 
	}

	//[variable_product attribute="<attribute name>"]  
	else if (($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['attributes'] != 'all' && $simp_ec_att['attributes'] != null && $simp_ec_att['parent_product'] == 'none' && $simp_ec_att['product_type'] == 'none') || 
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['attributes'] != 'all' && $simp_ec_att['attributes'] != null && $simp_ec_att['parent_product'] == 'none' && $simp_ec_att['product_type'] == 'none') || 
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['attributes'] != 'all' && $simp_ec_att['attributes'] != null && $simp_ec_att['parent_product'] == 'none' && $simp_ec_att['product_type'] == 'none') || 
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['attributes'] != 'all' && $simp_ec_att['attributes'] != null && $simp_ec_att['parent_product'] == 'none' && $simp_ec_att['product_type'] == 'none') || 
		($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['attributes'] != 'all' && $simp_ec_att['attributes'] != null && $simp_ec_att['parent_product'] == 'none' && $simp_ec_att['product_type'] == 'none') || 
		($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['attributes'] != 'all' && $simp_ec_att['attributes'] != null && $simp_ec_att['parent_product'] == 'none' && $simp_ec_att['product_type'] == 'none') || 
		($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['attributes'] != 'all' && $simp_ec_att['attributes'] != null && $simp_ec_att['parent_product'] == 'none' && $simp_ec_att['product_type'] == 'none') || 
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['attributes'] != 'all' && $simp_ec_att['attributes'] != null && $simp_ec_att['parent_product'] == 'none' && $simp_ec_att['product_type'] == 'none')){	
		$results = $wpdb->get_results( 'SELECT * FROM ' . $table_pv . ' JOIN ' . $table_pa . ' ON ' . $table_pv . '.pattribute_id = ' . $table_pa . '.pattribute_id WHERE ' . $table_pv . '.pattribute_name = "' . $simp_ec_att['attributes'] . '"'); 
	}

	//[variable_product parent_product="all" attribute="all"]  
	else if (($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['attributes'] == 'all' && $simp_ec_att['parent_product'] == 'all' && $simp_ec_att['product_type'] == 'none') || 
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['attributes'] == 'all' && $simp_ec_att['parent_product'] == 'all' && $simp_ec_att['product_type'] == 'none') || 
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['attributes'] == 'all' && $simp_ec_att['parent_product'] == 'all' && $simp_ec_att['product_type'] == 'none') || 
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['attributes'] == 'all' && $simp_ec_att['parent_product'] == 'all' && $simp_ec_att['product_type'] == 'none') || 
		($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['attributes'] == 'all' && $simp_ec_att['parent_product'] == 'all' && $simp_ec_att['product_type'] == 'none') || 
		($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['attributes'] == 'all' && $simp_ec_att['parent_product'] == 'all' && $simp_ec_att['product_type'] == 'none') || 
		($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['attributes'] == 'all' && $simp_ec_att['parent_product'] == 'all' && $simp_ec_att['product_type'] == 'none') || 
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['attributes'] == 'all' && $simp_ec_att['parent_product'] == 'all' && $simp_ec_att['product_type'] == 'none')){	
		$results = $wpdb->get_results( 'SELECT * FROM ' . $table_pv . ' JOIN ' . $table_pa . ' ON ' . $table_pv . '.pattribute_id = ' . $table_pa . '.pattribute_id JOIN ' . $table_product . ' ON ' .  $table_product . '.product_id = ' . $table_pv . '.product_id'); 
	}

	//[variable_product product_type="all" attribute="all"]  
	else if (($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['attributes'] == 'all' && $simp_ec_att['parent_product'] == 'none' && $simp_ec_att['product_type'] == 'all') || 
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['attributes'] == 'all' && $simp_ec_att['parent_product'] == 'none' && $simp_ec_att['product_type'] == 'all') || 
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['attributes'] == 'all' && $simp_ec_att['parent_product'] == 'none' && $simp_ec_att['product_type'] == 'all') || 
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['attributes'] == 'all' && $simp_ec_att['parent_product'] == 'none' && $simp_ec_att['product_type'] == 'all') || 
		($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['attributes'] == 'all' && $simp_ec_att['parent_product'] == 'none' && $simp_ec_att['product_type'] == 'all') || 
		($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['attributes'] == 'all' && $simp_ec_att['parent_product'] == 'none' && $simp_ec_att['product_type'] == 'all') || 
		($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['attributes'] == 'all' && $simp_ec_att['parent_product'] == 'none' && $simp_ec_att['product_type'] == 'all') || 
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['attributes'] == 'all' && $simp_ec_att['parent_product'] == 'none' && $simp_ec_att['product_type'] == 'all')){	
		$results = $wpdb->get_results( 'SELECT * FROM ' . $table_pv . ' JOIN ' . $table_pa . ' ON ' . $table_pv . '.pattribute_id = ' . $table_pa . '.pattribute_id JOIN ' . $table_pt . ' ON ' .  $table_pt . '.ptype_id = ' . $table_pv . '.ptype_id'); 
	}

	//[variable_product product_type="all" parent_product="all"]  
	else if (($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['attributes'] == 'none' && $simp_ec_att['parent_product'] == 'all' && $simp_ec_att['product_type'] == 'all') || 
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['attributes'] == 'none' && $simp_ec_att['parent_product'] == 'all' && $simp_ec_att['product_type'] == 'all') || 
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['attributes'] == 'none' && $simp_ec_att['parent_product'] == 'all' && $simp_ec_att['product_type'] == 'all') || 
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['attributes'] == 'none' && $simp_ec_att['parent_product'] == 'all' && $simp_ec_att['product_type'] == 'all') || 
		($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['attributes'] == 'none' && $simp_ec_att['parent_product'] == 'all' && $simp_ec_att['product_type'] == 'all') || 
		($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['attributes'] == 'none' && $simp_ec_att['parent_product'] == 'all' && $simp_ec_att['product_type'] == 'all') || 
		($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['attributes'] == 'none' && $simp_ec_att['parent_product'] == 'all' && $simp_ec_att['product_type'] == 'all') || 
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['attributes'] == 'none' && $simp_ec_att['parent_product'] == 'all' && $simp_ec_att['product_type'] == 'all')){	
		$results = $wpdb->get_results( 'SELECT * FROM ' . $table_pv . ' JOIN ' . $table_product . ' ON ' . $table_pv . '.product_id = ' . $table_product . '.product_id JOIN ' . $table_pt . ' ON ' .  $table_pt . '.ptype_id = ' . $table_pv . '.ptype_id'); 
	}

	//[variable_product product_type="all" product="all" attribute="all"]  
	else if (($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['attributes'] == 'all' && $simp_ec_att['parent_product'] == 'all' && $simp_ec_att['product_type'] == 'all') || 
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['attributes'] == 'all' && $simp_ec_att['parent_product'] == 'all' && $simp_ec_att['product_type'] == 'all') || 
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['attributes'] == 'all' && $simp_ec_att['parent_product'] == 'all' && $simp_ec_att['product_type'] == 'all') || 
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['attributes'] == 'all' && $simp_ec_att['parent_product'] == 'all' && $simp_ec_att['product_type'] == 'all') || 
		($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'all' && $simp_ec_att['attributes'] == 'all' && $simp_ec_att['parent_product'] == 'all' && $simp_ec_att['product_type'] == 'all') || 
		($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['attributes'] == 'all' && $simp_ec_att['parent_product'] == 'all' && $simp_ec_att['product_type'] == 'all') || 
		($simp_ec_att['id'] == 'all' && $simp_ec_att['name'] == 'all' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['attributes'] == 'all' && $simp_ec_att['parent_product'] == 'all' && $simp_ec_att['product_type'] == 'all') || 
		($simp_ec_att['id'] == 'hidden' && $simp_ec_att['name'] == 'hidden' && $simp_ec_att['sku'] == 'hidden' && $simp_ec_att['attributes'] == 'all' && $simp_ec_att['parent_product'] == 'all' && $simp_ec_att['product_type'] == 'all')){	
		$results = $wpdb->get_results( 'SELECT * FROM ' . $table_pv . ' JOIN ' . $table_product . ' ON ' . $table_pv . '.product_id = ' . $table_product . '.product_id JOIN ' . $table_pt . ' ON ' .  $table_pt . '.ptype_id = ' . $table_pv . '.ptype_id JOIN ' . $table_pa . ' ON ' . $table_pv . '.pattribute_id = ' . $table_pa . '.pattribute_id'); 
	}

	ob_start();
		if($results){ 
			foreach ( $results as $var_product ){ ?>
				<span class="simp_ec_var_product variable_product<?php echo $var_product->vproduct_id; ?>" style="display: block;">
					<?php if(!empty($var_product->vproduct_name) && ($simp_ec_att['name'] != 'hidden')) { ?>
						<span class="simp_ec_var_product_name">
							<?php if($simp_ec_att['heading'] == 'show'){ echo '<strong>Name: </strong>'; }
							echo $var_product->vproduct_name; ?>		
						</span>
					<?php } if(!empty($var_product->vproduct_sku) && ($simp_ec_att['sku'] != 'hidden')) { ?>
						<span class="simp_ec_var_product_sku"> 
							<?php if($simp_ec_att['heading'] == 'show'){ echo '<strong>SKU: </strong>'; } echo $var_product->vproduct_sku; ?>
						</span>
						<?php } if(!empty($var_product->vproduct_price) && ($simp_ec_att['price'] != 'hidden')) { ?>	
						<span class="simp_ec_var_product_price">
							<?php if($simp_ec_att['heading'] == 'show'){ echo '<strong>Price: </strong>'; } echo $var_product->vproduct_price; ?>
						</span>
					<?php } if(!empty($var_product->vproduct_stock) && ($simp_ec_att['stock'] != 'hidden')) { ?>	
						<span class="simp_ec_var_product_desc">
							<?php if($simp_ec_att['heading'] == 'show'){ echo '<strong>Stock: </strong>'; } echo $var_product->vproduct_stock; ?>
						</span>
					<?php } if(!empty($var_product->pname)) { ?>	
						<span class="simp_ec_var_parent_product">
							<?php if($simp_ec_att['heading'] == 'show'){ echo '<strong>Parent Product: </strong>'; } echo $var_product->pname; ?>
						</span> 
					<?php } if(!empty($var_product->ptype_name)) { ?>	
						<span class="simp_ec_var_product_type_name">
							<?php if($simp_ec_att['heading'] == 'show'){ echo '<strong>Product Type Name: </strong>'; } echo $var_product->ptype_name; ?>
						</span> 
					<?php } if(!empty($var_product->pattribute_name)) { ?>	
						<span class="simp_ec_var_product_attribute_name">
							<?php if($simp_ec_att['heading'] == 'show'){ echo '<strong>Attribute Name: </strong>'; } echo $var_product->pattribute_name; ?>
						</span> 
					<?php }
	  		} //foreach

		}//if
		else 
		{
			echo "Sorry, we couldn't find anything with those credentials";
		}
	return ob_get_clean();

} //function

add_shortcode('variable_product', 'simp_ec_shortcode_variable_product');

?>

