<?php
/**
 * @since 		1.0.0
 * @package		Simplified_Ecommerce
**/

function simp_ec_manage_product_types_page_html()
{
	include_once (SIMPLIFIED_ECOMMERCE_ROOT_PATH . 'includes/table_names.php'); 

	$results = $wpdb->get_results( 'SELECT * FROM ' . $table_pa);
	$no_of_products = $wpdb->get_var( 'SELECT COUNT(*) FROM '  . $table_pa);

?>

<div class="wrap simp_ec_container">
	<h1><?php echo get_admin_page_title(); ?></h1>
		<form action="#add_product_types_attributes" method="post" name="add_product">
				<label for="ptype_name">Product Type Name</label> 
				<input id="ptype_name" type="text" name="ptype_name" /> <hr/>

				<label for="ptype_desc">Product Type Desciption</label> 
				<textarea id="ptype_desc" type="text" name="ptype_desc" ></textarea> <hr/>

				<label for="pattribute_name">Product Type Attributes</label> 
				<textarea id="pattribute_name" type="text" name="pattribute_name" ></textarea> <hr/>				

			<input type="submit" value="Submit" class="button button-primary" />
		</form>

</div>

<?php 

	if(isset($_POST['ptype_name']) || isset($_POST['ptype_desc']) || isset($_POST['pattribute_name']) )	{ 

		$ptype_name = sanitize_text_field( $_POST['ptype_name'] );
		$ptype_desc = sanitize_text_field( $_POST['ptype_desc'] );
		$pattribute_name = sanitize_text_field( $_POST['pattribute_name'] );
		$lastid = $wpdb->insert_id; 

		$query_type = array('ptype_id' => $lastid,
					'ptype_name' => $ptype_name,
					'ptype_desc' => $ptype_desc);

		$query_attribute = array('pattribute_id' => $lastid,
					'pattribute_name' => $pattribute_name
					);

		$query_attribute_types = array('ptype_id' => $lastid,
					'pattribute_id' => $lastid
					);

		$wpdb->insert($table_pt, $query_type, null);
		$wpdb->insert($table_pa, $query_attribute, null);


	}

}

