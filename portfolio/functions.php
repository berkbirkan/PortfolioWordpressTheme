<?php 


defined( 'ABSPATH' ) or die( '¡Sin trampas!' );

add_action("admin_menu","portfolio_setAdminMenu");

$gelen_veri = unserialize(get_option("header_settings"));

// Loading WP_List_Table class file
// We need to load it as it's not automatically loaded by WordPress
if (!class_exists('WP_List_Table')) {
    require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
}
require plugin_dir_path( __FILE__ ) . 'includes/myresume-work-form.php';
require plugin_dir_path( __FILE__ ) . 'includes/myresume-education-form.php';
require plugin_dir_path( __FILE__ ) . 'includes/myservices-form.php';
require plugin_dir_path( __FILE__ ) . 'includes/myskills-form.php';
require plugin_dir_path( __FILE__ ) . 'includes/myportfolio-form.php';

function theme_db_installer(){
  
// Create a new Educations table in the database
global $wpdb;
$table_name = $wpdb->prefix . "portfolio_myeducations";
$my_products_db_version = '1.0';
$charset_collate = $wpdb->get_charset_collate();

if ( $wpdb->get_var("SHOW TABLES LIKE '{$table_name}'") != $table_name ) {

    $sql = "CREATE TABLE $table_name (
            `ID` bigint(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `college_name` text NOT NULL,
            `education_type` text NOT NULL,
            `education_years` text NOT NULL,
            `education_details` longtext NOT NULL,
            `order` int(11) NOT NULL
    ) $charset_collate;";

    $sql_insert = "INSERT INTO $table_name (`ID`, `college_name`, `education_type`, `education_years`, `education_details`, `order`) VALUES
    (45, 'Sağlık İşçileri Sendikası Primary School', 'Primary School', '2002-2010', 'Primary school', 0),
    (46, 'Türk Telekom High School', 'High School', '2010-2014', 'I graduated from high school.', 0),
    (47, 'Antalya Bilim University', 'Computer Science Degree', '2014-2021', 'I graduated from Computer Science department of Antalya Bilim University.', 0);";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
    dbDelta($sql_insert);
    add_option('my_db_version', $my_products_db_version);
}

global $wpdb;
$myworks_table_name = $wpdb->prefix . "portfolio_myworks";
$my_products_db_version = '1.0';
$charset_collate = $wpdb->get_charset_collate();

if ( $wpdb->get_var("SHOW TABLES LIKE '{$myworks_table_name}'") != $myworks_table_name ) {
  

    $sql_works = "CREATE TABLE $myworks_table_name (
            `ID` bigint(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `company_name` text NOT NULL,
            `company_department` text NOT NULL,
            `working_years` text NOT NULL,
            `working_details` longtext NOT NULL,
            `order` int(11) NOT NULL
    ) $charset_collate;";

    $sql_insert_works = "INSERT INTO $myworks_table_name (`ID`, `company_name`, `company_department`, `working_years`, `working_details`, `order`) VALUES
    (67, 'Freelancer', 'Webmaster', '2004-2014', 'I worked as Freelancer webmaster / full stack web developer between 2004 and 2014. I developed lots of project with HTML,CSS,JS and PHP languages.', 0),
    (68, 'Freelancer', 'Junior Android Developer', '2013-2015', 'I worked as Freelancer Android Developer between 2013 and 2015. I developed freelance native android apps with Java language.', 0),
    (69, 'BirkanLabs', 'Junior iOS Developer', '2015-2017', 'I started to working as Junior iOS Developer in BirkanLabs which is my own Software company.  I make iOS apps and publish in App Store. I also develop iOS apps for marketplace such as Codecanyon or Codester.', 0),
    (70, 'BirkanLabs', 'Mid iOS Developer', '2017-2019', 'I develop lots of apps and make a progress about iOS development. I learned more about architech of iOS apps. ', 0),
    (71, 'BirkanLabs', 'Senior iOS Developer', '2019-present', 'I became senior after 5 years of iOS development. ', 0);";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql_works);
    dbDelta($sql_insert_works);
   // add_option('my_db_version', $my_products_db_version);


}

global $wpdb;
$myservices_table_name = $wpdb->prefix . "portfolio_myservices";
$my_products_db_version = '1.0';
$charset_collate = $wpdb->get_charset_collate();


if ( $wpdb->get_var("SHOW TABLES LIKE '{$myservices_table_name}'") != $myservices_table_name ) {

   

    $sql_services = "CREATE TABLE $myservices_table_name (
            `ID` bigint(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `services_name` text NOT NULL,
            `services_icon` text NOT NULL,
            `services_details` longtext NOT NULL,
            `order` int(11) NOT NULL
    ) $charset_collate;";

    $sql_insert_services = "INSERT INTO `wp_portfolio_myservices` (`ID`, `services_name`, `services_icon`, `services_details`, `order`) VALUES
    (6, 'Web Designer', 'icon-chat', 'I designed lots of Wordpress themes. ', 0),
    (7, 'Branding', 'icon-briefcase', 'Facilis ipsum reprehenderit nemo molestias. Aut cum mollitia reprehenderit', 0),
    (8, 'Analytics', 'icon-search', 'Facilis ipsum reprehenderit nemo molestias. Aut cum mollitia reprehenderit.', 0),
    (9, 'Web Developent', 'icon-bargraph', 'I developed many Wordpress plugins.', 0),
    (10, 'Web Marketing', 'icon-genius', 'Facilis ipsum reprehenderit nemo molestias. Aut cum mollitia reprehenderit.', 0),
    (11, 'Support', 'icon-chat', 'Facilis ipsum reprehenderit nemo molestias. Aut cum mollitia reprehenderit.', 0);";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    dbDelta($sql_services);
    dbDelta($sql_insert_services);
    //add_option('my_db_version', $my_products_db_version);




}



global $wpdb;
$myskills_table_name = $wpdb->prefix . "portfolio_myskills";
$my_products_db_version = '1.0';
$charset_collate = $wpdb->get_charset_collate();


if ( $wpdb->get_var("SHOW TABLES LIKE '{$myskills_table_name}'") != $myskills_table_name ) {
    
        $sql_skills = "CREATE TABLE $myskills_table_name (
                `ID` bigint(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                `skills_name` text NOT NULL,
                `skills_percent` int(11) NOT NULL,
                `skills_color` text NOT NULL,
                `order` int(11) NOT NULL
        ) $charset_collate;";
    
        $sql_insert_skills = "INSERT INTO `wp_portfolio_myskills` (`ID`, `skills_name`, `skills_percent`, `skills_color`, `order`) VALUES
        (5, 'Java', 75, 'asd', 0),
        (8, 'Python', 60, 'asdas', 0),
        (10, 'Swift Development', 99, 'asa', 0),
        (11, 'Android Development', 99, 'ss', 0);";
    
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    
        dbDelta($sql_skills);
        dbDelta($sql_insert_skills);
        //add_option('my_db_version', $my_products_db_version);
    
}


global $wpdb;
$myprojects_table_name = $wpdb->prefix . "portfolio_myprojects";
$my_products_db_version = '1.0';
$charset_collate = $wpdb->get_charset_collate();

if ( $wpdb->get_var("SHOW TABLES LIKE '{$myprojects_table_name}'") != $myprojects_table_name ) {

   

    $sql_projects = "CREATE TABLE $myprojects_table_name (
            `ID` bigint(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `projects_name` text NOT NULL,
            `projects_category` text NOT NULL,
            `projects_link` text NOT NULL,
            `projects_image` text NOT NULL,
            `order` int(11) NOT NULL
    ) $charset_collate;";

    $sql_insert_projects = "INSERT INTO `wp_portfolio_myprojects` (`ID`, `projects_name`, `projects_category`, `projects_link`, `projects_image`, `order`) VALUES
    (30, 'Project Name', 'Category', 'https://themeforest.net/', '24', 0),
    (31, 'Project Name', 'Project Category', 'https://themeforest.net/', '23', 0),
    (32, 'Project Name', 'Project Category', 'https://themeforest.net', '27', 0),
    (33, 'Project Name', 'Project Category', 'https://themeforest.net', '28', 0),
    (34, 'Project Name', 'Project Category', 'https://themeforest.net', '29', 0),
    (35, 'Project Name', 'Project Category', 'https://themeforest.net', '30', 0),
    (36, 'Project Name', 'Project Category', 'https://themeforest.net', '31', 0),
    (37, 'Project Name', 'Project Category', 'https://themeforest.net', '32', 0);";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    
    dbDelta($sql_projects);
    dbDelta($sql_insert_projects);
    //add_option('my_db_version', $my_products_db_version);



}



}

// Registering the plugin

//register_activation_hook(__FILE__, 'theme_db_installer');

theme_db_installer();





// Extending class

// My Projects List Table

class Portfolio_MyProjects_List_Table extends WP_List_Table
{
    // Here we will add our code

    // Define table columns
    function get_columns()
    {
        $columns = array(
                'cb'            => '<input type="checkbox" />',
                'projects_name'          => __('Project Name', 'portfolio-admin-resume'),
                'projects_category'   => __('Project Category', 'portfolio-admin-resume'),
                'projects_link'   => __('Project Link', 'portfolio-admin-resume'),
                'projects_image'   => __('Project Image', 'portfolio-admin-resume'),
                'order'        => __('Order', 'portfolio-admin-resume')
        );
        return $columns;
    }
     // define $table_data property
     private $table_data;

