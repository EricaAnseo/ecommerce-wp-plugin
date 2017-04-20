<?php
/**
 * @since 		1.0.0
 * @package		Simplified_Ecommerce
**/

function simp_ec_products_page_html()
{
    // check user capabilities
    if (!current_user_can('manage_options')) {
        return;
    }

    ?>
    <div class="wrap simp_ec_container">
        <h1><?php echo get_admin_page_title(); ?></h1>
    	<div class="simp_ec_add_single_product">
	        <form action="#add_product" method="post" name="add_product">
				<div class="col-group">
	                <span class="col-dt-6">
	                	<input id="pname" placeholder="Product Name" style="width: 100%; resize: none; " type="text" name="pname" />
	                	<div class="col-group">
		                	<span class="col-dt-6">
		            			<input id="sku" placeholder="SKU" style="width: 100%;" type="text" name="sku"/>
		            		</span>
		            		<span class="col-dt-6">
		            			<input id="pprice" placeholder="Price" style="width: 100%;" min="0" placeholder="0" type="number" name="pprice" />
		            		</span>
		            	</div>
	            		<textarea id="pshortdesc" placeholder="Short Description" class="simp_ec_textarea" type="text" name="pshortdesc"></textarea>
	            		<textarea id="pdesc" placeholder="Description" class="simp_ec_textarea" name="pdesc"></textarea>
	            		<textarea id="ptype" placeholder="Product Type" class="simp_ec_textarea" type="text" name="ptype" ></textarea>
	            		<textarea id="category" placeholder="Category" class="simp_ec_textarea" type="text" name="category" ></textarea>
	            		<input type="submit" value="Add Product" class="button button-primary simp_ec_btn_submit" />
	            	</span>
	            	<span class="col-dt-6">
	            		<h3>Name: </h3>
	            		<span class="simp_ec_add_single_product_name"></span>
	            		<div class="col-group">
	            			<span class="col-dt-6">
	            				<h3>SKU: </h3>
	            				<span class="simp_ec_add_single_product_sku"></span>
		            		</span>
		            		<span class="col-dt-6">
		            			<h3>Price: </h3>
		            			<span class="simp_ec_add_single_product_price"></span>
		            		</span>
	            		</div>
	            		<h3>Short Description: </h3>
	            		<span class="simp_ec_add_single_product_short_desc"></span>
	            		<h3>Description: </h3>
	            		<span class="simp_ec_add_single_product_desc"></span>
	            	</span>
	            </div>
			</form>
		</div>
    </div>
<?php

    global $wpdb;
	$table_product = $wpdb->prefix . "simp_ec_product";

	if(isset($_POST['pname']) || isset($_POST['sku']) || isset($_POST['pdesc']) || isset($_POST['pshortdesc']) || isset($_POST['pprice']))	{ 

		$pname = sanitize_text_field( $_POST['pname'] );
		$sku = sanitize_text_field( $_POST['sku'] );
		$pdesc = sanitize_text_field( $_POST['pdesc'] );
		$pshortdesc = sanitize_text_field( $_POST['pshortdesc'] );
		$pprice = sanitize_text_field( $_POST['pprice'] );
		$lastid = $wpdb->insert_id;
		$ptype = sanitize_text_field( $_POST['ptype'] );
		$category = sanitize_text_field( $_POST['category'] );

		$query = array('product_id' => $lastid,
					'product_sku' => $sku,
					'pname' => $pname, 
					'pdesc' => $pdesc,
					'pshortdesc' => $pshortdesc,
					'pprice' => $pprice);

		$wpdb->insert($table_product, $query, null);

	    add_action('admin_notices', 'simp_ec_custom_admin_notice_success');

        if (!empty($ptype))
   		{
   			$foreign_key_type = $wpdb->get_results( 'SELECT * FROM ' . $table_pt . ' WHERE ptype_name = "' . $ptype . '"');
	        if($foreign_key_type)
	        {
        		$foreign_key_product = $wpdb->get_results( 'SELECT * FROM ' . $table_product . ' WHERE pname = "' . $pname . '"');

        		$fk_pt_at_join = $wpdb->get_results( 'SELECT * FROM ' . $table_pt . ' JOIN ' . $table_pat . ' ON ' .  $table_pat .'.pattribute_id = ' . $table_pt . '.pattribute_id WHERE ptype_name = "' . $ptype . '"');

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
				'ptype_name' => $ptype,
				'ptype_desc' => '');
        		$wpdb->insert($table_pt, $query_type, null);
        		
        		$foreign_key_product = $wpdb->get_results( 'SELECT * FROM ' . $table_product . ' WHERE pname = "' . $pname . '"');
        		$foreign_key_ptype = $wpdb->get_results( 'SELECT * FROM ' . $table_pt . ' WHERE ptype_name = "' . $ptype . '"');

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

    	if (!empty($category))
   		{
   			$result_categories = $wpdb->get_results( 'SELECT * FROM ' . $table_pc . ' WHERE pcat_name = "' . $category . '"');
   			if($result_categories)
	        {
	        	
        		$foreign_key_produ = $wpdb->get_results( 'SELECT * FROM ' . $table_product . ' WHERE pname = "' . $pname . '"');

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
				'pcat_name' => $category,
				'pcat_slug' => $category);

		        $wpdb->insert($table_pc, $query_category, null);

		        $foreign_key_category = $wpdb->get_results( 'SELECT * FROM ' . $table_pc . ' WHERE pcat_name = "' . $category . '"');
        		$foreign_key_produ = $wpdb->get_results( 'SELECT * FROM ' . $table_product . ' WHERE pname = "' . $pname . '"');

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

	}
	
}


