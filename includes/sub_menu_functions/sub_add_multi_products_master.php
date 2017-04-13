<?php 
/**
 * @since 		1.0.0
 * @package		Simplified_Ecommerce
**/

function simp_ec_add_multiple_products_html()
{ 
	$active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'tab_table_view';
	include_once (SIMPLIFIED_ECOMMERCE_ROOT_PATH . 'includes/table_names.php');
	$rows = 5;
	$count = 0;
	$product = array();
	?>
	<!-- Create a header in the default WordPress 'wrap' container -->
   <div class="wrap simp_ec_container">
        <h1 class="wp-heading-inline"><?php echo get_admin_page_title(); ?></h1>
        <form class="simp_ec_form" action="#add_products" method="post" name="add_products">
        <input type="submit" style="" value="Add Products" class="page-title-action" />
        <span style="float:right;"> 
	        <div class="insert-product-display" style="display:inline-block; padding-top: 18px;">
	        	<a href="?page=add_multiple_product&tab=tab_table_view" class="page-title-action <?php echo $active_tab == 'tab_table_view' ? 'nav-tab-active' : ''; ?>">
	        		<span class="dashicons dashicons-editor-table"></span> Table
	        	</a>
	        	<a href="?page=add_multiple_product&tab=tab_list_view" class="page-title-action <?php echo $active_tab == 'tab_list_view' ? 'nav-tab-active' : ''; ?>">
	        		<span class="dashicons dashicons-editor-ul"></span> List
	        	</a>
	        </div>
	        <div class="add-rows" style="display:inline-block; padding-top: 8px; padding-left: 10px;">
	        	<input style="width:55px;" id="rows" type="number" name="number_of_rows" />
	        	<a href="" style=" padding-top: 4px;" class="page-title-action">Add Rows</a>	
	        </div>
	    </span>
        <hr class="wp-header-end">
        <?php settings_errors(); 
        	if( isset( $_GET[ 'tab' ] ) ) {
			    $active_tab = $_GET[ 'tab' ];
			} // end if

	        if( $active_tab == 'tab_table_view' ) {
	        	include_once (SIMPLIFIED_ECOMMERCE_ROOT_PATH . 'includes/sub_menu_functions/tabbed_functions/sub_add_multi_products_table.php');
	        } else {
	            include_once (SIMPLIFIED_ECOMMERCE_ROOT_PATH . 'includes/sub_menu_functions/tabbed_functions/sub_add_multi_products_list.php');
	        } 

			if((isset($_POST['pname'])) || (isset($_POST['sku'])) || (isset($_POST['pdesc'])) || (isset($_POST['pshortdesc'])) || (isset($_POST['pprice'])) ){

				$product_id = $wpdb->insert_id;
				$pname = array_map( 'esc_attr', $_POST['pname'] );
				$product_sku = array_map( 'esc_attr', $_POST['sku']);
				$pdesc = array_map( 'esc_attr', $_POST['pdesc']);
				$pshortdesc = array_map( 'esc_attr', $_POST['pshortdesc']);
				$pprice = array_map( 'esc_attr', $_POST['pprice']);
				
				if (!empty($pname)) 
				{
					foreach( $pname as $name ) {
						$count++;
					}
				}
				elseif (!empty($product_sku)) {
					foreach( $product_sku as $sku ) {
						$count++;
					}
				}
				elseif (!empty($pshortdesc)) {
					foreach( $pshortdesc as $sdesc ) {
						$count++;
					}
				}
				elseif (!empty($pdesc)) {
					foreach( $pdesc as $desc ) {
						$count++;
					}
				}

				for ($i=0; $i< $count; $i++){

					$query = array('product_id' => $product_id,
							'product_sku' => $product_sku[$i],
							'pname' => $pname[$i], 
							'pdesc' => $pdesc[$i],
							'pshortdesc' => $pshortdesc[$i],
							'pprice' => $pprice[$i]);

					if (!empty($pname[$i]) || !empty($product_sku[$i]) || !empty($pdesc[$i]) || !empty($pshortdesc[$i]) || !empty($pprice[$i]))
				    {
				        $wpdb->insert($table_product, $query, null);
				    }
					
				}  

			}
	    ?>
        </form>
    </div><!-- /.wrap simp_ec_container-->
<?php }



