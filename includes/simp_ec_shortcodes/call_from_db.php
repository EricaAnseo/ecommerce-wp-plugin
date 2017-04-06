<?php 

function call_from_db ($atts)
{
	$product_atts = shortcode_atts( array(
        'foo' => 'something',
        'bar' => 'something else',
    ), $atts );

	return 'The quick brown fox jumped over the lazy dog.';

	echo $product_atts['foo'];

	extract(shortcode_atts( array(
        'product' => 'all',
        'category' => 'none',
    ), $atts ));
}

add_shortcode('testing', 'call_from_db');

