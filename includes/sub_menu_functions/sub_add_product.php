<?php
/**
 * @since 		1.0.0
 * @package		Simplified_Ecommerce
**/

function simp_ec_products_page_html()
{
    // check user capabilities
    /*if (!current_user_can('manage_options')) {
        return;
    }*/ 

    ?>
    <div class="wrap simp_ec_container">
        <h1><?php echo get_admin_page_title(); ?></h1>
    	<div class="simp_ec_add_single_product">
	        <form action="#add_product" method="post" name="add_product">
				<div class="col-group">
	                <span class="col-dt-6">
	                	<input id="pname" placeholder="Product Name" style="width: 100%; resize: none; " type="text" name="pname" />
	                	<div class="col-group">
		                	<span class="col-dt-6">
		            			<input id="sku" placeholder="SKU" style="width: 100%;" type="text" name="sku"/>
		            		</span>
		            		<span class="col-dt-6">
		            			<input id="pprice" placeholder="Price" style="width: 100%;" min="0" placeholder="0" type="number" name="pprice" />
		            		</span>
		            	</div>
	            		<textarea id="pshortdesc" placeholder="Short Description" style="width: 100%; height:70px;" type="text" name="pshortdesc"></textarea>
	            		<textarea id="pdesc" placeholder="Description" style="width: 100%; height:70px;" name="pdesc"></textarea>
	            		<textarea id="ptype" placeholder="Product Type" class="simp_ec_textarea" type="text" name="ptype" ></textarea>
	            		<textarea id="category" placeholder="Category" class="simp_ec_textarea" type="text" name="category" ></textarea>
	            	</span>
	            	<span class="col-dt-6">
	            		<h3>Name: </h3>
	            		<span class="simp_ec_add_single_product_name"></span>
	            		<div class="col-group">
	            			<span class="col-dt-6">
	            				<h3>SKU: </h3>
	            				<span class="simp_ec_add_single_product_sku"></span>
		            		</span>
		            		<span class="col-dt-6">
		            			<h3>Price: </h3>
		            			<span class="simp_ec_add_single_product_price"></span>
		            		</span>
	            		</div>
	            		<h3>Short Description: </h3>
	            		<span class="simp_ec_add_single_product_short_desc"></span>
	            		<h3>Description: </h3>
	            		<span class="simp_ec_add_single_product_desc"></span>
	            	</span>
	            </div>
				<input type="submit" value="Submit" class="button button-primary" />
			</form>
		</div>
    </div>
<?php

    global $wpdb;
	$table_product = $wpdb->prefix . "simp_ec_product";

	if(isset($_POST['pname']) || isset($_POST['sku']) || isset($_POST['pdesc']) || isset($_POST['pshortdesc']) || isset($_POST['pprice']))	{ 

		$pname = sanitize_text_field( $_POST['pname'] );
		$sku = sanitize_text_field( $_POST['sku'] );
		$pdesc = sanitize_text_field( $_POST['pdesc'] );
		$pshortdesc = sanitize_text_field( $_POST['pshortdesc'] );
		$pprice = sanitize_text_field( $_POST['pprice'] );
		$product_id = $wpdb->insert_id; 

		$query = array('product_id' => $product_id,
					'product_sku' => $sku,
					'pname' => $pname, 
					'pdesc' => $pdesc,
					'pshortdesc' => $pshortdesc,
					'pprice' => $pprice);

		$format = array('%d', '%s', '%s', '%s', '%s', '%f');

		//$wpdb->prepare(
			$wpdb->insert($table_product, $query, null);

		//, '');

	}
	
}


