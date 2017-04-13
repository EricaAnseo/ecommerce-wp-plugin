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
				<td><input type="checkbox" name="bulk-delete[<?php echo $category->pcat_id ?>]" value="bulk-delete[<?php echo $category->pcat_id ?>]" /></td>
				<td><?php echo $category->pcat_name ?></td>
				<td><?php echo $category->pcat_slug ?></td>
				<td><?php echo $category->pcat_desc ?></td>
				<td></td>
			</tr>
		<?php 	}

		}

	else{?>

<?php 	} ?>
			<tr class="simp_ec_row_insert">
				<form action="#add_category" method="post" name="add_category">
				<td><span class="dashicons dashicons-plus"></span></td>
				<td class="simp_ec_column_insert">
					<textarea id="pcat_name" class="simp_ec_textarea" type="text" name="pcat_name" placeholder="The Name of your category"></textarea>
				</td>		
				<td class="simp_ec_column_insert">
					<textarea id="pcat_name" class="simp_ec_textarea" type="text" name="pcat_slug" placeholder="The unique name of the category, all in lowercase with no spaces"></textarea>
				</td> 
				<td class="simp_ec_column_insert"><textarea id="pcat_desc" class="simp_ec_textarea" type="text" name="pcat_desc" value="" placeholder="A description explaining your category"></textarea></td>
				<td></td>
			</tr>
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
<input type="submit" value="Add Category" class="button button-primary simp_ec_btn_submit" />
</form>
</div>

<?php


if(isset($_POST['pcat_name']) || isset($_POST['pcat_slug']) || isset($_POST['pcat_desc']) )	{ 

	$pcat_name = sanitize_text_field( $_POST['pcat_name'] );
	$pcat_slug = sanitize_text_field( $_POST['pcat_slug'] );
	$pcat_desc = sanitize_text_field( $_POST['pcat_desc'] );
	$pcat_id = $wpdb->insert_id; 

	$query = array('pcat_id' => $pcat_id, 
					'pcat_name' => $pcat_name,
					'pcat_slug' => $pcat_slug,
					'pcat_desc' => $pcat_desc,
					'pcat_url' => '');

	//Format for wpdb->insert
	//table name, query as an array, the format of the data in a array
	$wpdb->insert($table_pc, $query, null);
	echo "<meta http-equiv='refresh' content='0'>";

}