     // Bind table with columns, data and all
    function prepare_items()
    {

      global $wpdb;
      $table_name = $wpdb->prefix . 'portfolio_myprojects'; 
        //data
        if ( isset($_POST['s']) ) {
            $this->table_data = $this->get_table_data($_POST['s']);
        } else {
            $this->table_data = $this->get_table_data();
        }

       


        $columns = $this->get_columns();
        $hidden = ( is_array(get_user_meta( get_current_user_id(), 'managetoplevel_page_myprojects_list_tablecolumnshidden', true)) ) ? get_user_meta( get_current_user_id(), 'managetoplevel_page_myprojects_list_tablecolumnshidden', true) : array();
        $sortable = $this->get_sortable_columns();
        $primary  = 'name';
        $this->_column_headers = array($columns, $hidden, $sortable, $primary);
        $this->process_bulk_action();
        usort($this->table_data, array(&$this, 'usort_reorder'));
        
       

        /* pagination */
        $per_page = $this->get_items_per_page('elements_per_page', 10);
        $current_page = $this->get_pagenum();
        $total_items = count($this->table_data);
        
        $this->table_data = array_slice($this->table_data, (($current_page - 1) * $per_page), $per_page);

        $paged = isset($_REQUEST['paged']) ? max(0, intval($_REQUEST['paged']) - 1) : 0;
        $orderby = (isset($_REQUEST['orderby']) && in_array($_REQUEST['orderby'], array_keys($this->get_sortable_columns()))) ? $_REQUEST['orderby'] : 'ID';
        $order = (isset($_REQUEST['order']) && in_array($_REQUEST['order'], array('asc', 'desc'))) ? $_REQUEST['order'] : 'asc';


        $this->items = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name ORDER BY $orderby $order LIMIT %d OFFSET %d", $per_page, $paged), ARRAY_A);


        
        $this->set_pagination_args(array(
            'total_items' => $total_items, // total number of items
            'per_page'    => $per_page, // items to show on a page
            'total_pages' => ceil( $total_items / $per_page ) // use ceil to round up
         ));

         

        $this->items = $this->table_data;
       
    }

     // Get table data
    private function get_table_data($search = '') {
        global $wpdb;

        $table = $wpdb->prefix . 'portfolio_myprojects';

        if ( !empty($search) ) {
            return $wpdb->get_results(
                "SELECT * from {$table} WHERE projects_name Like '%{$search}%'  OR projects_category Like '%{$search}%' OR projects_link Like '%{$search}%' OR projects_image Like '%{$search}%' ",
                ARRAY_A
            );
        } else {
            return $wpdb->get_results(
                "SELECT * from {$table}",
                ARRAY_A
            );
        }

        /*
        return $wpdb->get_results(
            "SELECT * from {$table}",
            ARRAY_A
        );
        */
        
    }

    function column_default($item, $column_name)
    {
          switch ($column_name) {
                case 'ID':
                case 'projects_name':
                case 'projects_category':
                case 'projects_link':
                case 'projects_image':
                case 'order':
                default:
                    return $item[$column_name];
          }
    }

    

    function column_cb($item)
    {
        return sprintf(
                '<input type="checkbox" name="ID[]" value="%s" />',
                $item['ID']
        );
    }

    protected function get_sortable_columns()
{
      $sortable_columns = array(
           
            'order'   => array('order', true)
      );
      return $sortable_columns;
}

  // Sorting function
  function usort_reorder($a, $b)
  {
      // If no sort, default to user_login
      $orderby = (!empty($_GET['orderby'])) ? $_GET['orderby'] : 'user_login';

      // If no order, default to asc
      $order = (!empty($_GET['order'])) ? $_GET['order'] : 'asc';

      // Determine sort order
      $result = strcmp($a[$orderby], $b[$orderby]);

      // Send final sort direction to usort
      return ($order === 'asc') ? $result : -$result;
  }
/*
  function column_name($item)
    {

        $actions = array(
            'edit' => sprintf('<a href="?page=contacts_form&id=%s">%s</a>', $item['id'], __('Edit', 'portfolio_admin')),
            'delete' => sprintf('<a href="?page=%s&action=delete&id=%s">%s</a>', $_REQUEST['page'], $item['id'], __('Delete', 'portfolio_admin')),
        );

        return sprintf('%s %s',
            $item['name'],
            $this->row_actions($actions)
        );
    }
    */


    function column_projects_name($item)
    {
  
      /*
        $actions = array(
                'edit'      => sprintf('<a href="?page=%s&action=%s&element=%s">' . __('Edit', 'portfolio-admin-myresume') . '</a>', $_REQUEST['page'], 'edit', $item['ID']),
                'delete'    => sprintf('<a href="?page=%s&action=%s&element=%s">' . __('Delete', 'portfolio-admin-myresume') . '</a>', $_REQUEST['page'], 'delete', $item['ID']),
        );
  
        return sprintf('%1$s %2$s', $item['company_name'], $this->row_actions($actions));
  
        */
  
  
        $actions = array(
          'edit' => sprintf('<a href="?page=myprojects_form&ID=%s">%s</a>', $item['ID'], __('Edit', 'portfolio-admin-myresume')),
          'delete' => sprintf('<a href="?page=%s&action=delete_all&ID=%s">%s</a>', $_REQUEST['page'], $item['ID'], __('Delete', 'portfolio-admin-myresume')),
      );
  
      return sprintf('%s %s',
          $item['projects_name'],
          $this->row_actions($actions)
      );
   } 

  
   // To show bulk action dropdown
   function get_bulk_actions(){
   
    $actions = array(
        'delete_all'    => __('Delete'),
        //'draft_all' => __('Move to Draft')
    );

    return $actions;
   }

   


   function process_bulk_action()
    {
        echo 'deneme1';
        global $wpdb;

        $table = $wpdb->prefix . 'portfolio_myprojects';


        if ('delete_all' === $this->current_action()) {
            echo 'deneme3';
            $ids = isset($_REQUEST['ID']) ? $_REQUEST['ID'] : array();
            if (is_array($ids)) $ids = implode(',', $ids);

            if (!empty($ids)) {
                echo 'deneme2';
                $wpdb->query("DELETE FROM $table WHERE ID IN($ids)");
            }
        }
    }
    
    



    

  


}



// MY SKİLLS

class Portfolio_MySkills_List_Table extends WP_List_Table
{
    // Here we will add our code

    // Define table columns
    function get_columns()
    {
        $columns = array(
                'cb'            => '<input type="checkbox" />',
                'skills_name'          => __('Skill Name', 'portfolio-admin-resume'),
                'skills_percent'   => __('Skill Percent', 'portfolio-admin-resume'),
                'skills_color'   => __('Skill Color', 'portfolio-admin-resume'),
                'order'        => __('Order', 'portfolio-admin-resume')
        );
        return $columns;
    }
     // define $table_data property
     private $table_data;

     // Bind table with columns, data and all
    function prepare_items()
    {

      global $wpdb;
      $table_name = $wpdb->prefix . 'portfolio_myskills'; 
        //data
        if ( isset($_POST['s']) ) {
            $this->table_data = $this->get_table_data($_POST['s']);
        } else {
            $this->table_data = $this->get_table_data();
        }

       


        $columns = $this->get_columns();
        $hidden = ( is_array(get_user_meta( get_current_user_id(), 'managetoplevel_page_myskills_list_tablecolumnshidden', true)) ) ? get_user_meta( get_current_user_id(), 'managetoplevel_page_myskills_list_tablecolumnshidden', true) : array();
        $sortable = $this->get_sortable_columns();
        $primary  = 'name';
        $this->_column_headers = array($columns, $hidden, $sortable, $primary);
        $this->process_bulk_action();
        usort($this->table_data, array(&$this, 'usort_reorder'));
        
       

        /* pagination */
        $per_page = $this->get_items_per_page('elements_per_page', 10);
        $current_page = $this->get_pagenum();
        $total_items = count($this->table_data);
        
        $this->table_data = array_slice($this->table_data, (($current_page - 1) * $per_page), $per_page);

        $paged = isset($_REQUEST['paged']) ? max(0, intval($_REQUEST['paged']) - 1) : 0;
        $orderby = (isset($_REQUEST['orderby']) && in_array($_REQUEST['orderby'], array_keys($this->get_sortable_columns()))) ? $_REQUEST['orderby'] : 'ID';
        $order = (isset($_REQUEST['order']) && in_array($_REQUEST['order'], array('asc', 'desc'))) ? $_REQUEST['order'] : 'asc';


        $this->items = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name ORDER BY $orderby $order LIMIT %d OFFSET %d", $per_page, $paged), ARRAY_A);


        
        $this->set_pagination_args(array(
            'total_items' => $total_items, // total number of items
            'per_page'    => $per_page, // items to show on a page
            'total_pages' => ceil( $total_items / $per_page ) // use ceil to round up
         ));

         

        $this->items = $this->table_data;
       
    }

     // Get table data
    private function get_table_data($search = '') {
        global $wpdb;

        $table = $wpdb->prefix . 'portfolio_myskills';

        if ( !empty($search) ) {
            return $wpdb->get_results(
                "SELECT * from {$table} WHERE skills_name Like '%{$search}%'  OR skills_percent Like '%{$search}%' OR skills_color Like '%{$search}%' ",
                ARRAY_A
            );
        } else {
            return $wpdb->get_results(
                "SELECT * from {$table}",
                ARRAY_A
            );
        }

        /*
        return $wpdb->get_results(
            "SELECT * from {$table}",
            ARRAY_A
        );
        */
        
    }

