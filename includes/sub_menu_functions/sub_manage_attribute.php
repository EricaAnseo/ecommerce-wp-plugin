<?php
/**
 * @since 		1.0.0
 * @package		Simplified_Ecommerce
**/

function simp_ec_manage_attribute_page_html()
{
	include_once (SIMPLIFIED_ECOMMERCE_ROOT_PATH . 'includes/table_names.php');
	$active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'tab_product_attribute_view';
	$results_ptype = $wpdb->get_results( 'SELECT * FROM ' . $table_pt);
	$results_pattribute = $wpdb->get_results( 'SELECT * FROM ' . $table_pa);
	$results_join = $wpdb->get_results( 'SELECT * FROM ' . $table_pat . ' JOIN ' . $table_pa . ' ON ' .  $table_pat .'.pattribute_id = ' . $table_pa . '.pattribute_id JOIN ' . $table_pt . ' ON ' .  $table_pt .'.ptype_id = ' . $table_pat . '.ptype_id');
	$no_of_product_types = $wpdb->get_var( 'SELECT COUNT(*) FROM '  . $table_pt);
	$rows = 4;
	$product_type_count = 0;
	$product_attribute_count = 0;
?>
	<div class="wrap simp_ec_container">
	<h1 class="wp-heading-inline"><?php echo get_admin_page_title(); ?></h1> 

	<?php 
		if( $active_tab == 'tab_product_attribute_add' ) { ?>
        	<div class="add-rows" style="display:inline-block; padding-top: 8px; padding-left: 10px; float: right;">
	        	<input style="width:55px;" id="rows" type="number" name="number_of_rows" min="0" />
	        	<a href="" style=" padding-top: 4px;" class="page-title-action">Add Rows</a>	
	        </div>
    <?php } ?>

    <span style="float:right;"> 
        <div class="insert-product-display" style="display:inline-block; padding-top: 18px;">
        	<a href="?page=manage_attribute_sub&tab=tab_product_attribute_view" class="page-title-action <?php echo $active_tab == 'tab_product_attribute_view' ? 'nav-tab-active' : ''; ?>">
        		<span class="dashicons dashicons-editor-table"></span> View
        	</a>
        	<a href="?page=manage_attribute_sub&tab=tab_product_attribute_add" class="page-title-action <?php echo $active_tab == 'tab_product_attribute_add' ? 'nav-tab-active' : ''; ?>">
        		<span class="dashicons dashicons-plus"></span> Add
        	</a>
        	<a href="?page=manage_attribute_sub&tab=tab_product_attribute_edit" class="page-title-action <?php echo $active_tab == 'tab_product_attribute_edit' ? 'nav-tab-active' : ''; ?>">
        		<span class="dashicons dashicons-edit"></span> Edit
        	</a>
        </div>
    </span>
    <hr class="wp-header-end">
     <?php settings_errors(); 
    	if( isset( $_GET[ 'tab' ] ) ) {
		    $active_tab = $_GET[ 'tab' ];
		} // end if

        if( $active_tab == 'tab_product_attribute_view' ) {
        	include_once (SIMPLIFIED_ECOMMERCE_ROOT_PATH . 'includes/sub_menu_functions/tabbed_functions/sub_manage_product_attribute_view.php');
        } 
        else if( $active_tab == 'tab_product_attribute_add') {
            include_once (SIMPLIFIED_ECOMMERCE_ROOT_PATH . 'includes/sub_menu_functions/tabbed_functions/sub_manage_product_attribute_add.php');
        } 
        else {
            include_once (SIMPLIFIED_ECOMMERCE_ROOT_PATH . 'includes/sub_menu_functions/tabbed_functions/sub_manage_product_attribute_update.php');
        } ?>
   	</div>

<?php }
    


