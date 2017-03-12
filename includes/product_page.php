<?php 
/**
 * @since 		1.0.0
 * @package		Simplified_Ecommerce
**/

//require_once('../../../wp-load.php');

function simp_ec_options_page()
	{
	    add_menu_page(
			'Simplified Ecommerce',
			'Simplified Ecommerce',
			'manage_options',
			'simplified-ecommerce', 
	    	'simp_ec_products_page_html',
	    	'dashicons-carrot',
	    	15
		);

		add_submenu_page( 
			'simplified-ecommerce', 
			'My Sub Level Menu Example', 
			'Sub Level Menu', 
			'manage_options', 
			'add_product_sub', 
			'simp_ec_products_page_html' 
		);
	}

add_action('admin_menu', 'simp_ec_options_page');

function simp_ec_products_page_html()
{
    // check user capabilities
    /*if (!current_user_can('manage_options')) {
        return;
    }*/

    if(isset($_POST['pname'])){ $pname = $_POST['pname']; } 
	if(isset($_POST['sku'])){ $sku = $_POST['sku']; } 
	if(isset($_POST['pdesc'])){ $pdesc = $_POST['pdesc']; } 
	if(isset($_POST['pshortdesc'])){ $pshortdesc = $_POST['pshortdesc']; } 
	if(isset($_POST['pprice'])){ $pprice = $_POST['pprice']; } 


    ?>
    <div class="wrap">
        <h2>Products</h2>
	        <form action="#add_product" method="post" name="add_product">
				<label for="pname">Product Name</label> 
				<input id="pname" type="text" name="pname" /> <hr/>
				<label for="sku">SKU</label>
				<input id="sku" type="text" name="product_sku" /><hr/>
				<label for="pdesc">Description</label>
				<input id="pdesc" type="text" name="pdesc" /><hr/>
				<label for="pshortdesc">Short Description</label> 
				<input id="pshortdesc" type="text" name="pshortdesc" /><hr/>
				<label for="pprice">Price</label>
				<input id="pprice" type="number" name="pprice" /><hr/>
			<input type="submit" value="Submit" class="button button-primary" />
		</form>
    </div>
    <?php

    global $wpdb;
	$table_product = $wpdb->prefix . "simp_ec_product";

	if( isset($_GET['pricing']) && $_GET['pricing']){
   //- do some magic
	}

	//$pass_validation = validate_user_data($_POST); 

	//if ( $pass_validation ) {
		$pname=$_POST["pname"]; 
		$sku=$_POST["sku"]; 
		$pdesc=$_POST["pdesc"]; 
		$pshortdesc=$_POST["pshortdesc"]; 
		$pprice=$_POST["pprice"]; 
	//}
	$wpdb->prepare(
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
		)
	);
}

function save_add_product()
{
	//If autosave is occuring, abort. 
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {return;
	}

	global $wpdb;
	$table_product = $wpdb->prefix . "simp_ec_product";

	$pass_validation = validate_user_data($_POST); 

	if ( $pass_validation ) {
		$pname=$_POST["pname"]; 
		$sku=$_POST["sku"]; 
		$pdesc=$_POST["pdesc"]; 
		$pshortdesc=$_POST["pshortdesc"]; 
		$pprice=$_POST["pprice"]; 
	}

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
	
	
}