    function column_default($item, $column_name)
    {
          switch ($column_name) {
                case 'ID':
                case 'skills_name':
                case 'skills_percent':
                case 'skills_color':
                case 'order':
                default:
                    return $item[$column_name];
          }
    }

    

    function column_cb($item)
    {
        return sprintf(
                '<input type="checkbox" name="ID[]" value="%s" />',
                $item['ID']
        );
    }

    protected function get_sortable_columns()
{
      $sortable_columns = array(
           
            'order'   => array('order', true)
      );
      return $sortable_columns;
}

  // Sorting function
  function usort_reorder($a, $b)
  {
      // If no sort, default to user_login
      $orderby = (!empty($_GET['orderby'])) ? $_GET['orderby'] : 'user_login';

      // If no order, default to asc
      $order = (!empty($_GET['order'])) ? $_GET['order'] : 'asc';

      // Determine sort order
      $result = strcmp($a[$orderby], $b[$orderby]);

      // Send final sort direction to usort
      return ($order === 'asc') ? $result : -$result;
  }
/*
  function column_name($item)
    {

        $actions = array(
            'edit' => sprintf('<a href="?page=contacts_form&id=%s">%s</a>', $item['id'], __('Edit', 'portfolio_admin')),
            'delete' => sprintf('<a href="?page=%s&action=delete&id=%s">%s</a>', $_REQUEST['page'], $item['id'], __('Delete', 'portfolio_admin')),
        );

        return sprintf('%s %s',
            $item['name'],
            $this->row_actions($actions)
        );
    }
    */


    function column_skills_name($item)
    {
  
      /*
        $actions = array(
                'edit'      => sprintf('<a href="?page=%s&action=%s&element=%s">' . __('Edit', 'portfolio-admin-myresume') . '</a>', $_REQUEST['page'], 'edit', $item['ID']),
                'delete'    => sprintf('<a href="?page=%s&action=%s&element=%s">' . __('Delete', 'portfolio-admin-myresume') . '</a>', $_REQUEST['page'], 'delete', $item['ID']),
        );
  
        return sprintf('%1$s %2$s', $item['company_name'], $this->row_actions($actions));
  
        */
  
  
        $actions = array(
          'edit' => sprintf('<a href="?page=myskills_form&ID=%s">%s</a>', $item['ID'], __('Edit', 'portfolio-admin-myresume')),
          'delete' => sprintf('<a href="?page=%s&action=delete_all&ID=%s">%s</a>', $_REQUEST['page'], $item['ID'], __('Delete', 'portfolio-admin-myresume')),
      );
  
      return sprintf('%s %s',
          $item['skills_name'],
          $this->row_actions($actions)
      );
   } 

  
   // To show bulk action dropdown
   function get_bulk_actions(){
   
    $actions = array(
        'delete_all'    => __('Delete'),
        //'draft_all' => __('Move to Draft')
    );

    return $actions;
   }

   


   function process_bulk_action()
    {
        echo 'deneme1';
        global $wpdb;

        $table = $wpdb->prefix . 'portfolio_myskills';


        if ('delete_all' === $this->current_action()) {
            echo 'deneme3';
            $ids = isset($_REQUEST['ID']) ? $_REQUEST['ID'] : array();
            if (is_array($ids)) $ids = implode(',', $ids);

            if (!empty($ids)) {
                echo 'deneme2';
                $wpdb->query("DELETE FROM $table WHERE ID IN($ids)");
            }
        }
    }
    
    



    

  


}

// MY SERVİCES CLASS

class Portfolio_MyServices_List_Table extends WP_List_Table
{
    // Here we will add our code

    // Define table columns
    function get_columns()
    {
        $columns = array(
                'cb'            => '<input type="checkbox" />',
                'services_name'          => __('Service Name', 'portfolio-admin-resume'),
                'services_icon'         => __('Service İcon', 'portfolio-admin-resume'),
                'services_details'   => __('Service Details', 'portfolio-admin-resume'),
                'order'        => __('Order', 'portfolio-admin-resume')
        );
        return $columns;
    }
     // define $table_data property
     private $table_data;

     // Bind table with columns, data and all
    function prepare_items()
    {

      global $wpdb;
      $table_name = $wpdb->prefix . 'portfolio_myservices'; 
        //data
        if ( isset($_POST['s']) ) {
            $this->table_data = $this->get_table_data($_POST['s']);
        } else {
            $this->table_data = $this->get_table_data();
        }

       


        $columns = $this->get_columns();
        $hidden = ( is_array(get_user_meta( get_current_user_id(), 'managetoplevel_page_myservices_list_tablecolumnshidden', true)) ) ? get_user_meta( get_current_user_id(), 'managetoplevel_page_myservices_list_tablecolumnshidden', true) : array();
        $sortable = $this->get_sortable_columns();
        $primary  = 'name';
        $this->_column_headers = array($columns, $hidden, $sortable, $primary);
        $this->process_bulk_action();
        usort($this->table_data, array(&$this, 'usort_reorder'));
        
       

        /* pagination */
        $per_page = $this->get_items_per_page('elements_per_page', 10);
        $current_page = $this->get_pagenum();
        $total_items = count($this->table_data);
        
        $this->table_data = array_slice($this->table_data, (($current_page - 1) * $per_page), $per_page);

        $paged = isset($_REQUEST['paged']) ? max(0, intval($_REQUEST['paged']) - 1) : 0;
        $orderby = (isset($_REQUEST['orderby']) && in_array($_REQUEST['orderby'], array_keys($this->get_sortable_columns()))) ? $_REQUEST['orderby'] : 'ID';
        $order = (isset($_REQUEST['order']) && in_array($_REQUEST['order'], array('asc', 'desc'))) ? $_REQUEST['order'] : 'asc';


        $this->items = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name ORDER BY $orderby $order LIMIT %d OFFSET %d", $per_page, $paged), ARRAY_A);


        
        $this->set_pagination_args(array(
            'total_items' => $total_items, // total number of items
            'per_page'    => $per_page, // items to show on a page
            'total_pages' => ceil( $total_items / $per_page ) // use ceil to round up
         ));

         

        $this->items = $this->table_data;
       
    }

     // Get table data
    private function get_table_data($search = '') {
        global $wpdb;

        $table = $wpdb->prefix . 'portfolio_myservices';

        if ( !empty($search) ) {
            return $wpdb->get_results(
                "SELECT * from {$table} WHERE services_name Like '%{$search}%' OR services_icon Like '%{$search}%' OR services_details Like '%{$search}%' ",
                ARRAY_A
            );
        } else {
            return $wpdb->get_results(
                "SELECT * from {$table}",
                ARRAY_A
            );
        }

        /*
        return $wpdb->get_results(
            "SELECT * from {$table}",
            ARRAY_A
        );
        */
        
    }

    function column_default($item, $column_name)
    {
          switch ($column_name) {
                case 'ID':
                case 'services_name':
                case 'services_icon':
                case 'services_details': 
                case 'order':
                default:
                    return $item[$column_name];
          }
    }

    

    function column_cb($item)
    {
        return sprintf(
                '<input type="checkbox" name="ID[]" value="%s" />',
                $item['ID']
        );
    }

    protected function get_sortable_columns()
{
      $sortable_columns = array(
           
            'order'   => array('order', true)
      );
      return $sortable_columns;
}

  // Sorting function
  function usort_reorder($a, $b)
  {
      // If no sort, default to user_login
      $orderby = (!empty($_GET['orderby'])) ? $_GET['orderby'] : 'user_login';

      // If no order, default to asc
      $order = (!empty($_GET['order'])) ? $_GET['order'] : 'asc';

      // Determine sort order
      $result = strcmp($a[$orderby], $b[$orderby]);

      // Send final sort direction to usort
      return ($order === 'asc') ? $result : -$result;
  }
/*
  function column_name($item)
    {

        $actions = array(
            'edit' => sprintf('<a href="?page=contacts_form&id=%s">%s</a>', $item['id'], __('Edit', 'portfolio_admin')),
            'delete' => sprintf('<a href="?page=%s&action=delete&id=%s">%s</a>', $_REQUEST['page'], $item['id'], __('Delete', 'portfolio_admin')),
        );

        return sprintf('%s %s',
            $item['name'],
            $this->row_actions($actions)
        );
    }
    */


    function column_services_name($item)
    {
  
      /*
        $actions = array(
                'edit'      => sprintf('<a href="?page=%s&action=%s&element=%s">' . __('Edit', 'portfolio-admin-myresume') . '</a>', $_REQUEST['page'], 'edit', $item['ID']),
                'delete'    => sprintf('<a href="?page=%s&action=%s&element=%s">' . __('Delete', 'portfolio-admin-myresume') . '</a>', $_REQUEST['page'], 'delete', $item['ID']),
        );
  
        return sprintf('%1$s %2$s', $item['company_name'], $this->row_actions($actions));
  
        */
  
  
        $actions = array(
          'edit' => sprintf('<a href="?page=myservices_form&ID=%s">%s</a>', $item['ID'], __('Edit', 'portfolio-admin-myresume')),
          'delete' => sprintf('<a href="?page=%s&action=delete_all&ID=%s">%s</a>', $_REQUEST['page'], $item['ID'], __('Delete', 'portfolio-admin-myresume')),
      );
  
      return sprintf('%s %s',
          $item['services_name'],
          $this->row_actions($actions)
      );
   } 

