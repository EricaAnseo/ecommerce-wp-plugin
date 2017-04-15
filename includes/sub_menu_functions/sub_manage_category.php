<?php 
/**
 * @since 		1.0.0
 * @package		Simplified_Ecommerce
**/

function simp_ec_manage_category_page_html()
{
	include_once (SIMPLIFIED_ECOMMERCE_ROOT_PATH . 'includes/table_names.php');
	$active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'tab_view_category';
	$results = $wpdb->get_results( 'SELECT * FROM ' . $table_pc); 
	$rows = 5; 
	$count = 0;?>

	<div class="wrap simp_ec_container">
    	<h1 class="wp-heading-inline"><?php echo get_admin_page_title(); ?></h1>
        <span style="float:right;"> 
	        <div class="insert-product-display" style="display:inline-block; padding-top: 18px;">
	        	<a href="?page=add_category_sub&tab=tab_view_category" class="page-title-action <?php echo $active_tab == 'tab_view_category' ? 'nav-tab-active' : ''; ?>">
	        		<span class="dashicons dashicons-editor-table"></span> View
	        	</a>
	        	<a href="?page=add_category_sub&tab=tab_add_category" class="page-title-action <?php echo $active_tab == 'tab_add_category' ? 'nav-tab-active' : ''; ?>">
	        		<span class="dashicons dashicons-plus"></span> Add
	        	</a>
	        	<a href="?page=add_category_sub&tab=tab_edit_category" class="page-title-action <?php echo $active_tab == 'tab_edit_category' ? 'nav-tab-active' : ''; ?>">
	        		<span class="dashicons dashicons-edit"></span> Edit
	        	</a>
	        </div>
	    </span>
	    <hr class="wp-header-end">
	     <?php settings_errors(); 
        	if( isset( $_GET[ 'tab' ] ) ) {
			    $active_tab = $_GET[ 'tab' ];
			} // end if

	        if( $active_tab == 'tab_view_category' ) {
	        	include_once (SIMPLIFIED_ECOMMERCE_ROOT_PATH . 'includes/sub_menu_functions/tabbed_functions/sub_manage_category_view.php');
	        }
	        else if( $active_tab == 'tab_add_category' ) {
	        	include_once (SIMPLIFIED_ECOMMERCE_ROOT_PATH . 'includes/sub_menu_functions/tabbed_functions/sub_manage_category_add.php');
	        }  
	        else {
	            include_once (SIMPLIFIED_ECOMMERCE_ROOT_PATH . 'includes/sub_menu_functions/tabbed_functions/sub_manage_category_update.php');
	        } 
}

?>