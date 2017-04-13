<?php 
/**
 * @since 		1.0.0
 * @package		Simplified_Ecommerce
**/
?>  
<form action="#update_product_attributes" method="post" name="update_product_attributes">
	<table class="wp-list-table widefat fixed simp_ec_table_view">
		<thead>
			<tr>
				<td class="manage-column column-cb check-column"></td>
				<th class="manage-column column-title column-primary">Product Type Name</th>
				<th>Product Type Attribute</th>
				<th class="column_delete"></th>
			</tr>
		</thead>
		<tbody>
	<?php
		if($results_join && $results_pattribute){ 
			foreach ( $results_join as $product_attribute_type){ 
	?>
			<tr class="simp_ec_row_insert">
				<td></td>
				<td class="simp_ec_column_insert">
					<!-- <textarea id="ptype_name" class="simp_ec_textarea" type="text" name="ptype_name[<?php //echo $product_attribute_type->ptype_id ?>]" > -->
					<?php echo $product_attribute_type->ptype_name ?> <!--</textarea>-->
				</td>
				<td class="simp_ec_column_insert">
					<textarea id="pattribute_name" class="simp_ec_textarea" type="text" style="background-color:#F5F5F5;" name="pattribute_name[<?php echo $product_attribute_type->pattribute_id ?>]" ><?php echo $product_attribute_type->pattribute_name ?></textarea>
				</td>
				<td></td>
			</tr>

	<?php
			} //foreach 
		}//results
	?>

		</tbody>
		<tfoot>
			<tr>
				<td class="manage-column column-cb check-column"></td>
				<th class="manage-column column-title column-primary">Product Type Name</th>
				<th>Product Type Attribute</th>
				<th class="column_delete"></th>
			</tr>
		</tfoot>
	</table>
	<input type="submit" value="Update" name="update_attributes" class="button button-primary simp_ec_btn_submit" />
</form>

<?php 
if(isset($_POST['update_attributes']))
{
	$pattribute_name = array_map( 'esc_attr', $_POST['pattribute_name'] );
}