  // Adding action links to column
  function column_college_name($item)
  {

    /*
      $actions = array(
              'edit'      => sprintf('<a href="?page=%s&action=%s&element=%s">' . __('Edit', 'portfolio-admin-myresume') . '</a>', $_REQUEST['page'], 'edit', $item['ID']),
              'delete'    => sprintf('<a href="?page=%s&action=%s&element=%s">' . __('Delete', 'portfolio-admin-myresume') . '</a>', $_REQUEST['page'], 'delete', $item['ID']),
      );

      return sprintf('%1$s %2$s', $item['company_name'], $this->row_actions($actions));

      */


      $actions = array(
        'edit' => sprintf('<a href="?page=myservices_form&ID=%s">%s</a>', $item['ID'], __('Edit', 'portfolio-admin-myresume')),
        'delete' => sprintf('<a href="?page=%s&action=delete_all&ID=%s">%s</a>', $_REQUEST['page'], $item['ID'], __('Delete', 'portfolio-admin-myresume')),
    );

    return sprintf('%s %s',
        $item['services_name'],
        $this->row_actions($actions)
    );
 } 

   // To show bulk action dropdown
   function get_bulk_actions(){
   
    $actions = array(
        'delete_all'    => __('Delete'),
        //'draft_all' => __('Move to Draft')
    );

    return $actions;
   }

   


   function process_bulk_action()
    {
        echo 'deneme1';
        global $wpdb;

        $table = $wpdb->prefix . 'portfolio_myservices';


        if ('delete_all' === $this->current_action()) {
            echo 'deneme3';
            $ids = isset($_REQUEST['ID']) ? $_REQUEST['ID'] : array();
            if (is_array($ids)) $ids = implode(',', $ids);

            if (!empty($ids)) {
                echo 'deneme2';
                $wpdb->query("DELETE FROM $table WHERE ID IN($ids)");
            }
        }
    }
    
    



    

  


}





// MY EDUCATİON CLASS
class Portfolio_MyEducation_List_Table extends WP_List_Table
{
    // Here we will add our code

    // Define table columns
    function get_columns()
    {
        $columns = array(
                'cb'            => '<input type="checkbox" />',
                'college_name'          => __('College Name', 'portfolio-admin-resume'),
                'education_type'         => __('Education Type', 'portfolio-admin-resume'),
                'education_years'   => __('Education Years', 'portfolio-admin-resume'),
                'education_details'   => __('Education Details', 'portfolio-admin-resume'),
                'order'        => __('Order', 'portfolio-admin-resume')
        );
        return $columns;
    }
     // define $table_data property
     private $table_data;

     // Bind table with columns, data and all
    function prepare_items()
    {

      global $wpdb;
      $table_name = $wpdb->prefix . 'portfolio_myeducations'; 
        //data
        if ( isset($_POST['s']) ) {
            $this->table_data = $this->get_table_data($_POST['s']);
        } else {
            $this->table_data = $this->get_table_data();
        }

       


        $columns = $this->get_columns();
        $hidden = ( is_array(get_user_meta( get_current_user_id(), 'managetoplevel_page_education_list_tablecolumnshidden', true)) ) ? get_user_meta( get_current_user_id(), 'managetoplevel_page_education_list_tablecolumnshidden', true) : array();
        $sortable = $this->get_sortable_columns();
        $primary  = 'name';
        $this->_column_headers = array($columns, $hidden, $sortable, $primary);
        $this->process_bulk_action();
        usort($this->table_data, array(&$this, 'usort_reorder'));
        
       

        /* pagination */
        $per_page = $this->get_items_per_page('elements_per_page', 10);
        $current_page = $this->get_pagenum();
        $total_items = count($this->table_data);
        
        $this->table_data = array_slice($this->table_data, (($current_page - 1) * $per_page), $per_page);

        $paged = isset($_REQUEST['paged']) ? max(0, intval($_REQUEST['paged']) - 1) : 0;
        $orderby = (isset($_REQUEST['orderby']) && in_array($_REQUEST['orderby'], array_keys($this->get_sortable_columns()))) ? $_REQUEST['orderby'] : 'ID';
        $order = (isset($_REQUEST['order']) && in_array($_REQUEST['order'], array('asc', 'desc'))) ? $_REQUEST['order'] : 'asc';


        $this->items = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name ORDER BY $orderby $order LIMIT %d OFFSET %d", $per_page, $paged), ARRAY_A);


        
        $this->set_pagination_args(array(
            'total_items' => $total_items, // total number of items
            'per_page'    => $per_page, // items to show on a page
            'total_pages' => ceil( $total_items / $per_page ) // use ceil to round up
         ));

         

        $this->items = $this->table_data;
       
    }

     // Get table data
    private function get_table_data($search = '') {
        global $wpdb;

        $table = $wpdb->prefix . 'portfolio_myeducations';

        if ( !empty($search) ) {
            return $wpdb->get_results(
                "SELECT * from {$table} WHERE college_name Like '%{$search}%' OR education_type Like '%{$search}%' OR education_years Like '%{$search}%' OR education_details Like '%{$search}%' ",
                ARRAY_A
            );
        } else {
            return $wpdb->get_results(
                "SELECT * from {$table}",
                ARRAY_A
            );
        }

        /*
        return $wpdb->get_results(
            "SELECT * from {$table}",
            ARRAY_A
        );
        */
        
    }

    function column_default($item, $column_name)
    {
          switch ($column_name) {
                case 'ID':
                case 'college_name':
                case 'education_type':
                case 'education_years':
                case 'education_details':
                case 'order':
                default:
                    return $item[$column_name];
          }
    }

    

    function column_cb($item)
    {
        return sprintf(
                '<input type="checkbox" name="ID[]" value="%s" />',
                $item['ID']
        );
    }

    protected function get_sortable_columns()
{
      $sortable_columns = array(
           
            'order'   => array('order', true)
      );
      return $sortable_columns;
}

  // Sorting function
  function usort_reorder($a, $b)
  {
      // If no sort, default to user_login
      $orderby = (!empty($_GET['orderby'])) ? $_GET['orderby'] : 'user_login';

      // If no order, default to asc
      $order = (!empty($_GET['order'])) ? $_GET['order'] : 'asc';

      // Determine sort order
      $result = strcmp($a[$orderby], $b[$orderby]);

      // Send final sort direction to usort
      return ($order === 'asc') ? $result : -$result;
  }
/*
  function column_name($item)
    {

        $actions = array(
            'edit' => sprintf('<a href="?page=contacts_form&id=%s">%s</a>', $item['id'], __('Edit', 'portfolio_admin')),
            'delete' => sprintf('<a href="?page=%s&action=delete&id=%s">%s</a>', $_REQUEST['page'], $item['id'], __('Delete', 'portfolio_admin')),
        );

        return sprintf('%s %s',
            $item['name'],
            $this->row_actions($actions)
        );
    }
    */

  // Adding action links to column
  function column_college_name($item)
  {

    /*
      $actions = array(
              'edit'      => sprintf('<a href="?page=%s&action=%s&element=%s">' . __('Edit', 'portfolio-admin-myresume') . '</a>', $_REQUEST['page'], 'edit', $item['ID']),
              'delete'    => sprintf('<a href="?page=%s&action=%s&element=%s">' . __('Delete', 'portfolio-admin-myresume') . '</a>', $_REQUEST['page'], 'delete', $item['ID']),
      );

      return sprintf('%1$s %2$s', $item['company_name'], $this->row_actions($actions));

      */


      $actions = array(
        'edit' => sprintf('<a href="?page=myeducations_form&ID=%s">%s</a>', $item['ID'], __('Edit', 'portfolio-admin-myresume')),
        'delete' => sprintf('<a href="?page=%s&action=delete_all&ID=%s">%s</a>', $_REQUEST['page'], $item['ID'], __('Delete', 'portfolio-admin-myresume')),
    );

    return sprintf('%s %s',
        $item['college_name'],
        $this->row_actions($actions)
    );
 } 

   // To show bulk action dropdown
   function get_bulk_actions(){
   
    $actions = array(
        'delete_all'    => __('Delete'),
        //'draft_all' => __('Move to Draft')
    );

    return $actions;
   }

   


   function process_bulk_action()
    {
        echo 'deneme1';
        global $wpdb;

        $table = $wpdb->prefix . 'portfolio_myeducations';


        if ('delete_all' === $this->current_action()) {
            echo 'deneme3';
            $ids = isset($_REQUEST['ID']) ? $_REQUEST['ID'] : array();
            if (is_array($ids)) $ids = implode(',', $ids);

            if (!empty($ids)) {
                echo 'deneme2';
                $wpdb->query("DELETE FROM $table WHERE ID IN($ids)");
            }
        }
    }
    
    



    

  


}

//MY WORKS CLASS
class Portfolio_MyWorks_List_Table extends WP_List_Table
{
    // Here we will add our code

    // Define table columns
    function get_columns()
    {
        $columns = array(
                'cb'            => '<input type="checkbox" />',
                'company_name'          => __('Company Name', 'portfolio-admin-resume'),
                'company_department'         => __('Company Department', 'portfolio-admin-resume'),
                'working_years'   => __('Working Years', 'portfolio-admin-resume'),
                'working_details'   => __('Working Details', 'portfolio-admin-resume'),
                'order'        => __('Order', 'portfolio-admin-resume')
        );
        return $columns;
    }
     // define $table_data property
     private $table_data;

