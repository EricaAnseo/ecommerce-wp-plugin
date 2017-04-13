<?php 
/**
 * @since 		1.0.0
 * @package		Simplified_Ecommerce
**/
?>

<div class="simp_ec_list_view">
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
        		<textarea id="ptype" placeholder="Product Type" class="simp_ec_textarea" type="text" name="ptype[<?php echo $i ?>]" ></textarea>
        	</span>
        	<span class="col-dt-4">
        		<textarea id="category" placeholder="Category" class="simp_ec_textarea" type="text" name="category[<?php echo $i ?>]" ></textarea>
        	</span>
        	<span class="col-dt-4"></span>
        </div>
        <hr >
<?php } ?>
	<input type="submit" value="Add Products" class="button button-primary simp_ec_btn_submit" />
</div>
