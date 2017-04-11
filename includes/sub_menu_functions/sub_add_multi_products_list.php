<?php 

function simp_ec_add_multi_products_list_html()
{
	include_once (SIMPLIFIED_ECOMMERCE_ROOT_PATH . 'includes/table_names.php');
	$rows = 3;
	$product = array();
	$table_view = admin_url('admin.php?page=add_multiple_product_table');
	$list_view = admin_url('admin.php?page=add_multiple_product_list');
?>
    <div class="wrap simp_ec_container">
        <h1 class="wp-heading-inline"><?php echo get_admin_page_title(); ?></h1>
        <a href="" class="page-title-action">Add Products</a> 
        <span style="float:right;"> 
	        <div class="insert-product-display" style="display:inline-block; padding-top: 18px;">
	        	<a href="<?php echo $table_view; ?>" class="page-title-action">
	        		<span class="dashicons dashicons-editor-table"></span> Table
	        	</a>
	        	<a href="<?php echo $list_view; ?>" class="page-title-action">
	        		<span class="dashicons dashicons-editor-ul"></span> List
	        	</a>
	        </div>
	        <div class="add-rows" style="display:inline-block; padding-top: 8px; padding-left: 10px;">
	        	<input style="width:55px;" id="rows" type="number" name="number_of_rows" />
	        	<a href="" style=" padding-top: 4px" class="page-title-action">Add Rows</a>	
	        </div>
	    </span>
        <hr class="wp-header-end">
        <div class="simp_ec_list_view">
		    <form action="#add_attribute" method="post" name="add_attribute">
		    	<?php for ($i=0; $i< $rows; $i++){ ?>
					<div class="col-group">
		                <span class="col-dt-6">
		                	<input id="pname" placeholder="Product Name" style="width: 100%; resize: none; " type="text" name="pname[<?php echo $i ?>]" ></textarea>
		                </span>
		                <span class="col-dt-3">
		            		<input id="sku" placeholder="SKU" style="width: 100%;" type="text" name="sku[<?php echo $i ?>]"/>
		            	</span>
		            	<span class="col-dt-3">
		            		<input id="pprice" placeholder="Price" style="" min="0" placeholder="0" type="number" name="pprice[<?php echo $i ?>]" />
		            	</span>
		            </div>
		            <div class="col-group">
		            	<span class="col-dt-6">
		            		<textarea id="pshortdesc" placeholder="Short Description" style="width: 100%; height:70px;" type="text" name="pshortdesc[<?php echo $i ?>]"></textarea>
		            	</span>			         
		            	<span class="col-dt-6">
		            		<textarea id="pdesc" placeholder="Description" style="width: 100%; height:70px;" name="pdesc[<?php echo $i ?>]"></textarea>
		            	</span>	            
		            </div>
		            <div class="col-group">
		            	<span class="col-dt-4">
		            		<textarea id="ptype" placeholder="Product Type" class="simp_ec_textarea" type="text" name="pname[<?php echo $i ?>]" ></textarea>
		            	</span>
		            	<span class="col-dt-4">
		            		<textarea id="category" placeholder="Category" class="simp_ec_textarea" type="text" name="pname[<?php echo $i ?>]" ></textarea>
		            	</span>
		            	<span class="col-dt-4"></span>
		            </div>
		            <hr >
			<?php } ?>
				<input type="submit" value="Add Products" class="button button-primary simp_ec_btn_submit" />
			</form>
		</div>
    </div>

<?php 
		if((isset($_POST['pname'])) || (isset($_POST['sku'])) || (isset($_POST['pdesc'])) || (isset($_POST['pshortdesc'])) || (isset($_POST['pprice'])) ){

			$product_id = $wpdb->insert_id;
			$pname = sanitize_text_field( $_POST['pname']);
			$product_sku = sanitize_text_field( $_POST['sku']);
			$pdesc = sanitize_text_field( $_POST['pdesc']);
			$pshortdesc = sanitize_text_field( $_POST['pshortdesc']);
			$pprice = sanitize_text_field( $_POST['pprice']); 
			$count = 0;

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

}