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
<form action="#add_category" method="post" name="add_category">
	<?php if($results){
			foreach ( $results as $category ){ ?>
			<tr class="simp_ec_row_insert">
				<td><input type="checkbox" name="bulk-delete[<?php echo $category->pcat_id ?>]" value="bulk-delete[<?php echo $category->pcat_id ?>]" /></td>
				<td class="simp_ec_column_insert"> 
					<textarea id="pcat_name" class="simp_ec_textarea" type="text" name="pcat_name[<?php echo $category->pcat_id ?>]" ><?php echo $category->pcat_name ?></textarea>
				</td>
				<td class="simp_ec_column_insert">
					<textarea id="pcat_slug" class="simp_ec_textarea" type="text" name="pcat_slug[<?php echo $category->pcat_id ?>]" ><?php echo $category->pcat_slug ?></textarea>
				</td>
				<td class="simp_ec_column_insert">
					<textarea id="pcat_desc" class="simp_ec_textarea" type="text" name="pcat_desc[<?php echo $category->pcat_id ?>]" ><?php echo $category->pcat_desc ?></textarea>
				</td>
				<td> </td>
			</tr>
		<?php 	}

		}

	else{?>

<?php 	} ?>
	</tbody>
	<tfoot>
		<tr>
			<td class="manage-column column-cb check-column"><input type="checkbox" name="bulk-delete[]" value="bulk-delete[]" /></td>
			<th>Category Name</th>
			<th>Category Slug</th>
			<th>Category Description</th>
			<th></th>
		</tr>
	</tfoot>
</table>
<input type="submit" value="Update" name="update_category_button" class="button button-primary simp_ec_btn_submit" />
</form>
</div>

<?php

if(isset($_POST['update_category_button']))
{

	$pcat_name = array_map( 'esc_attr', $_POST['pcat_name'] );
	$pcat_slug = array_map( 'esc_attr', $_POST['pcat_slug'] );	
	$pcat_desc = array_map( 'esc_attr', $_POST['pcat_desc'] );
	

	if($results)
	{
		foreach( $results as $category ) {
			if($pcat_name[$category->pcat_id] != $category->pcat_name || $pcat_slug[$category->pcat_id] != $category->pcat_slug || $pcat_desc[$category->pcat_id] != $category->pcat_desc){
			
				$query = array('pcat_name' => $pcat_name[$category->pcat_id],
					'pcat_slug' => $pcat_slug[$category->pcat_id],
					'pcat_desc' => $pcat_desc[$category->pcat_id]);

				$where = array('pcat_id' => $category->pcat_id);

				//Format for updating a table
				//Table Name, query, where condition, data type for query, data type for where
				$wpdb->update($table_pc, $query, $where, null, null ); 
				echo "<meta http-equiv='refresh' content='0'>";

			}
			else
			{
				
			}

		}

	}		

}