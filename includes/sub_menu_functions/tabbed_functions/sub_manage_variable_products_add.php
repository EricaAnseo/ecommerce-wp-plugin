<?php 
/**
 * @since 		1.0.0
 * @package		Simplified_Ecommerce
**/
?>
<form> 
	<table class="wp-list-table widefat fixed simp_ec_table_view">
		<thead>
			<tr>
				<td class="manage-column column-cb check-column"></td>
				<th class="manage-column column-title column-primary"><a href="">Variation Name</a></th>
				<th class="table_head_sku">SKU</th>
				<th class="table_head_price">Price (&euro;)</th>
				<th class="table_head_price">Stock</th>
				<th>Parent Product</th>
				<th>Product Attributes</th>
				<th class="column_delete"></th>
			</tr>
		</thead>
		<tbody>
	<?php for ($i=0; $i< $rows; $i++){ ?>
			<tr class="simp_ec_row_insert">
				<td></td>
				<td class="simp_ec_column_insert"><textarea id="vproduct_name" class="simp_ec_textarea" type="text" name="vproduct_name[<?php echo $i; ?>]" ></textarea></td>
				<td class="simp_ec_column_insert"><textarea id="vproduct_sku" class="simp_ec_textarea" type="text" name="vproduct_sku[<?php echo $i; ?>]" ></textarea></td>
				<td class="simp_ec_column_insert"><input id="vproduct_price" class="simp_ec_input_number" min="0" placeholder="0" type="number" name="vproduct_price[<?php echo $i ?>]" /></td>
				<td class="simp_ec_column_insert"><input id="vproduct_stock" class="simp_ec_input_number" min="0" placeholder="0" type="number" name="vproduct_stock[<?php echo $i ?>]" /></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
	<?php } //for ?>
		</tbody>
		<tfoot>
			<tr>
				<td class="manage-column column-cb check-column">
					<input style="display: block;" type="checkbox" name="bulk-delete[]" value="" />
				</td>
				<th class="manage-column column-title column-primary"><a href="">Variation Name</a></th>
				<th class="table_head_sku">SKU</th>
				<th class="table_head_price">Price (&euro;)</th>
				<th class="table_head_price">Stock</th>
				<th>Parent Product</th>
				<th>Product Attributes</th>
				<th class="column_delete"></th>
			</tr>
		</tfoot>
	</table>
	<input type="submit" name="delete_checked_product_button" value="Delete" id="delete_checked_product" class="button button-primary simp_ec_btn_submit" />
</form>

<?php 

	if((isset($_POST['pname'])) || (isset($_POST['sku'])) || (isset($_POST['pdesc'])) || (isset($_POST['pshortdesc'])) || (isset($_POST['pprice'])) ){

		$product_id = $wpdb->insert_id;
		$pname = array_map( 'esc_attr', $_POST['pname'] );
		$product_sku = array_map( 'esc_attr', $_POST['sku']);
		$pdesc = array_map( 'esc_attr', $_POST['pdesc']);
		$pshortdesc = array_map( 'esc_attr', $_POST['pshortdesc']);
		$pprice = array_map( 'esc_attr', $_POST['pprice']);
		
		
		if (!empty($pname)) 
		{
			foreach( $pname as $name ) {
				$count++;
			}
		}
		elseif (!empty($product_sku)) {
			foreach( $product_sku as $sku ) {
				$count++;
			}
		}
		elseif (!empty($pshortdesc)) {
			foreach( $pshortdesc as $sdesc ) {
				$count++;
			}
		}
		elseif (!empty($pdesc)) {
			foreach( $pdesc as $desc ) {
				$count++;
			}
		}

		for ($i=0; $i< $count; $i++){

			$query_product = array('product_id' => $product_id,
					'product_sku' => $product_sku[$i],
					'pname' => $pname[$i], 
					'pdesc' => $pdesc[$i],
					'pshortdesc' => $pshortdesc[$i],
					'pprice' => $pprice[$i]);

			

			if (!empty($pname[$i]) || !empty($product_sku[$i]) || !empty($pdesc[$i]) || !empty($pshortdesc[$i]) || !empty($pprice[$i]))
		    {
		        $wpdb->insert($table_product, $query_product, null);
		    }
			
		}  

	}
?>