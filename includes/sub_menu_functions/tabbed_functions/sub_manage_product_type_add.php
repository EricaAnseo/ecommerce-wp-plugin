<?php 
/**
 * @since 		1.0.0
 * @package		Simplified_Ecommerce
**/
?>

<form action="#add_product_types_attributes" method="post" name="add_product">
	<table class="wp-list-table widefat fixed simp_ec_table_view">
		<thead>
			<tr>
				<td class="manage-column column-cb check-column"></td>
				<th class="manage-column column-title column-primary">Product Type Name</th>
				<th>Product Type Description</th>
				<th>Product Type Attributes</th>
			</tr>
		</thead>
		<tbody>
	<?php
		for ($i=0; $i< $rows; $i++){ ?>
			<tr class="simp_ec_row_insert">
				<td></td>
				<td class="simp_ec_column_insert"><textarea id="ptype_name" class="simp_ec_textarea" type="text" name="ptype_name[<?php echo $i ?>]" ></textarea></td>
				<td class="simp_ec_column_insert"><textarea id="ptype_desc" class="simp_ec_textarea" type="text" name="ptype_desc[<?php echo $i ?>]" ></textarea></td>
				<td class="simp_ec_column_insert"><textarea id="pattribute_name" class="simp_ec_textarea" type="text" name="pattribute_name[<?php echo $i ?>]" ></textarea></td>
			</tr>

	<?php
			} //for
	?>

		</tbody>
		<tfoot>
			<tr>
				<td class="manage-column column-cb check-column"></td>
				<th class="manage-column column-title column-primary">Product Type Name</th>
				<th>Product Type Description</th>
				<th>Product Type Attributes</th>
			</tr>
		</tfoot>
	</table>
	<input type="submit" value="Add" name="add_product_types_and_attributes" class="button button-primary simp_ec_btn_submit" />
</form>

<?php 

if(isset($_POST['add_product_types_and_attributes']))
{

	if(isset($_POST['ptype_name']) || isset($_POST['ptype_desc']) || isset($_POST['pattribute_name']) )	{ 

		$ptype_name = array_map( 'esc_attr', $_POST['ptype_name'] );
		$ptype_desc = array_map( 'esc_attr', $_POST['ptype_desc'] );
		$pattribute_name = array_map( 'esc_attr', $_POST['pattribute_name'] );
		$lastid = $wpdb->insert_id; 

		if (!empty($ptype_name)) 
		{
			foreach( $ptype_name as $type_name ) {
				$product_type_count++;
			}
		} 

		if (!empty($pattribute_name)) 
		{
			foreach( $pattribute_name as $product_attribute ) {
				$product_attribute_count++;
			}
		} 

		for ($i=0; $i< $product_type_count; $i++){

			$query_type = array('ptype_id' => $lastid,
					'ptype_name' => $ptype_name[$i],
					'ptype_desc' => $ptype_desc[$i]);

			if (!empty($ptype_name[$i]))
		    {
		        $wpdb->insert($table_pt, $query_type, null);
		    }

			$pattributes = explode(",",$pattribute_name[$i]);

   			foreach($pattributes as $patt)
   			{

				$query_attribute = array('pattribute_id' => $lastid,
							'pattribute_name' => $patt);

				$wpdb->insert($table_pa, $query_attribute, null);
			    		

				$foreign_key_type = $wpdb->get_results( 'SELECT * FROM ' . $table_pt . ' WHERE ptype_name = "' . $ptype_name[$i] . '"');
				$foreign_attribute_key = $wpdb->get_results( 'SELECT * FROM ' . $table_pa . ' WHERE pattribute_name = "' . $patt . '"');
				
				foreach( $foreign_key_type as $product_type ) {
					foreach( $foreign_attribute_key as $product_attribute ) {
						$query_attribute_types = array('ptype_id' => $product_type->ptype_id,
								'pattribute_id' => $product_attribute->pattribute_id );
						$wpdb->insert($table_pat, $query_attribute_types, null);
					}
				}
			}
		}
	}

}
