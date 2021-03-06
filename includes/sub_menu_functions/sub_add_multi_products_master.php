<?php 
/**
 * @since 		1.0.0
 * @package		Simplified_Ecommerce
**/

function simp_ec_add_multiple_products_html()
{ 
	$active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'tab_table_view';

	$rows = isset( $_GET[ 'rows' ] ) ? $_GET[ 'rows' ] : 10;
	include_once (SIMPLIFIED_ECOMMERCE_ROOT_PATH . 'includes/table_names.php');
	$product_types = $wpdb->get_results( 'SELECT * FROM ' . $table_pt);
	$categories = $wpdb->get_results( 'SELECT * FROM ' . $table_pc);
	//$rows = 10;
	$count = 0;
	$product = array();
	?>
	<!-- Create a header in the default WordPress 'wrap' container -->
    <div class="wrap simp_ec_container">
        <h1 class="wp-heading-inline"><?php echo get_admin_page_title(); ?></h1>
        <div class="add-rows" style="display:inline-block; padding-top: 8px; padding-left: 10px;">
        	<form id="add_rows" action="#add_rows" method="post">
        		<input style="width:55px;" id="rows" type="number" min="0" name="number_of_rows" />
        		<input type="submit" style=" padding-top: 4px;" name="add_new_rows" value="Add Rows" class="page-title-action" />
        	</form>
        </div>
        <span style="float:right;"> 
	        <div class="insert-product-display" style="display:inline-block; padding-top: 18px;">
	        	<a href="?page=add_multiple_product&tab=tab_table_view" class="page-title-action <?php echo $active_tab == 'tab_table_view' ? 'nav-tab-active' : ''; ?>">
	        		<span class="dashicons dashicons-editor-table"></span> Table
	        	</a>
	        	<a href="?page=add_multiple_product&tab=tab_list_view" class="page-title-action <?php echo $active_tab == 'tab_list_view' ? 'nav-tab-active' : ''; ?>">
	        		<span class="dashicons dashicons-editor-ul"></span> List
	        	</a>
	        </div>
	    </span>
        <hr class="wp-header-end">
        <form class="simp_ec_form" action="#add_products" method="post" name="add_products">
        <?php settings_errors(); 
        	if( isset( $_GET[ 'tab' ] ) ) {
			    $active_tab = $_GET[ 'tab' ];
			} // end if

	        if( $active_tab == 'tab_table_view' ) {
	        	include_once (SIMPLIFIED_ECOMMERCE_ROOT_PATH . 'includes/sub_menu_functions/tabbed_functions/sub_add_multi_products_table.php');
	        } else {
	            include_once (SIMPLIFIED_ECOMMERCE_ROOT_PATH . 'includes/sub_menu_functions/tabbed_functions/sub_add_multi_products_list.php');
	        } 

	        if(isset( $_POST['add_new_rows'] ))
	        {
	        	if(isset( $_POST['number_of_rows'] ))
		        {
		        	$rows = sanitize_text_field($_POST['number_of_rows']);
		        }

	        }

			if((isset($_POST['pname'])) || (isset($_POST['sku'])) || (isset($_POST['pdesc'])) || (isset($_POST['pshortdesc'])) || (isset($_POST['pprice'])) ){

				$lastid = $wpdb->insert_id;
				$pname = array_map( 'esc_attr', $_POST['pname'] );
				$product_sku = array_map( 'esc_attr', $_POST['sku']);
				$pdesc = array_map( 'esc_attr', $_POST['pdesc']);
				$pshortdesc = array_map( 'esc_attr', $_POST['pshortdesc']);
				$pprice = array_map( 'esc_attr', $_POST['pprice']);
				$ptype = array_map( 'esc_attr', $_POST['ptype'] );
				$category = array_map( 'esc_attr', $_POST['category'] );

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

					$query_product = array('product_id' => $lastid,
							'product_sku' => $product_sku[$i],
							'pname' => $pname[$i], 
							'pdesc' => $pdesc[$i],
							'pshortdesc' => $pshortdesc[$i],
							'pprice' => $pprice[$i], 
							'date_added' => current_time( 'mysql' ));

					if (!empty($pname[$i]) || !empty($product_sku[$i]) || !empty($pdesc[$i]) || !empty($pshortdesc[$i]) || !empty($pprice[$i]))
				    {
				        $wpdb->insert($table_product, $query_product, null);
				        add_action('admin_notices', 'simp_ec_custom_admin_notice_success');

				        if (!empty($ptype[$i]))
				   		{
					   		$product_type = explode(",",$ptype[$i]);

				   			foreach($product_type as $prod_type)
				   			{
					   			$foreign_key_type = $wpdb->get_results( 'SELECT * FROM ' . $table_pt . ' WHERE ptype_name = "' . $prod_type . '"');
						        if($foreign_key_type)
						        {
					        		$foreign_key_product = $wpdb->get_results( 'SELECT * FROM ' . $table_product . ' WHERE pname = "' . $pname[$i] . '"');

					        		$fk_pt_at_join = $wpdb->get_results( 'SELECT * FROM ' . $table_pt . ' JOIN ' . $table_pat . ' ON ' .  $table_pat .'.pattribute_id = ' . $table_pt . '.pattribute_id WHERE ptype_name = "' . $prod_type . '"');

				        			foreach( $foreign_key_product as $product ) {
				        				foreach( $fk_pt_at_join as $product_att_type ) {
					        				
						        			$query_variable_product = array(
						        					'vproduct_id' => $lastid,
						        					'ptype_id' => $product_att_type->ptype_id,
						        					'product_id' => $product->product_id,
						        					'p_attribute' => $product_att_type->pattribute_id);
											$wpdb->insert($table_pv, $query_variable_product, null);
										}
					        		}

					        	}
						        	
					        	else 
					        	{

					        		$query_type = array('ptype_id' => $lastid,
									'ptype_name' => $prod_type,
									'ptype_desc' => '');
					        		$wpdb->insert($table_pt, $query_type, null);
					        		
					        		$foreign_key_product = $wpdb->get_results( 'SELECT * FROM ' . $table_product . ' WHERE pname = "' . $pname[$i] . '"');
					        		$foreign_key_ptype = $wpdb->get_results( 'SELECT * FROM ' . $table_pt . ' WHERE ptype_name = "' . $prod_type . '"');

				        			foreach( $foreign_key_product as $product ) {
				        				foreach( $foreign_key_ptype as $product_type ) {
						        			$query_variable_product = array(
						        					'vproduct_id' => $lastid,
						        					'ptype_id' => $product_type->ptype_id,
						        					'product_id' => $product->product_id, 
						        					'pattribute_id' => 2);
											$wpdb->insert($table_pv, $query_variable_product, null);
										}
					        		}
					        	}
					        }    

				    	}

				    	if (!empty($category[$i]))
				   		{
				   			$cats = explode(",",$category[$i]);

				   			foreach($cats as $cat)
				   			{
				   				$result_categories = $wpdb->get_results( 'SELECT * FROM ' . $table_pc . ' WHERE pcat_name = "' . $cat . '"');
					   			if($result_categories)
						        {
						        	
					        		$foreign_key_produ = $wpdb->get_results( 'SELECT * FROM ' . $table_product . ' WHERE pname = "' . $pname[$i] . '"');

					        		foreach( $result_categories as $fk_category ) {
					        			foreach( $foreign_key_produ as $fk_product ) {
					        				$query_product_cat = array(
						        					'pcat_id' => $fk_category->pcat_id,
						        					'product_id' => $fk_product->product_id);
											$wpdb->insert($table_pcs, $query_product_cat, null);
					        			}
					        		}
						        	
					        	}

					        	else
					        	{
				        		 	$query_category = array('pcat_id' => $lastid, 
									'pcat_name' => $cat,
									'pcat_slug' => $cat);

							        $wpdb->insert($table_pc, $query_category, null);

							        $foreign_key_category = $wpdb->get_results( 'SELECT * FROM ' . $table_pc . ' WHERE pcat_name = "' . $cat . '"');
					        		$foreign_key_produ = $wpdb->get_results( 'SELECT * FROM ' . $table_product . ' WHERE pname = "' . $pname[$i] . '"');

					        		foreach( $foreign_key_produ as $prod ) {
					        			foreach( $foreign_key_category as $fkcategory ) {
					        				$query_product_cat = array(
						        					'pcat_id' => $fkcategory->pcat_id,
						        					'product_id' => $prod->product_id);
											$wpdb->insert($table_pcs, $query_product_cat, null);
					        			}//foreach fkcategory
					        		}//foreach prod
					        	}//else
				   			}

				   		}//if not empty
					
					}//if values not empty 					

				}

			}

	    ?>
        </form>
    </div><!-- /.wrap simp_ec_container-->
<?php }

// display custom admin notice
function simp_ec_custom_admin_notice_success() { ?>
	
	<div class="notice notice-success is-dismissible">
		<p><?php _e('Products successfully added.', 'simpEc'); ?></p>
	</div>
	
<?php }

