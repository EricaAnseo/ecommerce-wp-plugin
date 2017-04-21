<?php 
/**
 * @since 		1.0.0
 * @package		Simplified_Ecommerce
**/
?>  
<form action="#update_product_attributes" method="post" name="update_product_attributes">
	<table class="wp-list-table widefat fixed simp_ec_table_update">
		<thead>
			<tr>
				<td class="manage-column column-cb check-column"></td>
				<th class="manage-column column-title column-primary">Product Type Name</th>
				<th>Product Type Attribute</th>
			</tr>
		</thead>
		<tbody>
	<?php
		if($results_join && $results_pattribute){ 
			foreach ( $results_join as $product_attribute_type){ 
	?>
			<tr class="simp_ec_row_update">
				<td></td>
				<td class="simp_ec_column_update">
					<select name="product_type[<?php echo $product_attribute_type->pattribute_id; ?>]">
<?php 
						foreach ( $results_ptype as $result_type ){
							if ($product_attribute_type->ptype_id==$result_type->ptype_id)
							{
								echo '<option value="' . $result_type->ptype_id . '"selected="selected" >' . $result_type->ptype_name . '</option>';
							} 
							else
							{
								echo '<option value="' . $result_type->ptype_id . '">' . $result_type->ptype_name . '</option>';
							}
						}
?>						
					</select>
				</td>
				<td class="simp_ec_column_update">
					<textarea id="pattribute_name" class="simp_ec_textarea" type="text" name="pattribute_name[<?php echo $product_attribute_type->pattribute_id ?>]" ><?php echo $product_attribute_type->pattribute_name ?></textarea>
				</td>
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
			</tr>
		</tfoot>
	</table>
	<input type="submit" value="Update" name="update_attributes" class="button button-primary simp_ec_btn_submit" />
</form>

<?php 
if(isset($_POST['update_attributes']))
{

	if(isset($_POST['product_type']) || isset($_POST['pattribute_name']) )	{ 

		$pattribute_name = array_map( 'esc_attr', $_POST['pattribute_name'] );
		$product_type = array_map( 'esc_attr', $_POST['product_type'] );

		if($results_join)
		{
			foreach($results_join as $attribute_types)
			{
				if($pattribute_name[$attribute_types->pattribute_id] != $attribute_types->pattribute_name)
				{
					$query = array('pattribute_name' => $pattribute_name[$attribute_types->pattribute_id]);
					$where = array('pattribute_id' => $attribute_types->pattribute_id);
					//Format for updating a table
					//Table Name, query, where condition, data type for query, data type for where
					$wpdb->update($table_pa, $query, $where, null, null ); 
					echo "<meta http-equiv='refresh' content='0'>";

				}

				if($product_type[$attribute_types->pattribute_id] != $attribute_types->ptype_id)
				{
					$query = array('ptype_id' => $product_type[$attribute_types->pattribute_id]);
					$where = array('pattribute_id' => $attribute_types->pattribute_id);
					$wpdb->update($table_pat, $query, $where, null, null ); 
					echo "<meta http-equiv='refresh' content='0'>";
				}
			}
		}	

	}			

}
 
?> 