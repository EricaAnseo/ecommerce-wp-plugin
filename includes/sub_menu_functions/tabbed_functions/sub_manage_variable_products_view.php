<?php 
/**
 * @since 		1.0.0
 * @package		Simplified_Ecommerce
**/
?>

	<table class="wp-list-table widefat fixed simp_ec_table_view">
		<thead>
			<tr>
				<td class="manage-column column-cb check-column">
					<input style="display: block;" type="checkbox" name="bulk-delete[]" value="" />
				</td>
				<th class="manage-column column-title column-primary"><a href="">Variation Name</a></th>
				<th class="table_head_sku">SKU</th>
				<th class="table_head_price">Price (&euro;)</th>
				<th class="table_head_price">Stock</th>
				<th>Parent Product</th>
				<th>Product Attributes</th>
				<th class="column_delete"></th>
			</tr>
		</thead>
		<tbody>
<?php if($results_variable_product){ 
		foreach ( $results_variable_product as $variable_product ){ ?>
			<tr>
				<td><input style="display: block;" type="checkbox" name="bulk-delete[]" value="" /></td>
				<td><?php echo $variable_product->vproduct_name; ?></td>
				<td><?php echo $variable_product->vproduct_sku; ?></td>
				<td><?php echo $variable_product->vproduct_price; ?></td>
				<td><?php echo $variable_product->vproduct_stock; ?></td>
				<td><?php echo $variable_product->pname; ?></td>
				<td><?php echo $variable_product->pattribute_name; ?></td>
				<td><form id="delete_variable_product_form" action="#delete-variable_product" method="post" onsubmit="return confirm('Are you sure you want to delete this product?');">
						<button type="submit" name="delete_variable_product_btn" class="button simp_ec_btn_delete"> <span class="dashicons dashicons-trash"></span></button>
						<input type="hidden" name="delete_product_id" value="<?php echo $variable_product->vproduct_id;?>"/>
					</form></td>
			</tr>
	<?php } //foreach
	} //if ?>
		</tbody>
		<tfoot>
			<tr>
				<td class="manage-column column-cb check-column">
					<input style="display: block;" type="checkbox" name="bulk-delete[]" value="" />
				</td>
				<th class="manage-column column-title column-primary"><a href="">Variation Name</a></th>
				<th class="table_head_sku">SKU</th>
				<th class="table_head_price">Price (&euro;)</th>
				<th class="table_head_price">Stock</th>
				<th>Parent Product</th>
				<th>Product Attributes</th>
				<th class="column_delete"></th>
			</tr>
		</tfoot>
	</table>
	<input type="submit" name="delete_checked_product_button" value="Delete" id="delete_checked_product" class="button button button-primary simp_ec_btn_submit" />

<?php 
	if(isset($_POST['delete_variable_product_btn'])) { 
		$delete_variable_product_id = $_POST['delete_product_id'];
		$wpdb->delete( $table_pv, array( 'vproduct_id' => $delete_product_id ) );
		echo "<meta http-equiv='refresh' content='0'>";
	}
?>