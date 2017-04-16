<?php 
ob_start();
if($results){ 
	foreach ( $results as $product ){ ?>
		<span class="simp_ec_product product<?php echo $product->product_id; ?>" style="display: block;">
			<?php if(!empty($product->pname)) { ?>
				<span class="simp_ec_product_name"><?php echo $product->pname; ?></span>
			<?php } if(!empty($product->product_sku)) { ?>
				<span class="simp_ec_product_sku"><?php echo $product->product_sku; ?></span>
			<?php } if(!empty($product->pdesc)) { ?>	
				<span class="simp_ec_product_desc"><?php echo $product->pdesc; ?></span>
			<?php } if(!empty($product->pshortdesc)) { ?>	
				<span class="simp_ec_product_short_desc"><?php echo $product->pshortdesc; ?></span>
			<?php } if(!empty($product->pprice)) { ?>	
				<span class="simp_ec_product_price"><?php echo $product->pprice; ?></span>
			<?php } ?>
		</span>
<?php } //foreach

}//if
return ob_get_clean();

?>