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
			<th><a href="">Product Type Attribute</a></th>
			<th class="column_delete"></th>
		</tr>
	</thead>
	<tbody>
<?php
	if($results_join && $results_pattribute){ 
		foreach ( $results_join as $product_attribute_type){ 
?>
		<tr>
			<td><input type="checkbox" name="bulk-delete[<?php echo $product_type->ptype_id ?>]" value="bulk-delete[<?php echo $product->ptype_id ?>]" /></td>
			<td><?php echo $product_attribute_type->ptype_name ?></td>
			<td><?php echo $product_attribute_type->pattribute_name ?></td>
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
			<th><a href="">Product Type Attribute</a></th>
			<th class="column_delete"></th>
		</tr>
	</tfoot>
</table>