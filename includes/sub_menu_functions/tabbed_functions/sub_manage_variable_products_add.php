<?php 
/**
 * @since 		1.0.0
 * @package		Simplified_Ecommerce
**/
?>
<form action="#add_variable_product" method="post" id="add_variable_product" name="add_variable_product"> 
	<table class="wp-list-table widefat fixed simp_ec_table_view">
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
	<?php for ($i=0; $i< $rows; $i++){ ?>
			<tr class="simp_ec_row_insert">
				<td></td>
				<td class="simp_ec_column_insert"><textarea id="vproduct_name" class="simp_ec_textarea" type="text" name="vproduct_name[<?php echo $i; ?>]" ></textarea></td>
				<td class="simp_ec_column_insert"><textarea id="vproduct_sku" class="simp_ec_textarea" type="text" name="vproduct_sku[<?php echo $i; ?>]" ></textarea></td>
				<td class="simp_ec_column_insert"><input id="vproduct_price" class="simp_ec_input_number" min="0" placeholder="0" type="number" name="vproduct_price[<?php echo $i ?>]" /></td>
				<td class="simp_ec_column_insert"><input id="vproduct_stock" class="simp_ec_input_number" min="0" placeholder="0" type="number" name="vproduct_stock[<?php echo $i ?>]" /></td>
				<td class="simp_ec_column_insert">	
					<select name="parent_product[<?php echo $i; ?>]">
						<option value=""></option>
<?php 
						foreach ( $results_parent as $result_product ){
							echo '<option value="' . $result_product->product_id . '">' . $result_product->pname . '</option>';
						}
?>						
					</select>
				</td>
				<td class="simp_ec_column_insert">
					<select name="product_attribute[<?php echo $i; ?>]">
						<option value=""></option>
<?php 
						foreach ( $results_attribute as $result_attri ){
							echo '<option value="' . $result_attri->pattribute_id . '">' . $result_attri->pattribute_name . '</option>';
						}
?>						
					</select>
				</td>
			</tr>
	<?php } //for ?>
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
	<input type="submit" name="add_variable_product_button" value="Add" id="add_variable_product_button" class="button button-primary simp_ec_btn_submit" />
</form>

<?php 
if(isset($_POST['add_variable_product_button']))
{

	if((isset($_POST['parent_product'])) || (isset($_POST['product_attribute']))){

		$lastid = $wpdb->insert_id;
		$vproduct_name = array_map( 'sanitize_text_field', $_POST['vproduct_name'] );
		$vproduct_sku = array_map( 'sanitize_text_field', $_POST['vproduct_sku']);
		$vproduct_stock = array_map( 'sanitize_text_field', $_POST['vproduct_stock']);
		$vproduct_price = array_map( 'sanitize_text_field', $_POST['vproduct_price']);
		$parent_product = array_map( 'sanitize_text_field', $_POST['parent_product']);
		$product_attribute = array_map( 'sanitize_text_field', $_POST['product_attribute']);
		
		if (!empty($parent_product)) {
			foreach( $parent_product as $product ) {
				$count++;
			}
		}
		elseif (!empty($product_attribute)) {
			foreach( $product_attribute as $attribute ) {
				$count++;
			}
		}

		for ($i=0; $i< $count; $i++){

			$results_type_at = $wpdb->get_results( 'SELECT * FROM ' . $table_pa . ' JOIN ' . $table_pat . ' ON ' .  $table_pat . '.pattribute_id = ' . $table_pa . '.pattribute_id WHERE ' . $table_pa . '.pattribute_id = "' . $product_attribute[$i] . '"'); 

			foreach( $results_type_at as $attribute ) {
				$query_vproduct = array('vproduct_id' => $lastid,
						'vproduct_name' => $vproduct_name[$i], 
						'vproduct_sku' => $vproduct_sku[$i],
						'vproduct_stock' => $vproduct_stock[$i],
						'vproduct_price' => $vproduct_price[$i],
						'product_id' => $parent_product[$i],
						'ptype_id' => $attribute->ptype_id,
						'pattribute_id' => $product_attribute[$i]);


				if (!empty($product_attribute[$i]) && !empty($parent_product[$i]))
			    {
			        $wpdb->insert($table_pv, $query_vproduct, null);
			        echo "<meta http-equiv='refresh' content='0'>";

			    }
			}
			
		}  

	}
}
?>