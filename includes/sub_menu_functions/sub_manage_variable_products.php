<?php 
/**
 * @since 		1.0.0
 * @package		Simplified_Ecommerce
**/

function simp_ec_add_variable_products_html()
{ 
	$active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'display_options';
?>
	<!-- Create a header in the default WordPress 'wrap' container -->
    <div class="wrap">
     
        <div id="icon-themes" class="icon32"></div>
        <h2>Sandbox Theme Options</h2>
        <?php settings_errors(); 
        	if( isset( $_GET[ 'tab' ] ) ) {
			    $active_tab = $_GET[ 'tab' ];
			} // end if
        ?>
         
        <h2 class="nav-tab-wrapper">
    <a href="?page=add_variable_product_sub&tab=display_options" class="nav-tab <?php echo $active_tab == 'display_options' ? 'nav-tab-active' : ''; ?>">Display Options</a>
    <a href="?page=add_variable_product_sub&tab=social_options" class="nav-tab <?php echo $active_tab == 'social_options' ? 'nav-tab-active' : ''; ?>">Social Options</a>
</h2>
         
        <form method="post" action="options.php">
		    <?php
		         
		        if( $active_tab == 'display_options' ) {
		        	echo 'Hello there';
		            settings_fields( 'sandbox_theme_display_options' );
		            do_settings_sections( 'sandbox_theme_display_options' );
		        } else {
		            settings_fields( 'sandbox_theme_social_options' );
		            do_settings_sections( 'sandbox_theme_social_options' );
		        } // end if/else
		         
		        submit_button();
		         
		    ?>
		</form>
         
    </div><!-- /.wrap -->
<?php }

