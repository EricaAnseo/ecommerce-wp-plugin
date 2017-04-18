<?php 
/**
 * @since 		1.0.0
 * @package		Simplified_Ecommerce
**/
?>
<form id="delete_product_form" action="#delete-product" method="post" onsubmit="return confirm('Are you sure you want to delete these products?');">
	<table class="wp-list-table widefat fixed">
		<thead>
			<tr>
				<td class="manage-column column-cb check-column">
					<input type="checkbox" name="bulk-delete[]" value="" />
				</td>
				<th class="manage-column column-title column-primary sortable desc">
					<a href="?page=simplified-ecommerce&sort=name" class=" <?php echo $sort_by == 'sort_by_name' ? 'nav-tab-active' : ''; ?> "><span>Name</span><span class="sorting-indicator"></span></a>
				</th>
				<th class="table_head_sku"><a href="?page=simplified-ecommerce&sort=price" class=" <?php echo $sort_by == 'sort_by_name' ? 'nav-tab-active' : ''; ?> ">SKU</a></th>
				<th class="table_head_price">Price (&euro;)</th>
				<th>Short Description</th>
				<th>Description</th>
				<th>Product Type</th>
				<th>Category</th>
			</tr>
		</thead>
		<tbody>
<?php

	if($results){ ?>

<?php
		foreach ( $results as $product ){ 
?>
			<tr>
				<th class="check-column"><input type="checkbox" name="bulk-delete[]" value="<?php echo $product->product_id ?>" /></th>
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
			</tr>
<?php 	} ?>

		</tbody>
		<tfoot>
			<tr>
				<td class="manage-column column-cb check-column">
					<input type="checkbox" name="bulk-delete[]" value="" />
				</td>
                <th>Name</th>
                <th>SKU</th>
                <th class="table_head_price">Price (&euro;)</th>
                <th>Short Description</th>
                <th>Description</th>
                <th>Product Type</th>
               	<th>Category</th>
    		</tr>
		</tfoot>
	</table>
	<input type="submit" name="delete_checked_product_button" value="Delete" id="delete_checked_product" class="button button-primary simp_ec_btn_submit" />
</form>
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

		if(isset($_POST['bulk-delete'])) { 
		$buik_delete = $_POST['bulk-delete'];

			foreach ( $buik_delete as $delete_product )
			{
				$wpdb->delete( $table_product, array( 'product_id' => $delete_product ) );
				echo "<meta http-equiv='refresh' content='0'>";
			}

		}

	}

?>
		
