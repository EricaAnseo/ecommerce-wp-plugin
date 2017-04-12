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
            	<textarea id="ptype" class="simp_ec_textarea" type="text" name="ptype[<?php echo $i ?>]" ></textarea>
            </td>
            <td>
            	<textarea id="category" class="simp_ec_textarea" type="text" name="category[<?php echo $i ?>]" ></textarea>
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




