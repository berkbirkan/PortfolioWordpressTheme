<?php




add_action( 'admin_footer', 'media_selector_print_scripts' );

function media_selector_print_scripts() {

	$my_saved_attachment_post_id = get_option( 'media_selector_attachment_id', 0 );

	?><script type='text/javascript'>

		jQuery( document ).ready( function( $ ) {

			// Uploading files
			var file_frame;
			var wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
			var set_to_post_id = <?php echo $my_saved_attachment_post_id; ?>; // Set this

			jQuery('#upload_image_button').on('click', function( event ){

				event.preventDefault();

				// If the media frame already exists, reopen it.
				if ( file_frame ) {
					// Set the post ID to what we want
					file_frame.uploader.uploader.param( 'post_id', set_to_post_id );
					// Open frame
					file_frame.open();
					return;
				} else {
					// Set the wp.media post id so the uploader grabs the ID we want when initialised
					wp.media.model.settings.post.id = set_to_post_id;
				}

				// Create the media frame.
				file_frame = wp.media.frames.file_frame = wp.media({
					title: 'Select a image to upload',
					button: {
						text: 'Use this image',
					},
					multiple: false	// Set to true to allow multiple files to be selected
				});

				// When an image is selected, run a callback.
				file_frame.on( 'select', function() {
					// We set multiple to false so only get one image from the uploader
					attachment = file_frame.state().get('selection').first().toJSON();

					// Do something with attachment.id and/or attachment.url here
					$( '#image-preview' ).attr( 'src', attachment.url ).css( 'width', 'auto' );
					$( '#projects_image' ).val( attachment.id );

					// Restore the main post ID
					wp.media.model.settings.post.id = wp_media_post_id;
				});

					// Finally, open the modal
					file_frame.open();
			});

			// Restore the main ID when the add media button is pressed
			jQuery( 'a.add_media' ).on( 'click', function() {
				wp.media.model.settings.post.id = wp_media_post_id;
			});
		});

	</script><?php

}
function portfolio_admin_myprojects_page_handler()
{
    global $wpdb;

    $table = new Portfolio_MyProjects_List_Table();
    $table->prepare_items();

    $message = '';
    if ('delete' === $table->current_action()) {
        $message = '<div class="updated below-h2" id="message"><p>' . sprintf(__('Items deleted: %d', 'portfolio-admin-myresume'), count($_REQUEST['ID'])) . '</p></div>';
    }
    ?>
<div class="wrap">

    <div class="icon32 icon32-posts-post" id="icon-edit"><br></div>
    <h2><?php _e('My Projects', 'portfolio-admin-myresume')?> <a class="add-new-h2"
                                 href="<?php echo get_admin_url(get_current_blog_id(), 'admin.php?page=myprojects_form');?>"><?php _e('Add new', 'portfolio-admin-myresume')?></a>
    </h2>
    <?php echo $message; ?>

    <form id="myprojects-table" method="POST">
        <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>"/>
        <?php $table->display() ?>
    </form>

</div>
<?php
}


function portfolio_admin_projects_form_page_handler()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'portfolio_myprojects';

    $message = '';
    $notice = '';


    $default = array(
        'ID' => 0,
        'projects_name'      => '',
        'projects_category'  => '',
        'projects_link'  => '',
        'projects_image'  => '',
        'order'  => '',
        
        
    );


    if ( isset($_REQUEST['nonce']) && wp_verify_nonce($_REQUEST['nonce'], basename(__FILE__))) {
        
        $item = shortcode_atts($default, $_REQUEST);     

        $item_valid = portfolio_admin_validate_myprojects($item);
        if ($item_valid === true) {
            if ($item['ID'] == 0) {
                $result = $wpdb->insert($table_name, $item);
                $item['ID'] = $wpdb->insert_id;
                if ($result) {
                    $message = __('Item was successfully saved', 'portfolio-admin-myresume');
                } else {
                    $notice = __('There was an error while saving item', 'portfolio-admin-myresume');
                }
            } else {
                $result = $wpdb->update($table_name, $item, array('ID' => $item['ID']));
                if ($result) {
                    $message = __('Item was successfully updated', 'portfolio-admin-myresume');
                } else {
                    $notice = __('There was an error while updating item', 'portfolio-admin-myresume');
                }
            }
        } else {
            
            $notice = $item_valid;
        }
    }
    else {
        
        $item = $default;
        if (isset($_REQUEST['ID'])) {
            $item = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE ID = %d", $_REQUEST['ID']), ARRAY_A);
            if (!$item) {
                $item = $default;
                $notice = __('Item not found', 'portfolio-admin-myresume');
            }
        }
    }

    
    add_meta_box('myprojects_form_meta_box', __('Work Details', 'portfolio-admin-myresume'), 'portfolio_admin_projects_form_meta_box_handler', 'myprojects', 'normal', 'default');

    ?>
