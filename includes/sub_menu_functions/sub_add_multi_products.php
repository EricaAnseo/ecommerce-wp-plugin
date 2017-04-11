<?php 

function simp_ec_add_multi_products_table_html()
{
	include_once (SIMPLIFIED_ECOMMERCE_ROOT_PATH . 'includes/table_names.php');
	$rows = 7;
	$product = array();
	$table_view = admin_url('admin.php?page=add_multiple_product_table');
	$list_view = admin_url('adsimp_ec_containermin.php?page=add_multiple_product_list');
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
	        	<a href="" style=" padding-top: 4px;" class="page-title-action">Add Rows</a>	
	        </div>
	    </span>
        <hr class="wp-header-end">
	    <form action="#add_attribute" method="post" name="add_attribute">
			<table class="wp-list-table widefat fixed simp_ec_table_view">
				<thead>
					<tr>
		                <th>Name</th>
		                <th style="width:110px;">SKU</th>
		                <th style="width:75px;">Price (&euro;)</th>
		                <th>Short Description</th>
		                <th>Description</th>
		                <th>Product Type</th>
		                <th>Category</th>
	        		</tr>
	        	</thead>
	        	<tbody>
		<?php for ($i=0; $i< $rows; $i++){ ?>
			        <tr > 
			            <td>
			            	<textarea id="pname" class="simp_ec_textarea" type="text" name="pname[<?php echo $i ?>]" ></textarea>
			            </td>
			            <td>
			            	<input id="sku" style="width: 100%;" type="text" name="sku[<?php echo $i ?>]"/>
			            </td>  
			            <td>
			            	<input id="pprice" dir="rtl" style="width: 75px; text-align: right;" min="0" placeholder="0" type="number" name="pprice[<?php echo $i ?>]" />
			            </td>
			            <td>
			            	<textarea id="pshortdesc" style="width: 100%; height:70px;" type="text" name="pshortdesc[<?php echo $i ?>]"></textarea>			         
			            </td>
			            <td>
			            	<textarea id="pdesc" placeholder="" style="width: 100%; height:70px;" name="pdesc[<?php echo $i ?>]"></textarea>	            
			            </td>
			            <td>
			            	<textarea id="ptype" class="simp_ec_textarea" type="text" name="pname[<?php echo $i ?>]" ></textarea>
			            </td>
			            <td>
			            	<textarea id="category" class="simp_ec_textarea" type="text" name="pname[<?php echo $i ?>]" ></textarea>
			            </td>
			      
			        </tr>
		<?php } ?>
					<tr>
		                <th>Name</th>
		                <th>SKU</th>
		                <th>Price (&euro;)</th>
		                <th>Short Description</th>
		                <th>Description</th>
		                <th>Product Type</th>
		                <th>Category</th>    
	        		</tr>
				</tbody>
	        </table>
			<input type="submit" style="float:right; margin-top: 15px;" value="Add Products" class="button button-primary" />
		</form>
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