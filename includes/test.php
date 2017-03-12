<?php 

/** 
* test shortcode
function test_shortcode_function() {
  return 'Testing 1. 2. 3.';
}

add_shortcode('ericachai', 'test_shortcode_function');
*/


//https://codex.wordpress.org/Creating_Tables_with_Plugins

global $jal_db_version;
$jal_db_version = '1.0';
global $ec_prefix;
$ec_prefix = "test";


//Calls the functions when the plugin is activated. Located in this file
//register_activation_hook( __FILE__, 'erica_db_install' );
//register_activation_hook( __FILE__, 'erica_install_data' );

//Calls the function when the plugin is deactivated. 
//register_deactivation_hook( __FILE__, 'erica_on_deactivation' );

//Function called on uninstall
function erica_db_on_uninstall()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'test';
    $sql = "DROP TABLE IF EXISTS $table_name";
    $wpdb->query($sql);
    delete_option('erica_time_card_version');
}

//Calls the function when the plugin is deactivated. 
//register_uninstall_hook(__FILE__, 'erica_db_on_uninstall');

//add the option to the menu
//add_action('admin_menu', 'wporg_options_page');