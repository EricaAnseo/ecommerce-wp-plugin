<?php 
/**
 * @since 		1.0.0
 * @package		Simplified_Ecommerce
**/
?>

<div class="simp_ec_list_view">
    <div class="col-group simp_ec_list_group">
	<?php for ($i=0; $i< $rows; $i++){ ?>
       <span class="col-dt-6 simp_ec_list_col">
            <input id="pname" placeholder="Product Name" style="width: 100%; resize: none; " type="text" name="pname[<?php echo $i ?>]" />
            <div class="col-group">
                <span class="col-dt-6">
                    <input id="sku" placeholder="SKU" style="width: 100%;" type="text" name="sku[<?php echo $i ?>]"/>
                </span>
                <span class="col-dt-6">
                    <input id="pprice" placeholder="Price" style="width: 100%;" min="0" placeholder="0" type="number" name="pprice[<?php echo $i ?>]" />
                </span>
            </div>
            <textarea id="pshortdesc" placeholder="Short Description" class="simp_ec_textarea" type="text" name="pshortdesc[<?php echo $i ?>]"></textarea>
            <textarea id="pdesc" placeholder="Description" class="simp_ec_textarea" name="pdesc[<?php echo $i ?>]"></textarea>
            <textarea id="ptype" placeholder="Product Type" class="simp_ec_textarea" type="text" name="ptype[<?php echo $i ?>]" ></textarea>
            <textarea id="category" placeholder="Category" class="simp_ec_textarea" type="text" name="category[<?php echo $i ?>]" ></textarea>
        </span> 
<?php } ?>
    </div>
	<input type="submit" value="Add Products" class="button button-primary simp_ec_btn_submit" />
</div>
