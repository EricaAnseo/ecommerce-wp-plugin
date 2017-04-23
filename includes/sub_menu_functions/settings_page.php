<?php 
function simp_ec_settings_page_html()
{ 
	include_once (SIMPLIFIED_ECOMMERCE_ROOT_PATH . 'includes/table_names.php'); 
	$options = $wpdb->get_results( 'SELECT * FROM ' . $table_options);
	?>
	<div class="wrap simp_ec_container">
        <h1 class="wp-heading-inline"><?php echo get_admin_page_title(); ?></h1>
        <form method="post" id="settings" action="#settings">
        	<?php if($options){ 
        		foreach($options as $opt){?>
		        <div class="simp_ec_options_container">
		        		<h3>Business Name</h3>
		        		<input type="text" name="business_name" value="<?php echo $opt->company_name; ?>" />
		        		<h3>Business Address</h3>
		        		<input type="text" name="business_address" value="<?php echo $opt->company_address; ?>"/>
		        		<h3>Email Address</h3>
		        		<input type="email" name="email_address" value="<?php echo $opt->company_email; ?>"/>
		        		<h3>Currency</h3>
		        		<select name="currency">
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
		        </div><!--//simp_ec_options_container -->
	        <?php }
	        }
	        else
	        { ?>
	    		<div class="simp_ec_options_container">
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
		        </div><!--//simp_ec_options_container -->
	<?php   }
	        ?>
	        <input type="submit" name="btn_settings" value="Submit" id="settings" class="button button-primary simp_ec_btn_submit" />
	    </form>
    </div> <!--//wrap simp_ec_container -->
<?php 
	if($options){ 
		if(isset($_POST['btn_settings'])){
			$business_name = sanitize_text_field($_POST['business_name']);
			$business_address = sanitize_text_field($_POST['business_address']);
			$email_address = sanitize_email($_POST['email_address']);
			$currency = sanitize_text_field($_POST['currency']);
			$template = sanitize_text_field($_POST['template']);

			foreach($options as $settings)
			{
				if($business_name != $settings->company_name || $business_address != $settings->company_address || $email_address != $settings->company_email || $currency != $settings->default_currency || $template != $settings->shop_template)
				{
					$query = array('company_name' => $business_name, 
						'company_address' => $business_address,
						'company_email' => $email_address,
						'default_currency' => $currency,
						'shop_template' => $template);
					$where = array('company_id' => $settings->company_id);
					//Format for updating a table
					//Table Name, query, where condition, data type for query, data type for where
					$wpdb->update($table_options, $query, $where, null, null ); 
					echo "<meta http-equiv='refresh' content='0'>";

				}

			}
		}

	}

	else
	{
		if(isset($_POST['btn_settings'])){
			$lastid = $wpdb->insert_id;
			$business_name = sanitize_text_field($_POST['business_name']);
			$business_address = sanitize_text_field($_POST['business_address']);
			$email_address = sanitize_email($_POST['email_address']);
			$currency = sanitize_text_field($_POST['currency']);
			$template = sanitize_text_field($_POST['template']);

			$query = array('company_id' => $lastid,
						'company_name' => $business_name, 
						'company_address' => $business_address,
						'company_email' => $email_address,
						'default_currency' => $currency,
						'shop_template' => $template);

			$wpdb->insert($table_options, $query);

		}//if 
	
	}

}//end of function

