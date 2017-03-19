<?php

function simp_ec_products_page_html()
{
    // check user capabilities
    /*if (!current_user_can('manage_options')) {
        return;
    }*/ 

    ?>
    <div class="wrap">
        <h2>Products</h2>
	        <form action="#add_product" method="post" name="add_product">
				<label for="pname">Product Name</label> 
				<input id="pname" type="text" name="pname" /> <hr/>
				<label for="sku">SKU</label>
				<input id="sku" type="text" name="sku"/><hr/>
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

	if(isset($_POST['pname']) || isset($_POST['sku']) || isset($_POST['pdesc']) || isset($_POST['pshortdesc']) || isset($_POST['pprice']))	{ 
		$pname = $_POST['pname']; 
		$sku = $_POST["sku"]; 
		$pdesc = $_POST["pdesc"]; 
		$pshortdesc = $_POST["pshortdesc"]; 
		$pprice = $_POST["pprice"]; 
		$lastid = $wpdb->insert_id; 

		$query = array('product_id' => $lastid,
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