     // Bind table with columns, data and all
    function prepare_items()
    {

      global $wpdb;
      $table_name = $wpdb->prefix . 'portfolio_myworks'; 
        //data
        if ( isset($_POST['s']) ) {
            $this->table_data = $this->get_table_data($_POST['s']);
        } else {
            $this->table_data = $this->get_table_data();
        }

       


        $columns = $this->get_columns();
        $hidden = ( is_array(get_user_meta( get_current_user_id(), 'managetoplevel_page_supporthost_list_tablecolumnshidden', true)) ) ? get_user_meta( get_current_user_id(), 'managetoplevel_page_supporthost_list_tablecolumnshidden', true) : array();
        $sortable = $this->get_sortable_columns();
        $primary  = 'name';
        $this->_column_headers = array($columns, $hidden, $sortable, $primary);
        $this->process_bulk_action();
        usort($this->table_data, array(&$this, 'usort_reorder'));
        
       

        /* pagination */
        $per_page = $this->get_items_per_page('elements_per_page', 10);
        $current_page = $this->get_pagenum();
        $total_items = count($this->table_data);
        
        $this->table_data = array_slice($this->table_data, (($current_page - 1) * $per_page), $per_page);

        $paged = isset($_REQUEST['paged']) ? max(0, intval($_REQUEST['paged']) - 1) : 0;
        $orderby = (isset($_REQUEST['orderby']) && in_array($_REQUEST['orderby'], array_keys($this->get_sortable_columns()))) ? $_REQUEST['orderby'] : 'ID';
        $order = (isset($_REQUEST['order']) && in_array($_REQUEST['order'], array('asc', 'desc'))) ? $_REQUEST['order'] : 'asc';


        $this->items = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name ORDER BY $orderby $order LIMIT %d OFFSET %d", $per_page, $paged), ARRAY_A);


        
        $this->set_pagination_args(array(
            'total_items' => $total_items, // total number of items
            'per_page'    => $per_page, // items to show on a page
            'total_pages' => ceil( $total_items / $per_page ) // use ceil to round up
         ));

         

        $this->items = $this->table_data;
       
    }

     // Get table data
    private function get_table_data($search = '') {
        global $wpdb;

        $table = $wpdb->prefix . 'portfolio_myworks';

        if ( !empty($search) ) {
            return $wpdb->get_results(
                "SELECT * from {$table} WHERE company_name Like '%{$search}%' OR company_department Like '%{$search}%' OR working_years Like '%{$search}%' OR working_details Like '%{$search}%' ",
                ARRAY_A
            );
        } else {
            return $wpdb->get_results(
                "SELECT * from {$table}",
                ARRAY_A
            );
        }

        /*
        return $wpdb->get_results(
            "SELECT * from {$table}",
            ARRAY_A
        );
        */
        
    }

    function column_default($item, $column_name)
    {
          switch ($column_name) {
                case 'ID':
                case 'company_name':
                case 'company_department':
                case 'working_years':
                case 'working_details':
                case 'order':
                default:
                    return $item[$column_name];
          }
    }

    

    function column_cb($item)
    {
        return sprintf(
                '<input type="checkbox" name="ID[]" value="%s" />',
                $item['ID']
        );
    }

    protected function get_sortable_columns()
{
      $sortable_columns = array(
           
            'order'   => array('order', true)
      );
      return $sortable_columns;
}

  // Sorting function
  function usort_reorder($a, $b)
  {
      // If no sort, default to user_login
      $orderby = (!empty($_GET['orderby'])) ? $_GET['orderby'] : 'user_login';

      // If no order, default to asc
      $order = (!empty($_GET['order'])) ? $_GET['order'] : 'asc';

      // Determine sort order
      $result = strcmp($a[$orderby], $b[$orderby]);

      // Send final sort direction to usort
      return ($order === 'asc') ? $result : -$result;
  }
/*
  function column_name($item)
    {

        $actions = array(
            'edit' => sprintf('<a href="?page=contacts_form&id=%s">%s</a>', $item['id'], __('Edit', 'portfolio_admin')),
            'delete' => sprintf('<a href="?page=%s&action=delete&id=%s">%s</a>', $_REQUEST['page'], $item['id'], __('Delete', 'portfolio_admin')),
        );

        return sprintf('%s %s',
            $item['name'],
            $this->row_actions($actions)
        );
    }
    */

  // Adding action links to column
  function column_company_name($item)
  {

    /*
      $actions = array(
              'edit'      => sprintf('<a href="?page=%s&action=%s&element=%s">' . __('Edit', 'portfolio-admin-myresume') . '</a>', $_REQUEST['page'], 'edit', $item['ID']),
              'delete'    => sprintf('<a href="?page=%s&action=%s&element=%s">' . __('Delete', 'portfolio-admin-myresume') . '</a>', $_REQUEST['page'], 'delete', $item['ID']),
      );

      return sprintf('%1$s %2$s', $item['company_name'], $this->row_actions($actions));

      */


      $actions = array(
        'edit' => sprintf('<a href="?page=myworks_form&ID=%s">%s</a>', $item['ID'], __('Edit', 'portfolio-admin-myresume')),
        'delete' => sprintf('<a href="?page=%s&action=delete_all&ID=%s">%s</a>', $_REQUEST['page'], $item['ID'], __('Delete', 'portfolio-admin-myresume')),
    );

    return sprintf('%s %s',
        $item['company_name'],
        $this->row_actions($actions)
    );
 } 

   // To show bulk action dropdown
   function get_bulk_actions(){
   
    $actions = array(
        'delete_all'    => __('Delete'),
        //'draft_all' => __('Move to Draft')
    );

    return $actions;
   }

   


   function process_bulk_action()
    {
        echo 'deneme1';
        global $wpdb;

        $table = $wpdb->prefix . 'portfolio_myworks';


        if ('delete_all' === $this->current_action()) {
            echo 'deneme3';
            $ids = isset($_REQUEST['ID']) ? $_REQUEST['ID'] : array();
            if (is_array($ids)) $ids = implode(',', $ids);

            if (!empty($ids)) {
                echo 'deneme2';
                $wpdb->query("DELETE FROM $table WHERE ID IN($ids)");
            }
        }
    }
    
    



    

  


}

// projects menu callback function
function myprojects_list_init()
{
      // Creating an instance
      $table = new Portfolio_MyProjects_List_Table();

      echo '<div class="wrap"><h2>My Projects List Table</h2>';
      echo '<form method="post">';
      // Prepare table
      $table->prepare_items();
      // Search form
      $table->search_box('search', 'search_id');
      // Display table
      $table->display();
      echo '</div></form>';
}


// skills menu callback function
function myskills_list_init()
{
      // Creating an instance
      $table = new Portfolio_MySkills_List_Table();

      echo '<div class="wrap"><h2>My Skills List Table</h2>';
      echo '<form method="post">';
      // Prepare table
      $table->prepare_items();
      // Search form
      $table->search_box('search', 'search_id');
      // Display table
      $table->display();
      echo '</div></form>';
}


// services menu callback function
function myservices_list_init()
{
      // Creating an instance
      $table = new Portfolio_MyServices_List_Table();

      echo '<div class="wrap"><h2>My Services List Table</h2>';
      echo '<form method="post">';
      // Prepare table
      $table->prepare_items();
      // Search form
      $table->search_box('search', 'search_id');
      // Display table
      $table->display();
      echo '</div></form>';
}




// Plugin menu callback function
function myworks_list_init()
{
      // Creating an instance
      $table = new Portfolio_MyWorks_List_Table();

      echo '<div class="wrap"><h2>My Resume List Table</h2>';
      echo '<form method="post">';
      // Prepare table
      $table->prepare_items();
      // Search form
      $table->search_box('search', 'search_id');
      // Display table
      $table->display();
      echo '</div></form>';
}

//College menu callback function

function myeducation_list_init()
{
      // Creating an instance
      $table = new Portfolio_MyEducation_List_Table();

      echo '<div class="wrap"><h2>My Education List Table</h2>';
      echo '<form method="post">';
      // Prepare table
      $table->prepare_items();
      // Search form
      $table->search_box('search', 'search_id');
      // Display table
      $table->display();
      echo '</div></form>';
}


function portfolio_hireme_setOptions(){
  if($_POST){
    $received_data = array(
      "hireme_title" => $_POST["hireme_title"],
      "hireme_description" => $_POST["hireme_description"],
    );

    $save = serialize($received_data);

    update_option('portfolio_hireme_options',$save,"yes");

    print_r(unserialize(get_option('portfolio_hireme_options')));
  }
}



function portfolio_mediumpost_setOptions(){
  if($_POST){
    $received_data = array(
      "medium_page_title" => $_POST["medium_page_title"],
      "medium_page_description" => $_POST["medium_page_description"],
      "medium_username" => $_POST["medium_username"],
      "medium_post_count" => $_POST["medium_post_count"],
    );

    $save = serialize($received_data);

    update_option('portfolio_mediumpost_options', $save,"yes");

    print_r(unserialize(get_option('portfolio_mediumpost_options')));
  }
}


function portfolio_aboutme_setOptions(){
    if($_POST){

    
        $gelen_veri = array(
            "aboutme_fullname" =>       $_POST["aboutme_fullname"],
            "aboutme_phone" =>          $_POST["aboutme_phone"],
            "aboutme_email" =>          $_POST["aboutme_email"],
            "aboutme_website" =>        $_POST["aboutme_website"],
            "aboutme_address" =>        $_POST["aboutme_address"],
            "aboutme_title" =>          $_POST["aboutme_title"],
            "aboutme_text" =>           $_POST["aboutme_text"],
            "aboutme_cv" =>             $_POST["aboutme_cv"],  
        ); 
    
        $depola = serialize($gelen_veri);
    
        update_option("portfolio_aboutme_settings",$depola,"yes");
    
        print_r(unserialize(get_option("portfolio_aboutme_settings")));
    
    }
}


