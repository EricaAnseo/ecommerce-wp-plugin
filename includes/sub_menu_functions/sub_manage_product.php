<?php 

function simp_ec_manage_products_page_html()
{
	include_once (SIMPLIFIED_ECOMMERCE_ROOT_PATH . 'includes/table_names.php');

	$select_query = 'SELECT * FROM ' . $table_product;

	$results = $wpdb->get_results($select_query );
	$no_of_products = $wpdb->get_var( 'SELECT COUNT(*) FROM '  . $table_product);
	$categories = $wpdb->get_results( 'SELECT * FROM ' . $table_pc . ' LIMIT 10');

	?>

	<div class="wrap">
		<h1 class="wp-heading-inline"><?php echo get_admin_page_title(); ?></h1>
		<table class="wp-list-table widefat fixed">
			<thead>
				<tr>
					<td class="manage-column column-cb check-column">
						<input style="display: block;" type="checkbox" name="bulk-delete[]" value="" />
					</td>
					<th class="manage-column column-title column-primary"><a href="<?php //the_permalink() . 'page=simplified-ecommerce?sort=name'?>">Name</a></th>
					<th><a href="#sort=name">SKU</a></th>
					<th>Short Description</th>
					<th>Description</th>
					<th>Price</th>
					<th>Category</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
<?php

	//if ($_GET['sort'] == 'name')
	//{
	//    $select_query .= " ORDER BY pname";
	//}
	

	if($results){ ?>

	<form action="#checked_product" method="post" id="checked_product" name="checked_product">

<?php

		foreach ( $results as $product ){ 
?>
			
				<tr>
					<td><input type="checkbox" name="bulk-delete[<?php echo $product->product_id ?>]" value="bulk-delete[<?php echo $product->product_id ?>]" /></td>
					<td><?php echo $product->pname ?></td>
					<td><?php echo $product->product_sku ?></td>
					<td><?php echo $product->pshortdesc ?></td>
					<td><?php echo $product->pdesc ?></td>
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
			</form>
<?php 	} ?>

			</tbody>
			<tfoot>
				<tr>
					<td class="manage-column column-cb check-column">
						<input style="display: block;" type="checkbox" name="bulk-delete[]" value="" />
					</td>
	                <th>Name</th>
	                <th>SKU</th>
	                <th>Short Description</th>
	                <th>Description</th>
	                <th>Price</th>
	               	<th>Category</th>
					<th></th>
        		</tr>
			</tfoot>
		</table>
		<div class="view-product-buttons">
			<form action="#delete_checked_product" method="post"  name="delete_checked_product">
				<input type="submit" name="delete_checked_product_button" value="Delete" id="delete_checked_product" class="button action" />
			</form>
			<input type="submit" name="Update" value="Update" class="button action" />
		</div>

<?php	} 

	else{
		echo "</tbody></table>";
		echo '<p>You currently have no products added.</p>'; 
	}
	?>
		
	<p>Number of products added <?php echo $no_of_products ?></p>


<?php
	if(isset($_POST['delete_product_id'])) { 
		$id = $_POST['delete_product_id'];
		$table_product = $wpdb->prefix . "simp_ec_product"; 
		$wpdb->delete( $table_product, array( 'product_id' => $id ) );
		echo "<meta http-equiv='refresh' content='0'>";
	}

	if(isset($_POST['delete_checked_product_button']))
	{
		echo '<h2>Delete button clicked</h2>';

		if(isset($_POST['checked_product'])) { 
			echo '<h2>items checked</h2>';
		}

		if(isset($_POST['bulk-delete'])) { 
		$buik_delete = $_POST['bulk-delete'];

		echo '<h1>something happened</h1>';

			foreach ( $buik_delete as $delete_product )
			{
				//if($delete_product=='checked'){
					echo 'deleting' . $delete_product ;
				//}
			}


		}
	}


	

	echo '</div>';

}

