<?php 
/**
 * @since 		1.0.0
 * @package		Simplified_Ecommerce
**/
?>
<form id="delete_product_type_form" action="#delete-product" method="post" onsubmit="return confirm('Are you sure you want to delete these product types?');">
	<table class="wp-list-table widefat fixed">
		<thead>
			<tr>
				<td class="manage-column column-cb check-column">
					<input type="checkbox" name="bulk-delete[]" value="All" />
				</td>
				<th class="manage-column column-title column-primary"><a href="">Product Type Name</a></th>
				<th>Product Type Description</th>
				<th>Product Type Attributes</th>
			</tr>
		</thead>
		<tbody>
	<?php
		if($results_ptype && $results_pattribute){ 
			foreach ( $results_ptype as $product_type){ 
	?>
			<tr>
				<th class="check-column"><input type="checkbox" name="bulk-delete[]" value="<?php echo $product_type->ptype_id ?>" /></th>
				<td><?php echo $product_type->ptype_name ?></td>
				<td><?php echo $product_type->ptype_desc ?></td>
				<td><?php foreach ($results_join as $product_attribute){ 
					if($product_attribute->ptype_id == $product_type->ptype_id)
					{
						echo $product_attribute->pattribute_name . ', ';
					}
				} ?></td>
			</tr>

	<?php
			} //foreach 
		}//results
	?>

		</tbody>
		<tfoot>
			<tr>
				<td class="manage-column column-cb check-column">
					<input type="checkbox" name="bulk-delete[]" value="" />
				</td>
				<th class="manage-column column-title column-primary"><a href="">Product Type Name</a></th>
				<th>Product Type Description</th>
				<th>Product Type Attributes</th>
			</tr>
		</tfoot>
	</table>
	<input type="submit" name="delete_checked_variable_product_button" value="Delete" id="delete_checked_product" class="button button-primary simp_ec_btn_submit" />
</form>


<?php	

	if(isset($_POST['delete_checked_variable_product_button']))
	{
		if(isset($_POST['bulk-delete'])) { 
		$buik_delete = $_POST['bulk-delete'];

			foreach ( $buik_delete as $delete_product )
			{
				$wpdb->delete( $table_pt, array( 'ptype_id' => $delete_product ) );
				echo "<meta http-equiv='refresh' content='0'>";
			}

		}

	}

?>