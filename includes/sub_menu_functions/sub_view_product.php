<?php 

function simp_ec_view_products_page_html()
{
	global $wpdb;

	$table_product = $wpdb->prefix . "simp_ec_product"; 

	$results = $wpdb->get_results( 'SELECT * FROM ' . $table_product);
	$no_of_products = $wpdb->get_var( 'SELECT COUNT(*) FROM '  . $table_product);
	?>

	<h1>Products</h1>
	<table>
		<tr>
			<th></th>
			<th>Name</th>
			<th>SKU</th>
			<th>Description</th>
			<th>Short Description</th>
			<th>Price</th>
			<th></th>
		</tr>
<?php

	if($results)
	{

		foreach ( $results as $product )
		{ ?>
			
			<tr>
				<td><input type="checkbox" name="bulk-delete[]" value="<?php echo $product->product_id ?>" /></td>
				<td><?php echo $product->pname ?></td>
				<td><?php echo $product->product_sku ?></td>
				<td><?php echo $product->pdesc ?></td>
				<td><?php echo $product->pshortdesc ?></td>
				<td><?php echo $product->pprice ?></td>
				<td>
					<form id="delete_product_form" action="#delete-product" method="post" onsubmit="return confirm('Are you sure you want to delete this product?');"">
						<input type="submit" name="Delete" value="Delete" class="button button-primary" />
						<input type='hidden' name="product_id" value="<?php echo $product->product_id ?>"/>
					</form>
				</td>
			</tr>

		<?php }

	}


?>
	</table>
	<p>Number of products added <?php echo $no_of_products ?></p>
<?php
	if(isset($_POST['product_id']))	{ 
		$id = $_POST['product_id'];
		$table_product = $wpdb->prefix . "simp_ec_product"; 
		$wpdb->delete( $table_product, array( 'product_id' => $id ) );
		echo "<meta http-equiv='refresh' content='0'>";
	}

}

