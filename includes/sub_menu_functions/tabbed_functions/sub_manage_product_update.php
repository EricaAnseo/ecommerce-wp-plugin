<?php 
/**
 * @since 		1.0.0
 * @package		Simplified_Ecommerce
**/
?>


<table class="wp-list-table widefat fixed simp_ec_table_update">
	<form action="#manage_product" method="post" id="manage_product" name="manage_product">
	<thead>
		<tr>
			<td class="manage-column column-cb check-column">
				<input style="display: block;" type="checkbox" name="bulk-delete[]" value="" />
			</td>
			<th class="manage-column column-title column-primary"><a href="<?php //'page=simplified-ecommerce?sort=name'?>">Name</a></th>
			<th><a href="#sort=name">SKU</a></th>
			<th>Price</th>
			<th>Short Description</th>
			<th>Description</th>
			<th>Category</th>
		</tr>
	</thead>
	<tbody>
<?php if($results){ ?>

		<!-- <form action="#checked_product" method="post" id="checked_product" name="checked_product"> -->

<?php

		foreach ( $results as $product ){ 
?>
			
			<tr class="simp_ec_row_update">
				<td><input type="checkbox" name="bulk-delete[<?php echo $product->product_id ?>]" value="bulk-delete[<?php echo $product->product_id ?>]" /></td>
				<td class="simp_ec_column_update"><textarea id="pname" class="simp_ec_textarea" type="text" name="pname[<?php echo $product->product_id ?>]" ><?php echo $product->pname ?></textarea></td>
				<td class="simp_ec_column_update"><textarea id="product_sku" class="simp_ec_textarea" type="text" name="product_sku[<?php echo $product->product_id ?>]" ><?php echo $product->product_sku ?></textarea></td>
				<td class="simp_ec_column_update"><input id="pprice" type="number" class="simp_ec_input_number" name="pprice[<?php echo $product->product_id ?>]" value="<?php echo $product->pprice ?>" /></td>
				<td class="simp_ec_column_update"><textarea id="pshortdesc" class="simp_ec_textarea" type="text" name="pshortdesc[<?php echo $product->product_id ?>]" ><?php echo $product->pshortdesc ?></textarea></td>
				<td class="simp_ec_column_update"><textarea id="pdesc" class="simp_ec_textarea" type="text" name="pdesc[<?php echo $product->product_id ?>]" ><?php echo $product->pdesc ?></textarea></td>
				
				<td class="simp_ec_column_update">
					<select>
						<option value=''></option>
<?php 
					foreach ( $categories as $category ){
						echo '<option value="' . $category->pcat_id . '">' . $category->pcat_name . '</option>';
					} //foreach
?>						
					</select>

				</td>
			</tr>
		
<?php 	} //foreach result as product ?>
	
	</tbody>
	<tfoot>
		<tr>
			<td class="manage-column column-cb check-column">
				<input style="display: block;" type="checkbox" name="bulk-delete[]" value="" />
			</td>
            <th>Name</th>
            <th>SKU</th>
            <th>Price</th>
            <th>Short Description</th>
            <th>Description</th>
           	<th>Category</th>
		</tr>
	</tfoot>
</table>
<input type="submit" name="update_products_button" value="Update" class="button action simp_ec_btn_submit" />
</form>
<div class="view-product-buttons">
	<form action="#delete_checked_product" method="post"  name="delete_checked_product">
		<input type="submit" name="delete_checked_product_button" value="Delete" id="delete_checked_product" class="button action" />
	</form>

</div>

<?php	} //if results

	else{
		echo "</tbody></table>";
		echo "<p>You currently have no products added.</p>"; 
	}

	if(isset($_POST['update_products_button']))
	{
		$pname = array_map( 'esc_attr', $_POST['pname'] );
		$product_sku = array_map( 'esc_attr', $_POST['product_sku'] );	
		$pprice = array_map( 'esc_attr', $_POST['pprice'] );
		$pshortdesc = array_map( 'esc_attr', $_POST['pshortdesc'] );
		$pdesc = array_map( 'esc_attr', $_POST['pdesc'] );

		if($results)
		{
			foreach( $results as $product ) {
				if($pname[$product->product_id] != $product->pname || $product_sku[$product->product_id] != $product->product_sku || $pprice[$product->product_id] != $product->pprice || $pshortdesc[$product->product_id] != $product->pshortdesc || $pdesc[$product->product_id] != $product->pdesc)
				{
					$query = array('product_sku' => $product_sku[$product->product_id],
						'pname' => $pname[$product->product_id], 
						'pdesc' => $pdesc[$product->product_id],
						'pshortdesc' => $pshortdesc[$product->product_id],
						'pprice' => $pprice[$product->product_id]);

					$where = array('product_id' => $product->product_id);

					//Format for updating a table
					//Table Name, query, where condition, data type for query, data type for where
					$wpdb->update($table_product, $query, $where, null, null ); 

					$message = "Product Successfully Updated";
					echo "<meta http-equiv='refresh' content='0'>";

				}
				else
				{
					
				}

			}

		}			

	}



?>
		
<p>Number of products added <?php echo $no_of_products ?></p>


