<?php 
/**
 * @since 		1.0.0
 * @package		Simplified_Ecommerce
**/

function simp_ec_manage_variable_products_html()
{ 
	include_once (SIMPLIFIED_ECOMMERCE_ROOT_PATH . 'includes/table_names.php');
	$active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'tab_view_variable_product';
?>
	<!-- Create a header in the default WordPress 'wrap' container -->
    <div class="wrap simp_ec_container">
        <h1 class="wp-heading-inline"><?php echo get_admin_page_title(); ?></h1>
        <span style="float:right;"> 
	        <div class="insert-product-display" style="display:inline-block; padding-top: 18px;">
			    <a href="?page=manage_variable_product&tab=tab_view_variable_product" class="page-title-action <?php echo $active_tab == 'tab_view_variable_product' ? 'nav-tab-active' : ''; ?>">
			    	<span class="dashicons dashicons-editor-table"></span> View
			    </a>
			    <a href="?page=manage_variable_product&tab=tab_add_variable_product" class="page-title-action <?php echo $active_tab == 'tab_edit_add_variable_product' ? 'nav-tab-active' : ''; ?>">
			    	<span class="dashicons dashicons-plus"></span> Add
			    </a>
			    <a href="?page=manage_variable_product&tab=tab_edit_variable_product" class="page-title-action <?php echo $active_tab == 'tab_edit_variable_product' ? 'nav-tab-active' : ''; ?>">
			    	<span class="dashicons dashicons-edit"></span> Edit
			    </a>
			</div>
	    </span>
	    <?php
	    	settings_errors(); 
        	if( isset( $_GET[ 'tab' ] ) ) {
			    $active_tab = $_GET[ 'tab' ];
			} // end if
	         
	        if( $active_tab == 'tab_view_variable_product' ) {
	        	include_once (SIMPLIFIED_ECOMMERCE_ROOT_PATH . 'includes/sub_menu_functions/tabbed_functions/sub_manage_variable_products_view.php');
	        } 

	        else if( $active_tab == 'tab_add_variable_product' ) {
	        	include_once (SIMPLIFIED_ECOMMERCE_ROOT_PATH . 'includes/sub_menu_functions/tabbed_functions/sub_manage_variable_products_add.php');
	        }

	        else {
	        	include_once (SIMPLIFIED_ECOMMERCE_ROOT_PATH . 'includes/sub_menu_functions/tabbed_functions/sub_manage_variable_products_edit.php');
	        } // end if/else
	         
	         
	    ?>

         
    </div><!-- /.wrap -->
<?php }