function portfolio_general_setOptions(){

    if($_POST){

       // Save attachment ID
  if (isset($_POST['submit']) && isset($_POST['header_image_upload'])){
    
    update_option( 'media_selector_attachment_id', absint( $_POST['header_image_upload'] ) );
    //echo 'deneme:  11 : ' . $_POST["header_image_upload"];
  }


    
    $gelen_veri = array(
        "header_image_url" =>       $_POST["header_image_url"],
        "header_facebook" =>        $_POST["header_facebook"],
        "header_fullname" =>        $_POST["header_fullname"],
        "header_linkedin" =>        $_POST["header_linkedin"],
        "header_title" =>           $_POST["header_title"],
        "header_github" =>          $_POST["header_github"],
        "header_twitter" =>         $_POST["header_twitter"],
        "header_youtube" =>         $_POST["header_youtube"],
        "header_image_upload" =>    $_POST["header_image_upload"],


    ); 

    $depola = serialize($gelen_veri);

    update_option("header_settings",$depola,"yes");

    print_r(unserialize(get_option("header_settings")));

}
}



//add screen options for myprojects
function portfolio_myprojects() {
 
	global $supporthost_sample_page;
  global $table;
 
	$screen = get_current_screen();
 
	// get out of here if we are not on our settings page
	if(!is_object($screen) || $screen->id != $supporthost_sample_page)
		return;
 
	$args = array(
		'label' => __('Elements per page', 'portfolio-admin-myresume'),
		'default' => 2,
		'option' => 'elements_per_page'
	);
	add_screen_option( 'per_page', $args );

  $table = new Portfolio_MyProjects_List_Table();

}


// add screen options for myskills
function portfolio_myskills() {
 
	global $supporthost_sample_page;
  global $table;
 
	$screen = get_current_screen();
 
	// get out of here if we are not on our settings page
	if(!is_object($screen) || $screen->id != $supporthost_sample_page)
		return;
 
	$args = array(
		'label' => __('Elements per page', 'portfolio-admin-myresume'),
		'default' => 2,
		'option' => 'elements_per_page'
	);
	add_screen_option( 'per_page', $args );

  $table = new Portfolio_MySkills_List_Table();

}


// add screen options for myservices
function portfolio_myservices() {
 
	global $supporthost_sample_page;
  global $table;
 
	$screen = get_current_screen();
 
	// get out of here if we are not on our settings page
	if(!is_object($screen) || $screen->id != $supporthost_sample_page)
		return;
 
	$args = array(
		'label' => __('Elements per page', 'portfolio-admin-myresume'),
		'default' => 2,
		'option' => 'elements_per_page'
	);
	add_screen_option( 'per_page', $args );

  $table = new Portfolio_MyServices_List_Table();

}

// add screen options
function portfolio_myworks() {
 
	global $supporthost_sample_page;
        global $table;
 
	$screen = get_current_screen();
 
	// get out of here if we are not on our settings page
	if(!is_object($screen) || $screen->id != $supporthost_sample_page)
		return;
 
	$args = array(
		'label' => __('Elements per page', 'portfolio-admin-myresume'),
		'default' => 2,
		'option' => 'elements_per_page'
	);
	add_screen_option( 'per_page', $args );

    $table = new Portfolio_MyWorks_List_Table();

}


// add screen options for myeducation
function portfolio_myeducation() {
 
	global $myeducation_page;
        global $table;
 
	$screen = get_current_screen();
 
	// get out of here if we are not on our settings page
	if(!is_object($screen) || $screen->id != $myeducation_page)
		return;
 
	$args = array(
		'label' => __('Elements per page', 'portfolio-admin-myresume'),
		'default' => 2,
		'option' => 'elements_per_page'
	);
	add_screen_option( 'per_page', $args );

    $table = new Portfolio_MyEducation_List_Table();

}

//Validation for myprojects

function portfolio_admin_validate_myprojects($item)
{
    $messages = array();

    if (empty($item['projects_name'])) array_push( $messages, __('Project name is required', 'portfolio-admin-resume'));


    if (empty($messages)) return true;
    return implode('<br />', $messages);
}


// Validation for myskills
function portfolio_admin_validate_myskills($item)
{
    $messages = array();

    if (empty($item['skills_name'])) array_push( $messages, __('Skill name is required', 'portfolio-admin-resume'));
    if (empty($item['skills_percent'])) array_push($messages, __('Skill percent is required', 'portfolio-admin-resume'));
    if (empty($item['skills_color'])) $messages[] = __('Color is required', 'portfolio-admin-resume');

    if (empty($messages)) return true;
    return implode('<br />', $messages);
}



// Validation for my services
function portfolio_admin_validate_myservices($item)
{
    $messages = array();

    if (empty($item['services_name'])) $messages[] =  __('Service name is required', 'portfolio-admin-resume');
    if (empty($item['services_icon'])) $messages[] =  __('Service icon is required', 'portfolio-admin-resume');
    if (empty($item['services_details'])) $messages[] =  __('Service details are required', 'portfolio-admin-resume');

    if (empty($messages)) return true;
    return implode('<br />', $messages);
}


// Validation for my works
function portfolio_admin_validate_myworks($item)
{
    $messages = array();

    if (empty($item['company_name'])) $messages[] = __('Company name is required', 'portfolio-admin-resume');
    if (empty($item['company_department'])) $messages[] = __('Company department is required', 'portfolio-admin-resume');
    if (empty($item['working_years'])) $messages[] = __('Working years is required', 'portfolio-admin-resume');
    if (empty($item['working_details'])) $messages[] = __('Working details is required', 'portfolio-admin-resume');
    

    if (empty($messages)) return true;
    return implode('<br />', $messages);
}

//Validation for my education

function portfolio_admin_validate_myeducation($item)
{
    $messages = array();

    if (empty($item['college_name'])) $messages[] = __('College name is required', 'portfolio-admin-resume');
    if (empty($item['education_type'])) $messages[] = __('Education type is required', 'portfolio-admin-resume');
    if (empty($item['education_years'])) $messages[] = __('Education years is required', 'portfolio-admin-resume');
    if (empty($item['education_details'])) $messages[] = __('Education details is required', 'portfolio-admin-resume');
    

    if (empty($messages)) return true;
    return implode('<br />', $messages);
}


//Settings for my projects

function portfolio_setMyProjectsListMenu(){

  //deneme
  add_menu_page(__('My Projects', 'portfolio-admin-myresume'), __('My Projects', 'portfolio-admin-myresume'), 'activate_plugins', 'myprojects', 'portfolio_admin_myprojects_page_handler');
  add_submenu_page('myprojects', __('My Projects', 'portfolio-admin-myresume'), __('My Projects', 'portfolio-admin-myresume'), 'activate_plugins', 'myprojects', 'portfolio_admin_myprojects_page_handler');
   
  add_submenu_page('myprojects', __('Add new', 'portfolio-admin-myresume'), __('Add new', 'portfolio-admin-myresume'), 'activate_plugins', 'myprojects_form', 'portfolio_admin_projects_form_page_handler');
}

add_action("admin_menu","portfolio_setMyProjectsListMenu");


//Settings for my skills

function portfolio_setMySkillsListMenu(){

  //deneme
  add_menu_page(__('My Skills', 'portfolio-admin-myresume'), __('My Skills', 'portfolio-admin-myresume'), 'activate_plugins', 'myskills', 'portfolio_admin_myskills_page_handler');
  add_submenu_page('myskills', __('My Skills', 'portfolio-admin-myresume'), __('My Skills', 'portfolio-admin-myresume'), 'activate_plugins', 'myskills', 'portfolio_admin_myskills_page_handler');
   
  add_submenu_page('myskills', __('Add new', 'portfolio-admin-myresume'), __('Add new', 'portfolio-admin-myresume'), 'activate_plugins', 'myskills_form', 'portfolio_admin_skills_form_page_handler');
}

add_action("admin_menu","portfolio_setMySkillsListMenu");


//Settings for my services

function portfolio_setMyServicesListMenu(){

  //deneme
  add_menu_page(__('My Services', 'portfolio-admin-myresume'), __('My Services', 'portfolio-admin-myresume'), 'activate_plugins', 'myservices', 'portfolio_admin_myservices_page_handler');
  add_submenu_page('myservices', __('My Services', 'portfolio-admin-myresume'), __('My Services', 'portfolio-admin-myresume'), 'activate_plugins', 'myservices', 'portfolio_admin_myservices_page_handler');
   
  add_submenu_page('myservices', __('Add new', 'portfolio-admin-myresume'), __('Add new', 'portfolio-admin-myresume'), 'activate_plugins', 'myservices_form', 'portfolio_admin_services_form_page_handler');
}

add_action("admin_menu","portfolio_setMyServicesListMenu");



// Setting my works
function portfolio_setMyWorksListMenu(){

  //deneme
  add_menu_page(__('Portfolio My Resume', 'portfolio-admin-myresume'), __('My Works', 'portfolio-admin-myresume'), 'activate_plugins', 'myworks', 'portfolio_admin_myworks_page_handler');
  add_submenu_page('myworks', __('My Works', 'portfolio-admin-myresume'), __('My Works', 'portfolio-admin-myresume'), 'activate_plugins', 'myworks', 'portfolio_admin_myworks_page_handler');
   
  add_submenu_page('myworks', __('Add new', 'portfolio-admin-myresume'), __('Add new', 'portfolio-admin-myresume'), 'activate_plugins', 'myworks_form', 'portfolio_admin_works_form_page_handler');
}

