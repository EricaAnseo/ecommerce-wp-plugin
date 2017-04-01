<?php 

function simp_ec_view_products_page_html()
{
	global $wpdb;
	$table_product = $wpdb->prefix . "simp_ec_product"; 
	$table_pc = $wpdb->prefix . "simp_ec_product_category"; 

	$select_query = 'SELECT * FROM ' . $table_product;

	$results = $wpdb->get_results($select_query );
	$no_of_products = $wpdb->get_var( 'SELECT COUNT(*) FROM '  . $table_product);
	$categories = $wpdb->get_results( 'SELECT * FROM ' . $table_pc);

	?>

	<div class="wrap">
		<h1>Products</h1>
		<table class="wp-list-table widefat fixed">
			<thead>
				<tr>
					<td class="manage-column column-cb check-column">
					<input style="display: block;" type="checkbox" name="bulk-delete[]" value="" /></td>
					<th class="manage-column column-title column-primary"><a href="<?php the_permalink() . 'page=simplified-ecommerce?sort=name'?>">Name</a></th>
					<th><a href="#sort=name">SKU</a></th>
					<th>Description</th>
					<th>Short Description</th>
					<th>Price</th>
					<th>Category</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
<?php

	if ($_GET['sort'] == 'name')
	{
	    $select_query .= " ORDER BY pname";
	}
	

	if($results){

		foreach ( $results as $product ){ 
?>
			
				<tr>
					<td><input type="checkbox" name="bulk-delete[<?php echo $product->product_id ?>]" value="<?php echo $product->product_id ?>" /></td>
					<td><?php echo $product->pname ?></td>
					<td><?php echo $product->product_sku ?></td>
					<td><?php echo $product->pdesc ?></td>
					<td><?php echo $product->pshortdesc ?></td>
					<td><?php echo $product->pprice ?></td>
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
					<td>
						<form id="delete_product_form" action="#delete-product" method="post" onsubmit="return confirm('Are you sure you want to delete this product?');"">
							<input type="submit" name="Delete" value="Delete" class="button button-primary" />
							<input type='hidden' name="delete_product_id" value="<?php echo $product->product_id ?>"/>
						</form>
					</td>
				</tr>

<?php 	} ?>

			</tbody>
		</table>
		<div class="view-product-buttons">
			<input type="submit" name="Delete" value="Delete" class="button action" />
			<input type="submit" name="Update" value="Update" class="button action" />
		</div>

<?php	} 

	else{
		echo "</tbody></table>";
		echo '<p>You currently have no products added.</p>'; 
	}
	?>
		
	<p>Number of products added <?php echo $no_of_products ?></p>

</div>

<?php
	if(isset($_POST['delete_product_id'])) { 
		$id = $_POST['delete_product_id'];
		$table_product = $wpdb->prefix . "simp_ec_product"; 
		$wpdb->delete( $table_product, array( 'product_id' => $id ) );
		echo "<meta http-equiv='refresh' content='0'>";
	}

	if(isset($_POST['bulk-delete'])) { 
		$buik_delete = $_POST['bulk-delete'];

		foreach ( $buik_delete as $product_id )
		{
			echo 'deleting' . $product_id ;
		}


	}

}

