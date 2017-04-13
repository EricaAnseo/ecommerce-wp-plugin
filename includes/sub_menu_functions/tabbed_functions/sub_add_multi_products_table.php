<?php 
/**
 * @since 		1.0.0
 * @package		Simplified_Ecommerce
**/
?>

<table class="wp-list-table widefat fixed simp_ec_table_view">
	<thead>
		<tr>
                  <th>Name</th>
                  <th class="table_head_sku">SKU</th>
                  <th class="table_head_price">Price (&euro;)</th>
                  <th>Short Description</th>
                  <th>Description</th>
                  <th>Product Type</th>
                  <th>Category</th>
		</tr>
	</thead>
	<tbody>
<?php for ($i=0; $i< $rows; $i++){ ?>
            <tr class="simp_ec_row_insert">  
                  <td class="simp_ec_column_insert">
                       <textarea id="pname" class="simp_ec_textarea" type="text" name="pname[<?php echo $i ?>]" ></textarea>
                  </td>
                  <td class="simp_ec_column_insert">
                        <textarea id="product_sku" class="simp_ec_textarea" type="text" name="sku[<?php echo $i ?>]" ></textarea>
                  </td>  
                  <td class="simp_ec_column_insert">
                  	<input id="pprice" dir="rtl" style="text-align: right;" class="simp_ec_input_number" min="0" placeholder="0" type="number" name="pprice[<?php echo $i ?>]" />
                  </td>
                  <td class="simp_ec_column_insert">
                  	<textarea id="pshortdesc" class="simp_ec_textarea" type="text" name="pshortdesc[<?php echo $i ?>]"></textarea>			         
                  </td>
                  <td class="simp_ec_column_insert">
                  	<textarea id="pdesc" placeholder="" class="simp_ec_textarea" name="pdesc[<?php echo $i ?>]"></textarea>	            
                  </td>
                  <td class="simp_ec_column_insert"> 
                  	<textarea id="ptype" class="simp_ec_textarea" type="text" name="ptype[<?php echo $i ?>]" ></textarea>
                  </td>
                  <td class="simp_ec_column_insert">
                  	<textarea id="category" class="simp_ec_textarea" type="text" name="category[<?php echo $i ?>]" ></textarea>
                  </td>
            </tr>
<?php } ?>
		<tr>
                  <th>Name</th>
                  <th class="table_head_sku">SKU</th>
                  <th class="table_head_price">Price (&euro;)</th>
                  <th>Short Description</th>
                  <th>Description</th>
                  <th>Product Type</th>
                  <th>Category</th>    
		</tr>
	</tbody>
</table>
<input type="submit" style="" value="Add Products" class="button button-primary simp_ec_btn_submit" />




