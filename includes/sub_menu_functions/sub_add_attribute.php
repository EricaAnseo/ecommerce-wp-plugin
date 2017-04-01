<?php

function simp_ec_add_attribute_page_html()
{
	$rows = 3;
	$product = array();
	$item = array();
	//////////////////////////////
	//$pname = array();
	//$sku = array();
	//$pdesc = array();
	//$pshortdesc = array();
	//$pprice = array();


?>
    <div class="wrap">
        <h2>Product Attributes</h2>
	    <form action="#add_attribute" method="post" name="add_attribute">
			<table class="wp-list-table widefat fixed">
				<tr>
	                <th>Name</th>
	                <th>SKU</th>
	                <th>Description</th>
	                <th>Short Desc</th>
	                <th>Price</th>
	        	</tr>
		<?php for ($i=0; $i< $rows; $i++){ ?>

		        <tr > 
		            <td>
		            	<input id="pname" type="text" name="pname[<?php echo $i ?>]" />
		            </td>
		            <td>
		            	<input id="sku" type="text" name="sku[<?php echo $i ?>]"/>
		            </td>
		            <td>
		            	<input id="pdesc" type="text" name="pdesc[<?php echo $i ?>]" />		            
		            </td>
		            <td>
		            	<input id="pshortdesc" type="text" name="pshortdesc[<?php echo $i ?>]" />		            
		            </td>
		            <td>
		            	<input id="pprice" min="0" placeholder="0" type="number" name="pprice[<?php echo $i ?>]" />
		            </td>
		        </tr>
		<?php } ?>
	        </table>
			<input type="submit" value="Submit" class="button button-primary" />
		</form>
    </div>

<?php

		if((isset($_POST['pname'])) || (isset($_POST['sku'])) || (isset($_POST['pdesc'])) || (isset($_POST['pshortdesc'])) || (isset($_POST['pprice'])) ){

			global $wpdb;

			$table_product = $wpdb->prefix . "simp_ec_product";
			$product_id = $wpdb->insert_id;
			$pname = $_POST['pname'];
			$product_sku = $_POST['sku'];
			$pdesc = $_POST['pdesc'];
			$pshortdesc = $_POST['pshortdesc'];
			$pprice = $_POST['pprice']; 
			$count = 0;

			if (!empty($pname)) 
			{
				foreach( $pname as $name ) {
					$count++;
				}
			}
			elseif (!empty($product_sku)) {
				foreach( $product_sku as $sku ) {
					$count++;
				}
			}
			elseif (!empty($pshortdesc)) {
				foreach( $pshortdesc as $sdesc ) {
					$count++;
				}
			}
			elseif (!empty($pdesc)) {
				foreach( $pdesc as $desc ) {
					$count++;
				}
			}
		
			for ($i=0; $i< $count; $i++){

				$query = array('product_id' => $product_id,
						'product_sku' => $product_sku[$i],
						'pname' => $pname[$i], 
						'pdesc' => $pdesc[$i],
						'pshortdesc' => $pshortdesc[$i],
						'pprice' => $pprice[$i]);

				if (!empty($pname[$i]) || !empty($product_sku[$i]) || !empty($pdesc[$i]) || !empty($pshortdesc[$i]) || !empty($pprice[$i]))
			    {
			        $wpdb->insert($table_product, $query, null);
			    }

				
			}  

	    }

}


