<?php 
/**
 * @since 		1.0.0
 * @package		Simplified_Ecommerce
**/
?>
<form> 
	<table class="wp-list-table widefat fixed simp_ec_table_update">
		<thead>
			<tr>
				<td class="manage-column column-cb check-column"></td>
				<th class="manage-column column-title column-primary"><a href="">Variation Name</a></th>
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
				<td class="simp_ec_column_update"><textarea id="vproduct_name" class="simp_ec_textarea" type="text" name="vproduct_name[<?php echo $i; ?>]" ><?php echo $variable_product->vproduct_name; ?></textarea></td>
				<td class="simp_ec_column_update"><textarea id="vproduct_sku" class="simp_ec_textarea" type="text" name="vproduct_sku[<?php echo $i; ?>]" ><?php echo $variable_product->vproduct_sku; ?></textarea></td>
				<td class="simp_ec_column_update"><input id="vproduct_price" class="simp_ec_input_number" min="0" placeholder="0" type="number" name="vproduct_price[<?php echo $i ?>]" value="<?php echo $variable_product->vproduct_price; ?>" /></td>
				<td class="simp_ec_column_update"><input id="vproduct_stock" class="simp_ec_input_number" min="0" placeholder="0" type="number" name="vproduct_stock[<?php echo $i ?>]" value="<?php echo $variable_product->vproduct_stock; ?>" /></td>
				<td></td>
				<td></td>
			</tr>
	<?php } //foreach
	} //if ?>
		</tbody>
		<tfoot>
			<tr>
				<td class="manage-column column-cb check-column"></td>
				<th class="manage-column column-title column-primary"><a href="">Variation Name</a></th>
				<th class="table_head_sku">SKU</th>
				<th class="table_head_price">Price (&euro;)</th>
				<th class="table_head_price">Stock</th>
				<th>Parent Product</th>
				<th>Product Attributes</th>
			</tr>
		</tfoot>
	</table>
	<input type="submit" name="add_variable_product_button" value="Add Products" id="add_variable_product" class="button button-primary simp_ec_btn_submit" />
</form>