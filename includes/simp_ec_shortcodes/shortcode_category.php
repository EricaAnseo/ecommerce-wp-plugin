<?php 

function simp_ec_shortcode_category ($atts)
{
	include_once (SIMPLIFIED_ECOMMERCE_ROOT_PATH . 'includes/table_names.php');
	$results = null;

}

add_shortcode('category', 'simp_ec_shortcode_category');


?>