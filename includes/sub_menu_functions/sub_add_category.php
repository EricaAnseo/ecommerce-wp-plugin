<?php 

function simp_ec_add_category_page_html()
{
	global $wpdb;
	$table_pc = $wpdb->prefix . "simp_ec_product_category"; 

	$results = $wpdb->get_results( 'SELECT * FROM ' . $table_pc); ?>

	<div class="wrap">
    	<h2>Product Categories</h2>

	<?php
	if($results){

		foreach ( $results as $category ){ ?>
			<p>Category Name</p>
			<p><?php echo $category->pcat_name ?></p>
			<p>Category Slug</p>
			<h4><?php echo $category->pcat_slug ?></h4>
			<p>Category Description</p>
			<h4><?php echo $category->pcat_desc ?></h4>




	<?php }

	}

	else{?>


<?php 	}

?>
   
	    <form action="#add_category" method="post" name="add_category">
			<label for="pcat_name">Category Name</label> 
			<input id="pcat_name" type="text" name="pcat_name" value="" />
			<label for="pcat_slug">Category Slug</label> 
			<input id="pcat_slug" type="text" name="pcat_slug" value="" /> 
			<label for="pcat_desc">Category Description</label> 
			<textarea id="pcat_desc" type="text" name="pcat_desc" value="" ></textarea>
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