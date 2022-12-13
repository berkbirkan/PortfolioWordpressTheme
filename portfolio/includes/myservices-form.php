<?php
function portfolio_admin_myservices_page_handler()
{
    global $wpdb;

    $table = new Portfolio_MyServices_List_Table();
    $table->prepare_items();

    $message = '';
    if ('delete' === $table->current_action()) {
        $message = '<div class="updated below-h2" id="message"><p>' . sprintf(__('Items deleted: %d', 'portfolio-admin-myresume'), count($_REQUEST['ID'])) . '</p></div>';
    }
    ?>
<div class="wrap">

    <div class="icon32 icon32-posts-post" id="icon-edit"><br></div>
    <h2><?php _e('My Services', 'portfolio-admin-myresume')?> <a class="add-new-h2"
                                 href="<?php echo get_admin_url(get_current_blog_id(), 'admin.php?page=myservices_form');?>"><?php _e('Add new', 'portfolio-admin-myresume')?></a>
    </h2>
    <?php echo $message; ?>

    <form id="myservices-table" method="POST">
        <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>"/>
        <?php $table->display() ?>
    </form>

</div>
<?php
}


function portfolio_admin_services_form_page_handler()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'portfolio_myservices'; 

    $message = '';
    $notice = '';


    $default = array(
        'ID' => 0,
        'services_name'      => '',
        'services_icon'  => '',
        'services_details'     => '',
        
    );


    if ( isset($_REQUEST['nonce']) && wp_verify_nonce($_REQUEST['nonce'], basename(__FILE__))) {
        
        $item = shortcode_atts($default, $_REQUEST);     

        $item_valid = portfolio_admin_validate_myservices($item);
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

    
    add_meta_box('myservices_form_meta_box', __('Work Details', 'portfolio-admin-myresume'), 'portfolio_admin_services_form_meta_box_handler', 'myservices', 'normal', 'default');

    ?>
<div class="wrap">
    <div class="icon32 icon32-posts-post" id="icon-edit"><br></div>
    <h2><?php _e('My Services', 'portfolio-admin-myresume')?> <a class="add-new-h2"
                                href="<?php echo get_admin_url(get_current_blog_id(), 'admin.php?page=myservices');?>"><?php _e('back to list', 'portfolio-admin-myresume')?></a>
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
                    
                    <?php do_meta_boxes('myservices', 'normal', $item); ?>
                    <input type="submit" value="<?php _e('Save', 'portfolio-admin-myresume')?>" id="submit" class="button-primary" name="submit">
                </div>
            </div>
        </div>
    </form>
</div>
<?php
}

function portfolio_admin_services_form_meta_box_handler($item)
{
    ?>
    <tbody >
            
        <div class="formdatabc">		
            
        <form >
            <div class="form2bc">
            <p>			
                <label for="services_name"><?php _e('Services Name:', 'portfolio-admin-myresume')?></label>
            <br>	
                <input id="services_name" name="services_name" type="text" value="<?php echo esc_attr($item['services_name'])?>"
                        required>
            </p>
            </div>	
            <div class="form2bc">
                <p>
                <label for="services_icon"><?php _e('Services İcon', 'portfolio-admin-myresume')?></label> 
            <br>	
                <input id="services_icon" name="services_icon" type="text" value="<?php echo esc_attr($item['services_icon'])?>"
                       required>
            </p>
            </div>
            
            <div class="form3bc">
                    
            </div>	
            <div>		
                <p>
                <label for="services_details"><?php _e('Service Details:', 'portfolio-admin-myresume')?></label> 
            <br>
                <textarea id="education_details" name="services_details" cols="100" rows="3" maxlength="240"><?php echo esc_attr($item['services_details'])?></textarea>
            </p>
            </div>	
            </form>
            </div>
    </tbody>
    <?php
    }
    