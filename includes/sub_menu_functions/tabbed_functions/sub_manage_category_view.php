<?php 
/**
 * @since 		1.0.0
 * @package		Simplified_Ecommerce
**/
?>  
<form action="#delete_categories" method="post" name="delete_categories">
<table class="wp-list-table widefat fixed simp_ec_table_view">
	<thead>
		<tr>
			<td class="manage-column column-cb check-column"><input type="checkbox" name="bulk-delete[]" value="bulk-delete[]" /></td>
			<th>Category Name</th>
			<th>Category Slug</th>
			<th>Category Description</th>
			<th class="column_delete"></th>
		</tr>
	</thead>
	<tbody>
					
	<?php if($results){
			foreach ( $results as $category ){ ?>
			<tr >
				<th class="check-column">
					<input type="checkbox" name="bulk-delete[]" value="<?php echo $category->pcat_id ?>" />
				</th>
				<td><?php echo $category->pcat_name ?></td>
				<td><?php echo $category->pcat_slug ?></td>
				<td><?php echo $category->pcat_desc ?></td>
				<td></td>
			</tr>
		<?php 	}

		}

	else{?>

<?php 	} ?>
	</tbody>
	<tfoot>
		<tr>
			<td class="manage-column column-cb check-column">
				<input type="checkbox" name="bulk-delete[]" value="" />
			</td>
			<th>Category Name</th>
			<th>Category Slug</th>
			<th>Category Description</th>
			<th></th>
		</tr>
	</tfoot>
</table>
<input type="submit" value="Delete" name="delete_checked_categories_button" class="button button-primary simp_ec_btn_submit" />
</form>


<?php
	
	if(isset($_POST['delete_checked_categories_button']))
	{

		if(isset($_POST['bulk-delete'])) { 
		$buik_delete = $_POST['bulk-delete'];

			foreach ( $buik_delete as $delete_variable )
			{
				$wpdb->delete($table_pc, array('pcat_id' => $delete_variable));
				echo "<meta http-equiv='refresh' content='0'>";
			}

		}

	}

?>



