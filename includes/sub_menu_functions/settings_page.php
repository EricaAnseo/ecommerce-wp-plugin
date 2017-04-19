<?php 
function simp_ec_settings_page_html()
{ 
	include_once (SIMPLIFIED_ECOMMERCE_ROOT_PATH . 'includes/table_names.php'); 
	$options = $wpdb->get_results( 'SELECT * FROM ' . $table_options);
	?>
	<div class="wrap simp_ec_container">
        <h1 class="wp-heading-inline"><?php echo get_admin_page_title(); ?></h1>
        <form method="post" id="settings" action="#settings">
        	<?php //if($options){ 
        		//foreach($options as $opt){?>
		        <div class="col-group">
		        	<div class="col-12">
		        		<h3>Business Name</h3>
		        		<input type="text" name="business_name" value="" />
		        		<h3>Business Address</h3>
		        		<input type="text" name="business_address" value=""/>
		        		<h3>Email Address</h3>
		        		<input type="text" name="email_address" value=""/>
		        		<h3>Currency</h3>
		        		<select name="currency">
		        			<option value="none">None</option>
							<option value="euro">Euro (&#128;)</option>
							<option value="dollar">Dollar (&#x24;)</option>
							<option value="pound">Sterling (&#xa3;)</option>
							<option value="yen">Yen (&#xa5;)</option>
						</select>
		        		<h3>Template</h3>
		    			<select name="template">
		        			<option value="default">Default</option>
		        			<option value="list">List View</option>
						</select>
		        	</div>
		        </div><!--//col-group -->
	        <?php //}
	        //} ?>
	        <input type="submit" name="btn_settings" value="Submit" id="settings" class="button button-primary simp_ec_btn_submit" />
	    </form>
    </div> <!--//wrap simp_ec_container -->
<?php 
	if(isset($_POST['btn_settings']))
	{
		$business_name = sanitize_text_field($_POST['business_name']);
		$business_address = sanitize_text_field($_POST['business_address']);
		$email_address = sanitize_text_field($_POST['email_address']);
		$currency = sanitize_text_field($_POST['currency']);
		$template = sanitize_text_field($_POST['template']);



	}//if 


}//end of function

