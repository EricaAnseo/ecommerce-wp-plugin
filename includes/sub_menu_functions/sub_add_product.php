<?php

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
	                	<input id="pname" placeholder="Product Name" style="width: 100%; resize: none; " type="text" name="pname" ></textarea>
	                </span>
	                <span class="col-dt-3">
	            		<input id="sku" placeholder="SKU" style="width: 100%;" type="text" name="sku"/>
	            	</span>
	            	<span class="col-dt-3">
	            		<input id="pprice" placeholder="Price" style="" min="0" placeholder="0" type="number" name="pprice" />
	            	</span>
		        </div>
	            <div class="col-group">
	            	<span class="col-dt-6">
	            		<textarea id="pshortdesc" placeholder="Short Description" style="width: 100%; height:70px;" type="text" name="pshortdesc"></textarea>
	            	</span>			         
	            	<span class="col-dt-6">
	            		<textarea id="pdesc" placeholder="Description" style="width: 100%; height:70px;" name="pdesc"></textarea>
	            	</span>	            
	            </div>
	            <div class="col-group">
	            	<span class="col-dt-4">
	            		<textarea id="ptype" placeholder="Product Type" class="simp_ec_textarea" type="text" name="ptype" ></textarea>
	            	</span>
	            	<span class="col-dt-4">
	            		<textarea id="category" placeholder="Category" class="simp_ec_textarea" type="text" name="category" ></textarea>
	            	</span>
	            	<span class="col-dt-4"></span>
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


