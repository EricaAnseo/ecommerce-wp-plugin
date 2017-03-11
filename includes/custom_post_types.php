<?php 
function simp_ec_cpt_product()
{
	register_post_type('simp-ec-product', $products_args);

	$products_args = array(
	      	'labels' => array(
	           'name' => __( 'Products.' ),
	           'singular_name' => __( 'Product' ),
	           'add_new' => __( 'Add New Product' ),
	           'add_new_item' => __( 'Add New Product' ),
	           'edit_item' => __( 'Edit Product' ),
	           'new_item' => __( 'Add New Product' ),
	           'view_item' => __( 'View Product' ),
	           'search_items' => __( 'Search Products' ),
	           'not_found' => __( 'No Products found' ),
	           'not_found_in_trash' => __( 'No Products found in trash' )
	      	),
			'public' => true,
			'show_ui' => true,
			'exclude_from_search' => false,
			'capability_type' => 'post',
			'hierarchical' => false,
			'rewrite' => true,
			'menu_icon' => 'dashicons-universal-access',
			'slug' => 'simp-ec-products',
			'query_var' => true,
			'menu_position' => 20,
			'has_archive' => true,
			'show_in_menu' => true,
			'supports' => array(
				'title',
				'editor',
				'excerpt',
				'thumbnail',
				'page-attributes',
				'revisions'),
		);
}


 



?>