<div class="wrap">
    <div class="icon32 icon32-posts-post" id="icon-edit"><br></div>
    <h2><?php _e('My Projects', 'portfolio-admin-myresume')?> <a class="add-new-h2"
                                href="<?php echo get_admin_url(get_current_blog_id(), 'admin.php?page=myprojects');?>"><?php _e('back to list', 'portfolio-admin-myresume')?></a>
    </h2>

    <?php if (!empty($notice)): ?>
    <div id="notice" class="error"><p><?php echo $notice ?></p></div>
    <?php endif;?>
    <?php if (!empty($message)): ?>
    <div id="message" class="updated"><p><?php echo $message ?></p></div>
    <?php endif;?>

    <form id="form" method="POST">
        <input type="hidden" name="nonce" value="<?php echo wp_create_nonce(basename(__FILE__))?>"/>
        
        <input type="hidden" name="ID" value="<?php echo $item['ID'] ?>"/>

        <div class="metabox-holder" id="poststuff">
            <div id="post-body">
                <div id="post-body-content">
                    
                    <?php do_meta_boxes('myprojects', 'normal', $item); ?>
                    <input type="submit" value="<?php _e('Save', 'portfolio-admin-myresume')?>" id="submit" class="button-primary" name="submit">
                </div>
            </div>
        </div>
    </form>
</div>
<?php
}

function portfolio_admin_projects_form_meta_box_handler($item)
{

    //Save attachment ID
	if ( isset( $_POST['submit_image_selector'] ) && isset( $_POST['projects_image'] ) ) :
		update_option( 'media_selector_attachment_id', absint( $_POST['projects_image'] ) );
	endif;
    


    wp_enqueue_media();


    ?>
    <tbody >
            
        <div class="formdatabc">		
            
        <form>
        
            <div class="form2bc">
            <p>			
                <label for="projects_name"><?php _e('Project Name:', 'portfolio-admin-myresume')?></label>
            <br>	
                <input id="projects_name" name="projects_name" type="text" value="<?php echo esc_attr($item['projects_name'])?>"
                        required>
            </p>
            </div>	
            <div class="form2bc">
                <p>
                <label for="projects_category"><?php _e('Project Category', 'portfolio-admin-myresume')?></label> 
            <br>	
                <input id="projects_category" name="projects_category" type="text" value="<?php echo esc_attr($item['projects_category'])?>"
                       required>
            </p>
            </div>
            
            <div class="form3bc">
                    
            </div>	
            <div>		
                <p>
                <label for="projects_link"><?php _e('Project Link:', 'portfolio-admin-myresume')?></label> 
            <br>
                <textarea id="projects_link" name="projects_link" cols="100" rows="3" maxlength="240"><?php echo esc_attr($item['projects_link'])?></textarea>
            </p>
            </div>	

            <div class='image-preview-wrapper'>
		<img id='image-preview' src='<?php echo wp_get_attachment_image_src(esc_attr($item['projects_image']),"full")[0] ?>' width='100' height='100' style='max-height: 100px; width: 100px;'>
	</div>
	<input id="upload_image_button" type="button" class="button" value="<?php _e( 'Upload image' ); ?>" /> 
	<input type='hidden' name='projects_image' id='projects_image' value='<?php echo esc_attr($item['projects_image'])?>'>
            </form>
            </div>
    </tbody>
    
    <?php
    }
    