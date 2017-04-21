<?php 

function simp_ec_manage_images_page_html()
{
	include_once (SIMPLIFIED_ECOMMERCE_ROOT_PATH . 'includes/table_names.php'); 
	test_handle_post();
	?>

	<div class="wrap simp_ec_container">
    	<h1 class="wp-heading-inline"><?php echo get_admin_page_title(); ?></h1>
        <h2>Upload a File</h2>
        <!-- Form to handle the upload - The enctype value here is very important -->
        <form  method="post" enctype="multipart/form-data">
                <input type='file' id='test_upload_pdf' name='test_upload_pdf'></input>
                <?php submit_button('Upload') ?>
        </form>

    </div><!--//wrap //simp_ec_container -->

<?php 
}

function test_handle_post(){
    // First check if the file appears on the _FILES array
    if(isset($_FILES['test_upload_pdf'])){
        $pdf = $_FILES['test_upload_pdf'];

        // Use the wordpress function to upload
        // test_upload_pdf corresponds to the position in the $_FILES array
        // 0 means the content is not associated with any other posts
        $uploaded=media_handle_upload('test_upload_pdf', 0);
        // Error checking using WP functions
        if(is_wp_error($uploaded)){
                echo "Error uploading file: " . $uploaded->get_error_message();
        }else{
                echo "File upload successful!";
        }
    }
}
 
?>