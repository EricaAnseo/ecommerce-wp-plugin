<?php 
/**
 * @since 		1.0.0
 * @package		Simplified_Ecommerce
**/
?>
<form action="#update_variable_product" method="post" id="update_variable_product" name="update_variable_product">  
	<table class="wp-list-table widefat fixed simp_ec_table_update">
		<thead>
			<tr>
				<td class="manage-column column-cb check-column"></td>
				<th class="manage-column column-title column-primary">Variation Name</th>
				<th class="table_head_sku">SKU</th>
				<th class="table_head_price">Price (&euro;)</th>
				<th class="table_head_price">Stock</th>
				<th>Parent Product</th>
				<th>Product Attributes</th>
			</tr>
		</thead>
		<tbody>
<?php if($results_variable_product){ 
		foreach ( $results_variable_product as $variable_product ){ ?>
			<tr class="simp_ec_row_update">
				<td></td>
				<td class="simp_ec_column_update"><textarea id="vproduct_name" class="simp_ec_textarea" type="text" name="vproduct_name[<?php echo $variable_product->vproduct_id; ?>]" ><?php echo $variable_product->vproduct_name; ?></textarea></td>
				<td class="simp_ec_column_update"><textarea id="vproduct_sku" class="simp_ec_textarea" type="text" name="vproduct_sku[<?php echo $variable_product->vproduct_id; ?>]" ><?php echo $variable_product->vproduct_sku; ?></textarea></td>
				<td class="simp_ec_column_update"><input id="vproduct_price" class="simp_ec_input_number" min="0" placeholder="0" type="number" name="vproduct_price[<?php echo $variable_product->vproduct_id; ?>]" value="<?php echo $variable_product->vproduct_price; ?>" /></td>
				<td class="simp_ec_column_update"><input id="vproduct_stock" class="simp_ec_input_number" min="0" placeholder="0" type="number" name="vproduct_stock[<?php echo $variable_product->vproduct_id; ?>]" value="<?php echo $variable_product->vproduct_stock; ?>" /></td>
				<td class="simp_ec_column_update">
					<select name="parent_product[<?php echo $variable_product->vproduct_id; ?>]">
<?php 
						foreach ( $results_parent as $result_product ){
							if ($variable_product->product_id==$result_product->product_id)
							{
								echo '<option value="' . $result_product->product_id . '"selected="selected" >' . $result_product->pname . '</option>';
							} 
							else
							{
								echo '<option value="' . $result_product->product_id . '">' . $result_product->pname . '</option>';
							}
						}
?>						
					</select>
				</td>
				<td class="simp_ec_column_update">
					<select name="product_attribute[<?php echo $variable_product->vproduct_id; ?>]">
<?php 
						foreach ( $results_attribute as $result_attri ){ 
							if ($variable_product->pattribute_id==$result_attri->pattribute_id)
							{
								echo '<option value="' . $result_attri->pattribute_id . '"selected="selected" >' . $result_attri->pattribute_name . '</option>';
							} 
							else
							{
								echo '<option value="' . $result_attri->pattribute_id . '">' . $result_attri->pattribute_name . '</option>';
							}
						?>
							<
<?php 					}
?>						
					</select>
				</td>
			</tr>
	<?php } //foreach
	} //if ?>
		</tbody>
		<tfoot>
			<tr>
				<td class="manage-column column-cb check-column"></td>
				<th class="manage-column column-title column-primary">Variation Name</th>
				<th class="table_head_sku">SKU</th>
				<th class="table_head_price">Price (&euro;)</th>
				<th class="table_head_price">Stock</th>
				<th>Parent Product</th>
				<th>Product Attributes</th>
			</tr>
		</tfoot>
	</table>
	<input type="submit" name="update_variable_product_button" value="Update" id="update_variable_product_button" class="button button-primary simp_ec_btn_submit" />
</form>

<?php 

	if(isset($_POST['update_variable_product_button'])){
		$vproduct_name = array_map( 'esc_attr', $_POST['vproduct_name'] );
		$vproduct_sku = array_map( 'esc_attr', $_POST['vproduct_sku']);
		$vproduct_stock = array_map( 'esc_attr', $_POST['vproduct_stock']);
		$vproduct_price = array_map( 'esc_attr', $_POST['vproduct_price']);
		$parent_product = array_map( 'esc_attr', $_POST['parent_product']);
		$product_attribute = array_map( 'esc_attr', $_POST['product_attribute']);		

		if($results_variable_product)
		{
			foreach ($results_variable_product as $result_vp){
				if($vproduct_name[$result_vp->vproduct_id] != $result_vp->vproduct_name || $vproduct_sku[$result_vp->vproduct_id] != $result_vp->vproduct_sku || $vproduct_stock[$result_vp->vproduct_id] != $result_vp->vproduct_stock || $vproduct_price[$result_vp->vproduct_id] != $result_vp->vproduct_price || $parent_product[$result_vp->vproduct_id] != $result_vp->product_id || $product_attribute[$result_vp->vproduct_id] != $result_vp->pattribute_id)
				{

					$query = array('vproduct_name' => $vproduct_name[$result_vp->vproduct_id],
						'vproduct_sku' => $vproduct_sku[$result_vp->vproduct_id], 
						'vproduct_stock' => $vproduct_stock[$result_vp->vproduct_id],
						'vproduct_price' => $vproduct_price[$result_vp->vproduct_id],
						'product_id' => $parent_product[$result_vp->vproduct_id], 
						'pattribute_id' => $product_attribute[$result_vp->vproduct_id]);

					$where = array('vproduct_id' => $result_vp->vproduct_id);

					//Format for updating a table
					//Table Name, query, where condition, data type for query, data type for where
					$wpdb->update($table_pv, $query, $where, null, null); 

					echo "<meta http-equiv='refresh' content='0'>";

				}
				else
				{
					
				}

			}

		}			

	
	}//if isset 


?>