add_action("admin_menu","portfolio_setMyWorksListMenu");

// Setting my education

function portfolio_setMyEducationsListMenu(){

  //deneme
  add_menu_page(__('Portfolio My Educations', 'portfolio-admin-myresume'), __('My Educations', 'portfolio-admin-myresume'), 'activate_plugins', 'myeducations', 'portfolio_admin_myeducations_page_handler');
  add_submenu_page('myeducations', __('Contacts', 'portfolio-admin-myresume'), __('My Educations', 'portfolio-admin-myresume'), 'activate_plugins', 'myeducations', 'portfolio_admin_myeducations_page_handler');
   
  add_submenu_page('myeducations', __('Add new', 'portfolio-admin-myresume'), __('Add new', 'portfolio-admin-myresume'), 'activate_plugins', 'myeducations_form', 'portfolio_admin_educations_form_page_handler');
}

add_action("admin_menu","portfolio_setMyEducationsListMenu");


function portfolio_setAdminMenu(){
    

    add_menu_page("Portfolio Settings","Portfolio Settings",'manage_options','portfolio_menu','menu_generalSettings');
    add_submenu_page( 'portfolio_menu', 'About Me', 'About Me', '2' ,'portfolio_aboutme' ,'menu_aboutme', '1');
   
    add_submenu_page('portfolio_menu','Medium Post','Medium Post','2','portfolio_mediumpost','menu_latestfromMedium','4');
    add_submenu_page('portfolio_menu', 'Hire Me', 'Hire Me', '2', 'portfolio_hireme', 'menu_hireme', '5');
}

function menu_latestfromMedium(){ ?>

   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

<div class="container">
<div class="card text-white text-center bg-dark mb-3" style="max-width: 100%; font-size: 20px;">
<div class="card-header">Portfolio Settings - Medium Settings</div>

<form method="post">


  <div class="form-group row">
    <label for="medium_username" class="col-4 col-form-label">Medium Username</label> 
    <div class="col-8">
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">
            <i class="fa fa-user-circle-o"></i>
          </div>
        </div> 
        <input id="medium_username" name="medium_username" value="<?php echo unserialize(get_option("portfolio_mediumpost_options"))["medium_username"];  ?>" type="text" class="form-control">
      </div>
    </div>
  </div>

  <div class="form-group row">
    <label for="medium_post_count" class="col-4 col-form-label">Post Count</label> 
    <div class="col-8">
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">
            <i class="fa fa-align-justify"></i>
          </div>
        </div> 
        <input id="medium_post_count" name="medium_post_count" value="<?php echo unserialize(get_option("portfolio_mediumpost_options"))["medium_post_count"];  ?>" type="number" class="form-control">
      </div>
    </div>
  </div> 
  
  <div class="form-group row">
    <label for="medium_page_title" class="col-4 col-form-label">Page Title</label> 
    <div class="col-8">
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">
            <i class="fa fa-header"></i>
          </div>
        </div> 
        <input id="medium_page_title" name="medium_page_title" value="<?php echo unserialize(get_option("portfolio_mediumpost_options"))["medium_page_title"];  ?>" type="text" class="form-control">
      </div>
    </div>
  </div>
  <div class="form-group row">
    <label for="medium_page_description" class="col-4 col-form-label">Page Description</label> 
    <div class="col-8">
      <textarea id="medium_page_description" name="medium_page_description"  cols="40" rows="5" class="form-control"><?php echo unserialize(get_option("portfolio_mediumpost_options"))["medium_page_description"];  ?></textarea>
    </div>
  </div> 
  
  <div class="form-group row">
    <div class="offset-4 col-8">
      <button name="submit" type="submit" class="btn btn-primary">Submit</button>
    </div>
  </div>


</form>

<?php portfolio_mediumpost_setOptions();


}



function menu_hireme(){ ?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="container">
<div class="card text-white text-center bg-dark mb-3" style="max-width: 100%; font-size: 20px;">
<div class="card-header">Portfolio Settings - Hire Me</div>

<form method="post">
<div class="form-group row">
    <label for="hireme_title" class="col-4 col-form-label">Title</label> 
    <div class="col-8">
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">
            <i class="fa fa-header"></i>
          </div>
        </div> 
        <input id="hireme_title" name="hireme_title" value="<?php echo unserialize(get_option("portfolio_hireme_options"))["hireme_title"];  ?>" type="text" class="form-control">
      </div>
    </div>
  </div>
  <div class="form-group row">
    <label for="hireme_description" class="col-4 col-form-label">Text Area</label> 
    <div class="col-8">
      <textarea id="hireme_description" name="hireme_description" cols="40" rows="5" class="form-control"><?php echo unserialize(get_option("portfolio_hireme_options"))["hireme_description"];  ?></textarea>
    </div>
  </div> 
  <div class="form-group row">
    <div class="offset-4 col-8">
      <button name="submit" type="submit" class="btn btn-primary">Submit</button>
    </div>
  </div>
</form>

<?php portfolio_hireme_setOptions();
  
}

