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
				<td class="manage-column column-cb check-column">
				</td>
				<th class="manage-column column-title column-primary">Product Type Name</th>
				<th>Product Type Description</th>
				<th>Product Type Attributes</th>
			</tr>
		</thead>
		<tbody>
	<?php
		if($results_ptype && $results_pattribute){ 
			foreach ( $results_ptype as $product_type){  ?>
			<tr class="simp_ec_row_insert">
				<td></td>
				<td class="simp_ec_column_insert"><textarea id="ptype_name" class="simp_ec_textarea" type="text" name="ptype_name[<?php echo $product_type->ptype_id ?>]" ><?php echo $product_type->ptype_name ?></textarea></td>
				<td class="simp_ec_column_insert"><textarea id="ptype_desc" class="simp_ec_textarea" type="text" name="ptype_desc[<?php echo $product_type->ptype_id ?>]" ><?php echo $product_type->ptype_desc ?></textarea></td>
				<td class="simp_ec_column_insert"><textarea id="pattribute_name" class="simp_ec_textarea" type="text" name="pattribute_name[<?php echo $product_type->ptype_id ?>]" ><?php foreach ($results_join as $product_attribute){ 
					if($product_attribute->ptype_id == $product_type->ptype_id)
					{
						echo $product_attribute->pattribute_name . ', ';
					}
				} ?></textarea></td>
			</tr>

	<?php
			} //for
		} //if
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
	<input type="submit" value="Update" name="update_product_types_and_attributes" class="button button-primary simp_ec_btn_submit" />
</form>

<?php 

if(isset($_POST['update_product_types_and_attributes']))
{

	if(isset($_POST['ptype_name']) || isset($_POST['ptype_desc']) || isset($_POST['pattribute_name']) )	{ 

		$ptype_name = array_map( 'esc_attr', $_POST['ptype_name'] );
		$ptype_desc = array_map( 'esc_attr', $_POST['ptype_desc'] );
		$pattribute_name = array_map( 'esc_attr', $_POST['pattribute_name'] );

		if($results_ptype && $results_pattribute)
		{
			foreach( $results_ptype as $product_type ) {
				if($ptype_name[$product_type->ptype_id] != $product_type->ptype_name || $ptype_desc[$product_type->ptype_id] != $product_type->ptype_desc || $pattribute_name[$product_type->ptype_id] != $product->pattribute_name)
				{
					$query = array('product_sku' => $product_sku[$product->product_id],
						'pname' => $pname[$product->product_id], 
						'pdesc' => $pdesc[$product->product_id],);

					$where = array('product_id' => $product->product_id);

					//Format for updating a table
					//Table Name, query, where condition, data type for query, data type for where
					$wpdb->update($table_product, $query, $where, null, null ); 

					$message = "Product Successfully Updated";
					echo "<meta http-equiv='refresh' content='0'>";

				}
				else
				{
					
				}

			}

		}			

	

		/*$ptype_name = array_map( 'esc_attr', $_POST['ptype_name'] );
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

			$query_attribute = array('pattribute_id' => $lastid,
						'pattribute_name' => $pattribute_name[$i]);

			if (!empty($ptype_name[$i]))
		    {
		        $wpdb->insert($table_pt, $query_type, null);
				$wpdb->insert($table_pa, $query_attribute, null);
		    }

			$foreign_key_type = $wpdb->get_results( 'SELECT * FROM ' . $table_pt . ' WHERE ptype_name = "' . $ptype_name[$i] . '"');
			$foreign_attribute_key = $wpdb->get_results( 'SELECT * FROM ' . $table_pa . ' WHERE pattribute_name = "' . $pattribute_name[$i] . '"');
			
			foreach( $foreign_key_type as $product_type ) {
				foreach( $foreign_attribute_key as $product_attribute ) {
					$query_attribute_types = array('ptype_id' => $product_type->ptype_id,
							'pattribute_id' => $product_attribute->pattribute_id );
					$wpdb->insert($table_pat, $query_attribute_types, null);
				}
			}
			
		}*/
	}

}