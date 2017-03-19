<?php 

function simp_ec_view_products_page_html()
{
	global $wpdb;

	$table_product = $wpdb->prefix . "simp_ec_product"; 

	$results = $wpdb->get_results( 'SELECT * FROM ' . $table_product);
	$no_of_products = $wpdb->get_var( 'SELECT COUNT(*) FROM '  . $table_product);

	echo "<p>Products added {$no_of_products}</p>";
	?>

	<p>Number of products added <?php echo $no_of_products ?></p>

<?php
	if($results)
	{
		foreach ( $results as $product )
		{ 
			?>
			<p>Product Name: <?php echo $product->pname ?> </p>

		<?php } 
	}
	else
	{

	}
?>
<p></p>
<?php

}

