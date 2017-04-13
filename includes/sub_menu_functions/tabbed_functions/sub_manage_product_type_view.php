<?php 
/**
 * @since 		1.0.0
 * @package		Simplified_Ecommerce
**/
?>
<table class="wp-list-table widefat fixed">
	<thead>
		<tr>
			<td class="manage-column column-cb check-column">
				<input style="display: block;" type="checkbox" name="bulk-delete[]" value="" />
			</td>
			<th class="manage-column column-title column-primary"><a href="">Product Type Name</a></th>
			<th>Product Type Description</th>
			<th>Product Type Attributes</th>
			<th class="column_delete"></th>
		</tr>
	</thead>
	<tbody>
<?php
	if($results_ptype && $results_pattribute){ 
		foreach ( $results_ptype as $product_type){ 
?>
		<tr>
			<td><input type="checkbox" name="bulk-delete[<?php echo $product_type->ptype_id ?>]" value="bulk-delete[<?php echo $product->ptype_id ?>]" /></td>
			<td><?php echo $product_type->ptype_name ?></td>
			<td><?php echo $product_type->ptype_desc ?></td>
			<td><?php foreach ($results_join as $product_attribute){ 
				if($product_attribute->ptype_id == $product_type->ptype_id)
				{
					echo $product_attribute->pattribute_name . ', ';
				}
			} ?></td>
			<td></td>
		</tr>

<?php
		} //foreach 
	}//results
?>

	</tbody>
	<tfoot>
		<tr>
			<td class="manage-column column-cb check-column">
				<input style="display: block;" type="checkbox" name="bulk-delete[]" value="" />
			</td>
			<th class="manage-column column-title column-primary"><a href="">Product Type Name</a></th>
			<th>Product Type Description</th>
			<th>Product Type Attributes</th>
			<th class="column_delete"></th>
		</tr>
	</tfoot>
</table>