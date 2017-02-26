<?php 
function simp_ec_setup_post_types()
{
    // register the "book" custom post type
    register_post_type( 'book', ['public' => 'true'] );
}
add_action( 'init', 'simp_ec_setup_post_type' );
 
