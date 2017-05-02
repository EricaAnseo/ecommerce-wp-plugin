<form action="#add_category" method="post" name="add_category">
	<table class="wp-list-table widefat fixed simp_ec_table_view">
		<thead>
			<tr>
				<td class="manage-column column-cb check-column"></td>
				<th>Category Name</th>
				<th>Category Slug</th>
				<th>Category Description</th>
				<th class="column_delete"></th>
			</tr>
		</thead>
		<tbody>
			
		<?php for ($i=0; $i< $rows; $i++){ ?>
			<tr class="simp_ec_row_insert">
				<td></td>
				<td class="simp_ec_column_insert"> 
					<textarea id="pcat_name" class="simp_ec_textarea" type="text" name="pcat_name[<?php echo $i; ?>]" ></textarea>
				</td>
				<td class="simp_ec_column_insert">
					<textarea id="pcat_slug" class="simp_ec_textarea" type="text" name="pcat_slug[<?php echo $i; ?>]" ></textarea>
				</td>
				<td class="simp_ec_column_insert">
					<textarea id="pcat_desc" class="simp_ec_textarea" type="text" name="pcat_desc[<?php echo $i; ?>]" ></textarea>
				</td>
				<td></td>
			</tr>
		<?php } ?>

		</tbody>
		<tfoot>
			<tr>
				<td class="manage-column column-cb check-column"></td>
				<th>Category Name</th>
				<th>Category Slug</th>
				<th>Category Description</th>
				<th></th>
			</tr>
		</tfoot>
	</table>
	<input type="submit" value="Add Category" name="add_category_button" class="button button-primary simp_ec_btn_submit" />
</form>
</div>

<?php

if(isset($_POST['add_category_button']))
{

	if(isset($_POST['pcat_name']) || isset($_POST['pcat_slug']) || isset($_POST['pcat_desc']) ){

		$pcat_name = array_map( 'esc_attr', $_POST['pcat_name'] );
		$pcat_slug = array_map( 'esc_attr', $_POST['pcat_slug'] );	
		$pcat_desc = array_map( 'esc_attr', $_POST['pcat_desc'] );
		$pcat_id = $wpdb->insert_id;

		if (!empty($pcat_name)) 
		{
			foreach( $pcat_name as $category_name ) {
				$count++;
			}
		}
		elseif (!empty($pcat_slug)) {
			foreach( $pcat_slug as $category_slug ) {
				$count++;
			}
		}
		elseif (!empty($pcat_desc)) {
			foreach( $pcat_desc as $category_desc ) {
				$count++;
			}
		}

		for ($i=0; $i< $count; $i++){

			$query = array('pcat_id' => $pcat_id, 
					'pcat_name' => $pcat_name[$i],
					'pcat_slug' => $pcat_slug[$i],
					'pcat_desc' => $pcat_desc[$i]);

			if (!empty($pcat_name[$i]) || !empty($pcat_slug[$i]) || !empty($pcat_desc[$i]))
		    {
		    	//Format for wpdb->insert
				//table name, query as an array, the format of the data in a array
		        $wpdb->insert($table_pc, $query, null);
		    }
			
		} 

	}		

}