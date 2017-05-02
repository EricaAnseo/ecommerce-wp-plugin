<?php
// Template Name: Shop Block Template
get_header(); 
$results = $wpdb->get_results( 'SELECT * FROM ' . $wpdb->prefix . 'simp_ec_product');

$results_product_variable = $wpdb->get_results( 'SELECT * FROM ' . $wpdb->prefix . 'simp_ec_product JOIN ' . $wpdb->prefix . 'simp_ec_product_variable ON ' . $wpdb->prefix . 'simp_ec_product_variable.product_id = ' . $wpdb->prefix . 'simp_ec_product.product_id JOIN ' . $wpdb->prefix . 'simp_ec_product_attribute ON ' . $wpdb->prefix . 'simp_ec_product_attribute.pattribute_id = ' . $wpdb->prefix . 'simp_ec_product_variable.pattribute_id');

$counter = 0;

?>

<div id="primary" class="content-area simp_ec_shop_template">
	<div id="main" class="site-main" role="main">
		<article class="page type-page hentry">
			<header class="entry-header">
				<h1 class="entry-title"><?php the_title(); ?></h1>
			</header>
			<div class="entry-content">
				<?php while ( have_posts() ) : the_post();
			 	the_content(); 
			 	endwhile; ?>
			 	<div class="simp_ec_template_content">
			 		<div class="col-group">
				<?php if($results){ 
					foreach ( $results as $product ){ 
						$counter++;
						?>

					<span class="simp_ec_product product<?php echo $product->product_id; ?> col-dt-4">
						<?php if(!empty($product->pname)) { ?>
							<span class="simp_ec_product_name">
								<h3><?php echo $product->pname; ?></h3>
							</span>
						<?php } if(!empty($product->product_sku)) { ?>
							<span class="simp_ec_product_sku">
								<span class="simp_ec_product_sku_heading">
									<strong>SKU: </strong>
								</span>
								<?php echo $product->product_sku; ?>
							</span>
						<?php } if(!empty($product->pprice)) { ?>	
							<span class="simp_ec_product_price">
								<span class="simp_ec_product_price_heading">
									<strong>Price: </strong>
								</span>
									<?php echo $product->pprice; ?>
							</span>
						<?php } if(!empty($product->pdesc)) { ?>	
							<span class="simp_ec_product_desc"><?php echo $product->pdesc; ?></span>
						<?php } if($results_product_variable){	
								
								foreach($results_product_variable as $variable_product)
								{	
									if(!empty($variable_product->vproduct_id)) {
									echo ' ';
										if($variable_product->product_id == $product->product_id)
										{
											
										 ?><span class="simp_ec_product_variation"> 
										 	<strong> Variation: </strong>
											<span class="simp_ec_product_variation<?php echo $variable_product->vproduct_id; ?>"><?php echo $variable_product->pattribute_name; ?> <strong>Stock:</strong> <?php echo $variable_product->vproduct_stock; ?></span>
										</span>
								<?php	}
									echo '';
									}
								}
								
							} ?>

					</span>

			 	<?php 
				 		if(($counter % 3) == 0){
							echo '</div> <div class="col-group">';
						}
			 		} //foreach

				}//if ?>
					</div> <!--#col-group-->
				</div>
			</div>
		</article>
	</div><!-- #main -->
</div><!-- #primary -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
