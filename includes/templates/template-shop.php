<?php
// Template Name: Shop Template
get_header(); 
$results = $wpdb->get_results( 'SELECT * FROM ' . $wpdb->prefix . "simp_ec_product");
?>

<div id="primary" class="site-content simp_ec_shop_template">
	<div id="main" role="main">
		<header class="entry-header">
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</header>
		<div class="entry-content">
			<?php while ( have_posts() ) : the_post();
		 	the_content(); 
		 	endwhile; ?>
		 	<div class="simp_ec_template_content">
			<?php if($results){ 
				foreach ( $results as $product ){ ?>
				<span class="simp_ec_product product<?php echo $product->product_id; ?>">
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
					<?php } ?>
				</span>
		 	<?php } //foreach

			}//if ?>
			</div>
		</div>
	</div><!-- #main -->
</div><!-- #primary -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>