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
			<th class="manage-column column-title column-primary"><a href="<?php //the_permalink() . 'page=simplified-ecommerce?sort=name'?>">Name</a></th>
			<th><a href="#sort=name">SKU</a></th>
			<th>Price</th>
			<th>Short Description</th>
			<th>Description</th>
			<th>Category</th>
			<th class="column_delete"></th>
		</tr>
	</thead>
	<tbody>
<?php
	//if ($_GET['sort'] == 'name')
	//{
	//    $select_query .= " ORDER BY pname";
	//}
	if($results){ ?>

	<!-- <form action="#checked_product" method="post" id="checked_product" name="checked_product"> -->

<?php
		foreach ( $results as $product ){ 
?>

			<tr>
				<td><input type="checkbox" name="bulk-delete[<?php echo $product->product_id ?>]" value="bulk-delete[<?php echo $product->product_id ?>]" /></td>
				<td><?php echo $product->pname ?></td>
				<td><?php echo $product->product_sku ?></td>
				<td><?php echo $product->pprice ?></td>
				<td><?php echo $product->pshortdesc ?></td>
				<td><?php echo $product->pdesc ?></td>
				<td>
					<select>
						<option value=''></option>
<?php 
						foreach ( $categories as $category ){
							echo '<option value="' . $category->pcat_id . '">' . $category->pcat_name . '</option>';
						}
?>						
					</select>

				</td>
				<td class="simp_ec_row_delete">
					<form id="delete_product_form" action="#delete-product" method="post" onsubmit="return confirm('Are you sure you want to delete this product?');"">
						<button type="submit" name="Delete" value="Delete" class="button simp_ec_btn_delete"> <span class="dashicons dashicons-trash"></span></button>
					<input type='hidden' name="delete_product_id" value="<?php echo $product->product_id ?>"/>
					</form>
				</td>
			</tr>
<?php 	} ?>
			<!-- </form> -->
			</tbody>
			<tfoot>
				<tr>
					<td class="manage-column column-cb check-column">
						<input style="display: block;" type="checkbox" name="bulk-delete[]" value="" />
					</td>
	                <th>Name</th>
	                <th>SKU</th>
	                <th>Price</th>
	                <th>Short Description</th>
	                <th>Description</th>
	               	<th>Category</th>
					<th></th>
        		</tr>
			</tfoot>
		</table>
		<div class="view-product-buttons">
			<form action="#delete_checked_product" method="post"  name="delete_checked_product">
				<input type="submit" name="delete_checked_product_button" value="Delete" id="delete_checked_product" class="button action" />
			</form>
			<input type="submit" name="Update" value="Update" class="button action simp_ec_btn_submit" />
		</div>

<?php	} 

	else{
		echo "</tbody></table>";
		echo '<p>You currently have no products added.</p>'; 
	}

	?>
		
	<p>Number of products added <?php echo $no_of_products ?></p>
