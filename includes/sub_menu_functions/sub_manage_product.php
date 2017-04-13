<?php 
/**
 * @since 		1.0.0
 * @package		Simplified_Ecommerce
**/

function simp_ec_manage_products_page_html()
{
	include_once (SIMPLIFIED_ECOMMERCE_ROOT_PATH . 'includes/table_names.php');
	$active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'tab_view_products';

	$select_query = 'SELECT * FROM ' . $table_product;
	$results = $wpdb->get_results($select_query );
	$no_of_products = $wpdb->get_var( 'SELECT COUNT(*) FROM '  . $table_product);
	$categories = $wpdb->get_results( 'SELECT * FROM ' . $table_pc . ' LIMIT 10');
	$count = 0;

	?>

	<div class="wrap simp_ec_container">
		<h1 class="wp-heading-inline"><?php echo get_admin_page_title(); ?></h1>
		
        <span style="float:right;"> 
	        <div class="insert-product-display" style="display:inline-block; padding-top: 18px;">
	        	<a href="?page=simplified-ecommerce&tab=tab_view_products" class="page-title-action <?php echo $active_tab == 'tab_view_products' ? 'nav-tab-active' : ''; ?>">
	        		<span class="dashicons dashicons-editor-table"></span> View
	        	</a>
	        	<a href="?page=simplified-ecommerce&tab=tab_update_products" class="page-title-action <?php echo $active_tab == 'tab_update_products' ? 'nav-tab-active' : ''; ?>">
	        		<span class="dashicons dashicons-edit"></span> Edit
	        	</a>
	        </div>
	    </span>

	    <hr class="wp-header-end">
        <?php settings_errors(); 
        	if( isset( $_GET[ 'tab' ] ) ) {
			    $active_tab = $_GET[ 'tab' ];
			} // end if

	        if( $active_tab == 'tab_view_products' ) {
	        	include_once (SIMPLIFIED_ECOMMERCE_ROOT_PATH . 'includes/sub_menu_functions/tabbed_functions/sub_manage_product_view.php');
	        } else {
	            include_once (SIMPLIFIED_ECOMMERCE_ROOT_PATH . 'includes/sub_menu_functions/tabbed_functions/sub_manage_product_update.php');
	        } 
	    ?>

<?php
	if(isset($_POST['delete_product_id'])) { 
		$id = $_POST['delete_product_id'];
		$wpdb->delete( $table_product, array( 'product_id' => $id ) );
		echo "<meta http-equiv='refresh' content='0'>";
	}

	if(isset($_POST['delete_checked_product_button']))
	{
		echo '<h2>Delete button clicked</h2>';

		if(isset($_POST['checked_product'])) { 
			echo '<h2>items checked</h2>';
		}

		if(isset($_POST['bulk-delete'])) { 
		$buik_delete = $_POST['bulk-delete'];

			foreach ( $buik_delete as $delete_product )
			{
				//if($delete_product=='checked'){
					echo 'deleting' . $delete_product ;
				//}
			}

		}

	}


	

	echo '</div>';

}

