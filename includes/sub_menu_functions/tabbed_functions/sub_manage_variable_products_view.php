<?php 
/**
 * @since 		1.0.0
 * @package		Simplified_Ecommerce
**/
?>
<form id="delete_variable_product_form" action="#delete-variable_product" method="post" onsubmit="return confirm('Are you sure you want to delete these variable products?');">
	<table class="wp-list-table widefat fixed simp_ec_table_view">
		<thead>
			<tr>
				<td class="manage-column column-cb check-column">
					<input type="checkbox" name="bulk-delete[]" value="All" />
				</td>
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
			<tr>
				<th class="check-column"><input type="checkbox" name="bulk-delete[]" value="<?php echo $variable_product->vproduct_id; ?>" /></th>
				<td><?php echo $variable_product->vproduct_name; ?></td>
				<td><?php echo $variable_product->vproduct_sku; ?></td>
				<td><?php echo $variable_product->vproduct_price; ?></td>
				<td><?php echo $variable_product->vproduct_stock; ?></td>
				<td><?php echo $variable_product->pname; ?></td>
				<td><?php echo $variable_product->pattribute_name; ?></td>
			</tr>
	<?php } //foreach
	} //if ?>
		</tbody>
		<tfoot>
			<tr>
				<td class="manage-column column-cb check-column"> 
					<input type="checkbox" name="bulk-delete[]" value="" />
				</td>
				<th class="manage-column column-title column-primary"><a href="">Variation Name</a></th>
				<th class="table_head_sku">SKU</th>
				<th class="table_head_price">Price (&euro;)</th>
				<th class="table_head_price">Stock</th>
				<th>Parent Product</th>
				<th>Product Attributes</th>
			</tr>
		</tfoot>
	</table>
	<input type="submit" name="delete_checked_variable_product_button" value="Delete" id="delete_checked_product" class="button button button-primary simp_ec_btn_submit" />
</form>
<?php 
	if(isset($_POST['delete_checked_variable_product_button']))
	{

		if(isset($_POST['bulk-delete'])) { 
		$buik_delete = $_POST['bulk-delete'];

			foreach ( $buik_delete as $delete_product )
			{
				$wpdb->delete( $table_pv, array( 'vproduct_id' => $delete_product ) );
				echo "<meta http-equiv='refresh' content='0'>";
			}

		}

	}
?>