<?php 

class Simp_Ec_Test
{
	function wporg_options_page_html()
	{
	    // check user capabilities
	    if (!current_user_can('manage_options')) {
	        return;
	    }
	    ?>
	    <div class="wrap">
	        <h1><?= esc_html(get_admin_page_title()); ?></h1>
	        <form action="options.php" method="post">
	            <?php
	            // output security fields for the registered setting "wporg_options"
	            add_settings_field(
			    'eg_setting_name',
			    'Example setting Name',
			   	array( $this,  'eg_setting_callback_function' ),
			    'reading',
			    'eg_setting_section');

	            //settings_fields('wporg_options');
	            // output setting sections and their fields
	            // (sections are registered for "wporg", each field is registered to a specific section)
	            //do_settings_sections('wporg');
	            // output save settings button
	            //submit_button('Save Settings');
	            ?>
	        </form>
	    </div>
	    <?php
	}

	function wporg_options_page()
	{

	    add_menu_page(
	        'Test', //Page Title
	        'test', //Menu Title
	        'manage_options', //User priviligies
	        plugin_dir_path(__FILE__) . 'admin/view.php', //where it will appears
	        //plugin_dir_url(__FILE__) . 'images/icon_wporg.png', //icon to appear on the menu
	        20 //position in the menu
	    );

	    /*add_submenu_page(
	        'tools.php',
	        'WPOrg Options',
	        'WPOrg Options',
	        'manage_options',
	        'wporg',
	        'wporg_options_page_html'
	    );*/
	}
	

}

/*function ericafyp_admin_actions() {
	
	add_menu_page( 'Test', 'Test', 'Test', 'Test');

}
 
add_action('admin_menu', 'ericafyp_admin_actions');
*/

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