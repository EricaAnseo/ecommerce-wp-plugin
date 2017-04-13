<?php 
/**
 * @since 		1.0.0
 * @package		Simplified_Ecommerce
**/
?>  
<form action="#add_product_attributes" method="post" name="add_product_attributes">
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
		for ($i=0; $i< $rows; $i++){ ?>
			<tr class="simp_ec_row_insert">
				<td></td>
				<td class="simp_ec_column_insert">
					<select>
						<option value=''></option>
<?php 
						foreach ( $results_ptype as $product_type ){
							echo '<option value="' . $product_type->ptype_id . '">' . $product_type->ptype_name . '</option>';
						}
?>						
					</select>
				</td>
				<td class="simp_ec_column_insert">
					<textarea id="pattribute_name" class="simp_ec_textarea" type="text" style="background-color:#F5F5F5;" name="pattribute_name[<?php echo $i;?>]" ></textarea>
				</td>
				<td></td>
			</tr>
	<?php
		} //for
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
	<input type="submit" value="Add" name="add_attributes" class="button button-primary simp_ec_btn_submit" />
</form>