<?php 
/**
 * @since 		1.0.0
 * @package		Simplified_Ecommerce
**/

function simp_ec_manage_category_page_html()
{
	include_once (SIMPLIFIED_ECOMMERCE_ROOT_PATH . 'includes/table_names.php');

	$results = $wpdb->get_results( 'SELECT * FROM ' . $table_pc); ?>

	<div class="wrap simp_ec_container">
    	<h1><?php echo get_admin_page_title(); ?></h1>
    		<table class="wp-list-table widefat fixed">
    			<thead>
	    			<tr>
	    				<td>Category Name</td>
	    				<td>Category Slug</td>
	    				<td>Category Description</td>
	    			</tr>
	    		</thead>
	    		<tbody>
				    			
	<?php
	if($results){

			foreach ( $results as $category ){ ?>
					<tr>
						<td><?php echo $category->pcat_name ?></td>
						<td><?php echo $category->pcat_slug ?></td>
						<td><?php echo $category->pcat_desc ?></td>
					</tr>
	<?php }

	}

	else{?>

<?php 	} ?>

		   		<tr>
				    <form action="#add_category" method="post" name="add_category">
					<td><input id="pcat_name" type="text" name="pcat_name" value="" /></td>		
					<td><input id="pcat_slug" type="text" name="pcat_slug" value="" /></td> 
					<td><textarea id="pcat_desc" type="text" name="pcat_desc" value="" ></textarea></td>
					
				</tr>
			</tbody>
		</table>
		<input type="submit" value="Submit" class="button button-primary" />
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

	}

}

?>