<?php 
/**
 * @since 		1.0.0
 * @package		Simplified_Ecommerce
**/
?>
<!-- <form id="delete_product_form" action="#delete-product" method="post" onsubmit="return confirm('Are you sure you want to delete these products?');"> -->
	<table class="wp-list-table widefat fixed">
		<thead>
			<tr>
				<td class="manage-column column-cb check-column">
					<input style="display: block;" type="checkbox" name="bulk-delete[]" value="" />
				</td>
				<th class="manage-column column-title column-primary">
					<a href="?page=simplified-ecommerce&sort=tab_view_products&sort=name" class=" <?php echo $sort_by == 'sort_by_name' ? 'nav-tab-active' : ''; ?>">Name</a>
				</th>
				<th><a href="#sort=name">SKU</a></th>
				<th>Price (&euro;)</th>
				<th>Short Description</th>
				<th>Description</th>
				<th>Product Type</th>
				<th>Category</th>
				<th class="column_delete"></th> 
			</tr>
		</thead>
		<tbody>
<?php

	if($results){ ?>

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
					<?php 
						foreach($results_product_type as $ptype)
						{
							if ($product->product_id == $ptype->product_id) {
								echo $ptype->ptype_name . ', ';

							}
						} ?>
				</td>
				<td>
					<?php 
						foreach($results_product_category as $pcategory)
						{
							if ($product->product_id == $pcategory->product_id) {
								echo $pcategory->pcat_name . ', ';

							}
						} ?>
				</td>
				<td class="simp_ec_row_delete">
					<form id="delete_product_form" action="#delete-product" method="post" onsubmit="return confirm('Are you sure you want to delete this product?');">
						<button type="submit" name="delete_product_btn" value="Delete" class="button simp_ec_btn_delete"> <span class="dashicons dashicons-trash"></span></button>
						<input type="hidden" name="delete_product_id" value="<?php echo $product->product_id ?>"/>
					</form>
				</td>
			</tr>
<?php 	} ?>

		</tbody>
		<tfoot>
			<tr>
				<td class="manage-column column-cb check-column">
					<input style="display: block;" type="checkbox" name="bulk-delete[]" value="" />
				</td>
                <th>Name</th>
                <th>SKU</th>
                <th>Price (&euro;)</th>
                <th>Short Description</th>
                <th>Description</th>
                <th>Product Type</th>
               	<th>Category</th>
				<th></th>
    		</tr>
		</tfoot>
	</table>
	<input type="submit" name="delete_checked_product_button" value="Delete" id="delete_checked_product" class="button button button-primary simp_ec_btn_submit" />
<!-- </form> -->
<?php	} 

	else{
		echo "</tbody></table>";
		echo '<p>You currently have no products added.</p>'; 
	}


	if(isset($_POST['delete_product_btn'])) { 
		$delete_product_id = $_POST['delete_product_id'];
		//echo $delete_product_id;

		$wpdb->delete( $table_product, array( 'product_id' => $delete_product_id ) );
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

			foreach ( $buik_delete as $delete_product )
			{
				//if($delete_product=='checked'){
					echo 'deleting' . $delete_product ;
				//}
			}

		}

	}

?>
		
