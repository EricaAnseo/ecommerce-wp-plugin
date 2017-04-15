<?php 
/**
 * @since 		1.0.0
 * @package		Simplified_Ecommerce
**/
?>
<form> 
	<table class="wp-list-table widefat fixed">
		<thead>
			<tr>
				<td class="manage-column column-cb check-column">
					<input style="display: block;" type="checkbox" name="bulk-delete[vproduct_id]" value="" />
				</td>
				<th class="manage-column column-title column-primary"><a href="">Variation Name</a></th>
				<th>SKU</th>
				<th>Price (&euro;)</th>
				<th>Parent Product</th>
				<th>Product Attributes</th>
				<th>Stock</th>
				<th class="column_delete"></th>
			</tr>
		</thead>
		<tbody>
			<td>vproduct_id</td>
		</tbody>
		<tfoot>
			<tr>
				<td class="manage-column column-cb check-column">
					<input style="display: block;" type="checkbox" name="bulk-delete[]" value="" />
				</td>
				<th class="manage-column column-title column-primary"><a href="">Variation Name</a></th>
				<th>SKU</th>
				<th>Price (&euro;)</th>
				<th>Parent Product</th>
				<th>Product Attributes</th>
				<th>Stock</th>
				<th class="column_delete"></th>
			</tr>
		</tfoot>
	</table>
</form>