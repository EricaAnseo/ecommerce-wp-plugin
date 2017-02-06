<?php 

function call_from_db ()
{
	return 'The quick brown fox jumped over the lazy dog.';
}

add_shortcode('testing', 'call_from_db');

