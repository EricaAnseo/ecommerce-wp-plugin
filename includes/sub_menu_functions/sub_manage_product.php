<?php 
/**
 * @since 		1.0.0
 * @package		Simplified_Ecommerce
**/

function simp_ec_manage_products_page_html()
{
	include_once (SIMPLIFIED_ECOMMERCE_ROOT_PATH . 'includes/table_names.php');
	$active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'tab_view_products';
	$sort_by = isset( $_GET[ 'sort' ] ) ? $_GET[ 'sort' ] : 'sort_by_id';
	$select_query = 'SELECT * FROM ' . $table_product;

	if( $sort_by == 'sort_by_name' ) {
    	$select_query = 'SELECT * FROM ' . $table_product . ' ORDER BY pname';
    } else if( $sort_by == 'sort_by_price' ) {
    	$select_query = 'SELECT * FROM ' . $table_product . ' ORDER BY product_sku';
    } else {
        $select_query = 'SELECT * FROM ' . $table_product;
    } 

	$results_product_category = $wpdb->get_results( 'SELECT * FROM ' . $table_pcs . ' JOIN ' . $table_pc . ' ON ' .  $table_pcs .'.pcat_id = ' . $table_pc . '.pcat_id JOIN ' . $table_product . ' ON ' .  $table_product .'.product_id = ' . $table_pcs . '.product_id');
	$results_product_type = $wpdb->get_results( 'SELECT * FROM ' . $table_pv . ' JOIN ' . $table_product . ' ON ' .  $table_product .'.product_id = ' . $table_pv . '.product_id JOIN ' . $table_pt . ' ON ' .  $table_pt .'.ptype_id = ' . $table_pv . '.ptype_id');
	$results = $wpdb->get_results($select_query);
	$no_of_products = $wpdb->get_var( 'SELECT COUNT(*) FROM '  . $table_product);
	$categories = $wpdb->get_results( 'SELECT * FROM ' . $table_pc);
	$count = 0;

	?>

	<div class="wrap simp_ec_container">
		<h1 class="wp-heading-inline"><?php echo get_admin_page_title(); ?></h1>
		
        <span style="float:right;"> 
	        <div class="insert-product-display" style="display:inline-block; padding-top: 18px;">
	        	<a href="?page=simplified-ecommerce&tab=tab_view_products" class="page-title-action <?php echo $active_tab == 'tab_view_products' ? 'nav-tab-active' : ''; ?>">
	        		<span class="dashicons dashicons-editor-table"></span> View
	        	</a>
	        	<a href="?page=add_multiple_product" class="page-title-action">
			    	<span class="dashicons dashicons-plus"></span> Add
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

			if( isset( $_GET[ 'sort' ] ) ) {
			    $sort_by = $_GET[ 'sort' ];
			} // end if

	        if( $active_tab == 'tab_view_products' ) {
	        	include_once (SIMPLIFIED_ECOMMERCE_ROOT_PATH . 'includes/sub_menu_functions/tabbed_functions/sub_manage_product_view.php');
	        } else {
	            include_once (SIMPLIFIED_ECOMMERCE_ROOT_PATH . 'includes/sub_menu_functions/tabbed_functions/sub_manage_product_update.php');
	        } 
	    ?>
	    <p>Number of products added <?php echo $no_of_products ?></p>
	</div>
<?php

}