add_action( 'admin_footer', 'media_selector_print_scriptse' );
function media_selector_print_scriptse() {

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
					$( '#aboutme_cv' ).val( attachment.id );

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





function menu_aboutme(){ 


  // Save attachment ID
	if ( isset( $_POST['submit_image_selector'] ) && isset( $_POST['aboutme_cv'] ) ) :
		update_option( 'media_selector_attachment_id', absint( $_POST['aboutme_cv'] ) );
	endif;
  
  wp_enqueue_media(); 
  
  
  ?>

    

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

<div class="container">
<div class="card text-white text-center bg-dark mb-3" style="max-width: 100%; font-size: 20px;">
<div class="card-header">Portfolio Settings - About Me Page</div>

<form method="post">
<div class="form-group row">
<label for="aboutme_cv" class="col-4 col-form-label">Upload CV</label> 
<div class="col-8">
<div class='image-preview-wrapper'>
		<img id='image-preview' src='' width='100' height='100' style='max-height: 100px; width: 100px;'>
	</div>
	<input id="upload_image_button" type="button" class="button" value="<?php _e( 'Upload CV' ); ?>" />
	<input type='hidden' name='aboutme_cv' id='aboutme_cv' value=''>
</div>
</div>

  <div class="form-group row">
    <label for="aboutme_fullname" class="col-4 col-form-label">Full Name</label> 
    <div class="col-8">
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">
            <i class="fa fa-user"></i>
          </div>
        </div> 
        <input id="aboutme_fullname" name="aboutme_fullname" value="<?php echo unserialize(get_option("portfolio_aboutme_settings"))["aboutme_fullname"];  ?>" type="text" class="form-control">
      </div>
    </div>
  </div>
  <div class="form-group row">
    <label for="aboutme_phone" class="col-4 col-form-label">Phone</label> 
    <div class="col-8">
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">
            <i class="fa fa-phone-square"></i>
          </div>
        </div> 
        <input id="aboutme_phone" name="aboutme_phone" value="<?php echo unserialize(get_option("portfolio_aboutme_settings"))["aboutme_phone"];  ?>" type="text" class="form-control">
      </div>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-4 col-form-label" for="aboutme_email">E-mail</label> 
    <div class="col-8">
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">
            <i class="fa fa-at"></i>
          </div>
        </div> 
        <input id="aboutme_email" name="aboutme_email" value="<?php echo unserialize(get_option("portfolio_aboutme_settings"))["aboutme_email"];  ?>" type="text" class="form-control">
      </div>
    </div>
  </div>
  <div class="form-group row">
    <label for="aboutme_website" class="col-4 col-form-label">Website</label> 
    <div class="col-8">
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">
            <i class="fa fa-wordpress"></i>
          </div>
        </div> 
        <input id="aboutme_website" name="aboutme_website" value="<?php echo unserialize(get_option("portfolio_aboutme_settings"))["aboutme_website"];  ?>" type="text" class="form-control">
      </div>
    </div>
  </div>
  <div class="form-group row">
    <label for="aboutme_address" class="col-4 col-form-label">Address</label> 
    <div class="col-8">
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">
            <i class="fa fa-address-card-o"></i>
          </div>
        </div> 
        <input id="aboutme_address" name="aboutme_address" value="<?php echo unserialize(get_option("portfolio_aboutme_settings"))["aboutme_address"];  ?>" type="text" class="form-control">
      </div>
    </div>
  </div>
  <div class="form-group row">
    <label for="aboutme_title" class="col-4 col-form-label">Title</label> 
    <div class="col-8">
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">
            <i class="fa fa-edit"></i>
          </div>
        </div> 
        <input id="aboutme_title" name="aboutme_title" value="<?php echo unserialize(get_option("portfolio_aboutme_settings"))["aboutme_title"];  ?>" type="text" class="form-control">
      </div>
    </div>
  </div>
  <div class="form-group row">
    <label for="aboutme_text" class="col-4 col-form-label">Text</label> 
    <div class="col-8">
      <textarea id="aboutme_text" name="aboutme_text" cols="40" rows="5" class="form-control"><?php echo unserialize(get_option("portfolio_aboutme_settings"))["aboutme_text"];  ?></textarea>
    </div>
  </div> 
  <div class="form-group row">
    <div class="offset-4 col-8">
      <button name="submit" type="submit" class="btn btn-primary">Submit</button>
    </div>
  </div>
</form>

<?php portfolio_aboutme_setOptions();

    
}
//WORDPRESS MEDİA SELECTOR

add_action( 'admin_footer', 'media_selector_print_scriptaa' );


function media_selector_print_scriptaa() {

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
					$( '#header_image_upload' ).val( attachment.id );

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




//WORDPRESS MEDİA SELECTOR

function menu_generalSettings(){

  wp_enqueue_media();
  portfolio_general_setOptions();
  
 ?>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    
    <div class="container">
    <div class="card text-white text-center bg-dark mb-3" style="max-width: 100%; font-size: 20px;">
    <div class="card-header">Portfolio Settings - General Settings</div>

    <form method="post">
    <div class="form-group row">
    <label for="header_image_upload" class="col-4 col-form-label">Profile Image</label> 
    <div class="col-8">
    <div class='image-preview-wrapper'>
		<img id='image-preview' src='<?php echo wp_get_attachment_image_src(unserialize(get_option("header_settings"))["header_image_upload"],"full")[0] ?>' width='100' height='100' style='max-height: 100px; width: 100px;'>
	</div>
	<input id="upload_image_button" type="button" class="button" value="<?php _e( 'Upload image' ); ?>" /> 
	<input type='hidden' name='header_image_upload' id='header_image_upload' value='<?php echo unserialize(get_option("header_settings"))["header_image_upload"];  ?>'>
</div>
</div>
  
  
  
  <div class="form-group row">
    <label for="header_fullname" class="col-4 col-form-label">Fullname</label> 
    <div class="col-8">
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">
            <i class="fa fa-address-card-o"></i>
          </div>
        </div> 
        <input id="header_fullname" name="header_fullname" value="<?php echo unserialize(get_option("header_settings"))["header_fullname"];  ?>" type="text" class="form-control">
      </div>
    </div>
  </div>
  <div class="form-group row">
    <label for="header_title" class="col-4 col-form-label">Your Title</label> 
    <div class="col-8">
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">
            <i class="fa fa-address-card-o"></i>
          </div>
        </div> 
        <input id="header_title" name="header_title" value="<?php echo unserialize(get_option("header_settings"))["header_title"];  ?>" type="text" class="form-control">
      </div>
    </div>
  </div>
  <div class="form-group row">
    <label for="header_facebook" class="col-4 col-form-label">Facebook URL</label> 
    <div class="col-8">
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">
            <i class="fa fa-facebook-official"></i>
          </div>
        </div> 
        <input id="header_facebook" name="header_facebook" value="<?php echo unserialize(get_option("header_settings"))["header_facebook"];  ?>" type="text" class="form-control">
      </div>
    </div>
  </div>
  <div class="form-group row">
    <label for="header_linkedin" class="col-4 col-form-label">Linkedin URL</label> 
    <div class="col-8">
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">
            <i class="fa fa-linkedin-square"></i>
          </div>
        </div> 
        <input id="header_linkedin" name="header_linkedin" value="<?php echo unserialize(get_option("header_settings"))["header_linkedin"];  ?>" type="text" class="form-control">
      </div>
    </div>
  </div>
  <div class="form-group row">
    <label for="header_github" class="col-4 col-form-label">Github URL</label> 
    <div class="col-8">
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">
            <i class="fa fa-github-square"></i>
          </div>
        </div> 
        <input id="header_github" name="header_github" type="text" value="<?php echo unserialize(get_option("header_settings"))["header_github"];  ?>" class="form-control">
      </div>
    </div>
  </div>
  <div class="form-group row">
    <label for="header_twitter" class="col-4 col-form-label">Twitter URL</label> 
    <div class="col-8">
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">
            <i class="fa fa-twitter-square"></i>
          </div>
        </div> 
        <input id="header_twitter" name="header_twitter" value="<?php echo unserialize(get_option("header_settings"))["header_twitter"];  ?>" type="text" class="form-control">
      </div>
    </div>
  </div>
  <div class="form-group row">
    <label for="header_youtube" class="col-4 col-form-label">Youtube URL</label> 
    <div class="col-8">
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">
            <i class="fa fa-youtube-play"></i>
          </div>
        </div> 
        <input id="header_youtube" name="header_youtube" value="<?php echo unserialize(get_option("header_settings"))["header_youtube"];  ?>" type="text" class="form-control">
      </div>
    </div>
  </div> 
  <div class="form-group row">
    <div class="offset-4 col-8">
      <button name="submit" type="submit" class="btn btn-primary">Submit</button>
    </div>
  </div>
</form>
<?php 




}

function menu_general(){ ?>
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

<div class="container">
<div class="card text-white text-center bg-dark mb-3" style="max-width: 100%; font-size: 20px;">
<div class="card-header">Portfolio General Settings</div>
<form method="post">
</div>
<div class="row">
<div class="col-md-3">
    Image URL : <input type="text" class="form-control" name="header_image_url" value="<?php echo unserialize(get_option("header_settings"))["header_image_url"];  ?>"><br>
    Facebook : <input type="text" class="form-control" name="header_facebook" value="<?php echo unserialize(get_option("header_settings"))["header_facebook"];  ?>">
</div>
<div class="col-md-3">
    Fullname : <input type="text" class="form-control" name="header_fullname" value="<?php echo unserialize(get_option("header_settings"))["header_fullname"];  ?>"><br>
    Linkedin : <input type="text" class="form-control" name="header_linkedin" value="<?php echo unserialize(get_option("header_settings"))["header_linkedin"];  ?>">
</div>
<div class="col-md-3">
    Your Title : <input type="text" class="form-control" name="header_title" value="<?php echo unserialize(get_option("header_settings"))["header_title"];  ?>"><br>
    Github : <input type="text" class="form-control" name="header_github" value="<?php echo unserialize(get_option("header_settings"))["header_github"];  ?>">
</div>
<div class="col-md-3">
    Twitter : <input type="text" class="form-control" name="header_twitter" value="<?php echo unserialize(get_option("header_settings"))["header_twitter"];  ?>"><br>
    Youtube : <input type="text" class="form-control" name="header_youtube" value="<?php echo unserialize(get_option("header_settings"))["header_youtube"];  ?>">
</div>


</div>
<input type="submit" class="btn btn-danger col-md-12">

</form>



    <?php 
    portfolio_general_setOptions();
    }
    
    



//CSS Files
function include_css_files(){


    wp_register_style('fonts', 'https://fonts.googleapis.com/css?family=Space+Mono', array(), 1, 'all');
    wp_enqueue_style('fonts');

    

    wp_register_style('shadowsintolight', 'https://fonts.googleapis.com/css?family=Shadows+Into+Light', array(), 1, 'all');
    wp_enqueue_style('shadowsintolight');



    wp_register_style('kaushan', 'https://fonts.googleapis.com/css?family=Kaushan+Script', array(), 1, 'all');
    wp_enqueue_style('kaushan');


    wp_register_style('animate', get_template_directory_uri().'/css/animate.css', array(), 1, 'all');
    wp_enqueue_style('animate');


    wp_register_style('icomoon', get_template_directory_uri().'/css/icomoon.css', array(), 1, 'all');
    wp_enqueue_style('icomoon');


    wp_register_style('bootstrap', get_template_directory_uri().'/css/bootstrap.css', array(), 1, 'all');
    wp_enqueue_style('bootstrap');


    wp_register_style('style', get_template_directory_uri().'/css/style.css', array(), 1, 'all');
    wp_enqueue_style('style');

}

add_action('wp_enqueue_scripts','include_css_files');

// JS Files

function include_js_files(){
    // JQUERY
    //jQuery
    wp_register_script('jquery0',get_template_directory_uri().'/js/jquery.min.js',array(),1,1);
    wp_enqueue_script('jquery0');
    //jQuery Easing
    wp_register_script('jquery1',get_template_directory_uri().'/js/jquery.easing.1.3.js',array(),1,1);
    wp_enqueue_script('jquery1');
    //Bootstrap
    wp_register_script( 'bootstrap0', get_template_directory_uri().'/js/bootstrap.min.js', array(),1,1);
    wp_enqueue_script('bootstrap0');
    //Waypoints
    wp_register_script('waypoints',get_template_directory_uri().'/js/jquery.waypoints.min.js',array(),1,1);
    wp_enqueue_script('waypoints');
    //Stellar Parallax
    wp_register_script('stellar',get_template_directory_uri().'/js/jquery.stellar.min.js',array(),1,1);
    wp_enqueue_script('stellar');
    //Easy PieChart
    wp_register_script('easypiechart',get_template_directory_uri().'/js/jquery.easypiechart.min.js',array(),1,1);
    wp_enqueue_script('easypiechart');
    //Google Map
    wp_register_script('googlemap','https://maps.googleapis.com/maps/api/js?key=AIzaSyCefOgb1ZWqYtj7raVSmN4PL2WkTrc-KyA&sensor=false',array(),1,1);
    wp_enqueue_script('googlemap');
    //Google Map JS
    wp_register_script('googlemapjs',get_template_directory_uri().'js/google_map.js',array(),1,1);
    wp_enqueue_script('googlemapjs');
    //Main JS
    wp_register_script('mainjs',get_template_directory_uri().'/js/main.js',array(),1,1);
    wp_enqueue_script('mainjs');

    wp_register_script('modernizrjs',get_template_directory_uri().'/js/modernizr-2.6.2.min.js',array(),1,1);
    wp_enqueue_script('modernizrjs');

}

add_action('wp_enqueue_scripts','include_js_files');

?>
