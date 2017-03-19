<?php 

function simp_ec_add_category_page_html()
{
?>
    <div class="wrap">
        <h2>Categories</h2>
	        <form action="#add_category" method="post" name="add_category">
				<label for="pcat_name">Category Name</label> 
				<input id="pcat_name" type="text" name="pcat_name" value="" /> <hr/>

			<input type="submit" value="Submit" class="button button-primary" />
		</form>
    </div>

<?php
    global $wpdb;
	$table_test = $wpdb->prefix . "simp_ec_test";

	if(isset($_POST['pcat_name']))	{ 
		$pcat_name = $_POST['pcat_name']; 

		$query = array('testname' => $pcat_name, 
						'testrate' => 7,
						'test_time' => current_time( 'mysql' ));

		$format = array('%d', '%s', '%s');

		//Format for wpdb->insert
		//table name, query as an array, the format of the data in a array

		//$wpdb->prepare(
			$wpdb->insert($table_test, $query, null);

		//, '');

	}

}

?>