<?php
/*
 *-------------------------------------------------------
 *
 *                    Custom Post Types
 *
 *-------------------------------------------------------
*/

//generate an array of options for a CPT based on a "most used" profile template
//(only allows names)
//(requires unique name)
function dialog_new_default_CPT($name, $singlular_name)
{
  $default_post_type = array(
    'labels' => array(
      'name' => $name,
      'singular_name' => $singular_name
    ),
    'public' => true,
    'has_archive' => true,
    'show_ui' => true,
    'show_in_menu' => 'content-manager'
  );
  return $default_post_type;
}

//The names and singular names of every CPT we want to use in the theme, in order
$CPT_name_list = array(
  //About Us
    //Team
      'Office People',
      'Leadership People',
    'Faculty',
    'Our Partners',
    'Our Values',
    'News & Press',
  //Services
    //Marketing
      'Branding',
      'Messaging',
      'Demand Generation',
    //Leadership
      'Organizational Alignment',
    //Data & Analytics
      'RAD & TAM Modeling',
      'Campaign Performance',
      'Market Sizing',
    //Ecosystem Management
  //Industries
      //Healthcare
      //Technology
      //SMB
      //Channel
      //Public Sector
        'K12',
        'HED',
        'SLG',
        'FED',
  //Landing Page
    'Landing Slide',
  //Practice Areas
    //Digital
      'SEO',
      'Websites',
      'eCommerce',
      'Mobile Apps',
    //Analytics
    //Publishing
  //Insights
      //Blog
      //Publications/Articles
      //Live Dialog
        //View content
        //Upcoming Live Dialogs
        //Request an Invitation
  //Contact ("Reach Out maybe? lol")
      //Maps/Directions
        'Our Offices',
      //Connect via Social
      //Subscribe
      //Careers
      //Alumni
      //Open Door Program
  //Course Offerings
      //Health & Wellness
      //Leadership (Perch)
  //Landing Page
      //Clients
        'Client Logos',
        'Testimonials',
        'Case Studies'
      //Our Story
  );
$CPT_singular_name_list = array(
  //About Us
    //Team
      'Office People',
      'Leadership People',
    'Faculty',
    'Our Partners',
    'Our Values',
    'News & Press',
  //Services
    //Marketing
      'Branding',
      'Messaging',
      'Demand Generation',
    //Leadership
      'Organizational Alignment',
    //Data & Analytics
      'RAD & TAM Modeling',
      'Campaign Performance',
      'Market Sizing',
    //Ecosystem Management
  //Industries
      //Healthcare
      //Technology
      //SMB
      //Channel
      //Public Sector
        'K12',
        'HED',
        'SLG',
        'FED',
  //Landing Page
    'Landing Slide',
  //Practice Areas
    //Digital
      'SEO',
      'Websites',
      'eCommerce',
      'Mobile Apps',
    //Analytics
    //Publishing
  //Insights
      //Blog
      //Publications/Articles
      //Live Dialog
        //View content
        //Upcoming Live Dialogs
        //Request an Invitation
  //Contact ("Reach Out maybe? lol")
      //Maps/Directions
        'Our Offices',
      //Connect via Social
      //Subscribe
      //Careers
      //Alumni
      //Open Door Program
  //Course Offerings
      //Health & Wellness
      //Leadership (Perch)
  //Landing Page
      //Clients
        'Client Logos',
        'Testimonials',
        'Case Studies'
      //Our Story
  );

//Actual specification of CPTs
$post_types = array();

//Test to make sure we have a valid list of name, singular_name pairs.
if(!assert(count($CPT_name_list) == count($CPT_singular_name_list))) die('Corrupt CPT definitions. Check line 681 of functions.php.');

//create a complete array containing all of our CPT options
for($i = 0; $i < count($CPT_name_list); $i++)
{
  $post_types[] = dialog_new_default_CPT($CPT_name_list[$i], $CPT_singular_name_list[$i]);
}

//actually define a function to create the CPTs
function dialog_create_post_types()
{
  global $post_types;
  foreach($post_types as $post_type)
  {
    register_post_type(str_replace(" ", "_", strtolower($post_type['labels']['name'])), $post_type);
  }
}
//bind our function to the init hook
add_action('init', 'dialog_create_post_types');


/*
 *-------------------------------------------------------
 *
 *              Top Level Content Admin Menu
 *
 *-------------------------------------------------------
*/

function dialog_cpt_crud_menu() {
  add_menu_page("Content Manager", "Content", 'manage_options', 'content-manager', 'dialog_cpt_crud_options', null, 24);
}

function dialog_cpt_single_options()
{
  if ( !current_user_can( 'manage_options' ) )  {
    wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
  }
  echo '
  <script type="text/javascript">
    window.location="/wp-admin/edit.php?post_type=industrycontent";
  </script>';
}

add_action('admin_menu', 'dialog_cpt_crud_menu');
?>