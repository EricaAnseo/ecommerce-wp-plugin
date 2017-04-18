<?php 
/**
 * @since 		1.0.0
 * @package		Simplified_Ecommerce
**/
?>  
<form id="delete_product_attribute_form" action="#delete-product_attribute" method="post" onsubmit="return confirm('Are you sure you want to delete these product attributes?');">
<table class="wp-list-table widefat fixed">
	<thead>
		<tr>
			<td class="manage-column column-cb check-column">
				<input type="checkbox" name="bulk-delete[]" value="" />
			</td>
			<th class="manage-column column-title column-primary"><a href="">Product Type Name</a></th>
			<th><a href="">Product Type Attribute</a></th>
		</tr>
	</thead>
	<tbody>
<?php
	if($results_join && $results_pattribute){ 
		foreach ( $results_join as $product_attribute_type){ 
?>
		<tr>
			<th class="check-column">
				<input type="checkbox" name="bulk-delete[]" value="<?php echo $product_attribute_type->pattribute_id ?>" />
				</th>
			<td><?php echo $product_attribute_type->ptype_name ?></td>
			<td><?php echo $product_attribute_type->pattribute_name ?></td>
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
			<th><a href="">Product Type Attribute</a></th>
		</tr>
	</tfoot>
</table>
<input type="submit" name="delete_checked_product_attribute_button" value="Delete" id="delete_checked_product_attribute" class="button button-primary simp_ec_btn_submit" />
</form>
<?php	

	if(isset($_POST['delete_checked_product_attribute_button']))
	{
		echo '<h2>Delete button clicked</h2>';

		if(isset($_POST['bulk-delete'])) { 
		$buik_delete = $_POST['bulk-delete'];

			foreach ( $buik_delete as $delete_variable )
			{
				$wpdb->delete( $table_pt, array( 'ptype_id' => $delete_variable ) );
				echo "<meta http-equiv='refresh' content='0'>";
			}

		}

	}

?>