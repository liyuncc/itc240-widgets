<?php
/*
config.php in includes file is where we need to work on

stores configuration information for our web application

*/

//removes header already sent errors
ob_start();

define('SECURE',false); #force secure, https, for all site pages

define('PREFIX', 'widgets_fl18_'); #Adds uniqueness to your DB table names.  Limits hackability, naming collisions

header("Cache-Control: no-cache");header("Expires: -1"); #Helps stop browser & proxy caching

define('DEBUG',true); #we want to see all errors

include 'credentials.php';//stores database info
include 'common.php';//stores favorite functions

//prevents date errors
date_default_timezone_set('America/Los_Angeles');

//create config object
$config = new stdClass;
//$config is the cup hook, it's everything (includes data and variables). 
//CHANGE TO MATCH YOUR PAGES
// -> is a connector, 會變成config.nav1

/*$config->nav1['index.php'] = "HOME";
$config->nav1['customers.php'] = "CUSTOMERS";
$config->nav1['contact.php'] = "CONTACT";
$config->nav1['daily.php'] = "DAILY";
*/

//match the new pattern, so it'll be our links and make sure our app matches their design
$config->nav1['template.php']='Template';
$config->nav1['db-test.php']='DB Test';
$config->nav1['customer_list.php']='Customers';
$config->nav1['daily.php']='Daily';
$config->nav1['contact.php']='Contact';


//create default page identifier
define('THIS_PAGE',basename($_SERVER['PHP_SELF']));

//START NEW THEME STUFF - be sure to add trailing slash!
$sub_folder = 'widgets/';//change to 'widgets' or 'sprockets' etc.
$config->theme = 'Brick';//sub folder to themes

//will add sub-folder if not loaded to root:
$config->physical_path = $_SERVER["DOCUMENT_ROOT"] . '/' . $sub_folder;
//force secure website
if (SECURE && $_SERVER['SERVER_PORT'] != 443) {#force HTTPS
	header("Location: https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
}else{
    //adjust protocol
    $protocol = (SECURE==true ? 'https://' : 'http://'); // returns true
    
}
$config->virtual_path = $protocol . $_SERVER["HTTP_HOST"] . '/' . $sub_folder;

define('ADMIN_PATH', $config->virtual_path . 'admin/'); # Could change to sub folder
define('INCLUDE_PATH', $config->physical_path . 'includes/');


//CHANGE ITEMS BELOW TO MATCH YOUR SHORT TAGS
$config->title = THIS_PAGE;
$config->loadhead = '';//place items in <head> element

//default page values
$config->siteName = 'SiteName';
$config->slogan = 'Whatever it is you do, we do it better!';
$config->pageHeader = 'The developer forgot to put a page header';
$config->subHeader = 'The developer forgot to put a sub header';

/*
switch(THIS_PAGE){
        
    case 'contact.php':    
        $config->title = 'Contact Page';    
    break;
    
    case 'appointment.php':    
        $config->title = 'Appointment Page';
        $config->banner = 'Widget Appointments!';
    break;
        
   case 'template.php':    
        $config->title = 'Template Page';    
    break;          
}
*/
switch(THIS_PAGE){
    case 'template.php':
        $config->title= 'My template page';
        $config->pageHeader = 'Put PageHeader here';
        $config->subHeader = 'Put more info about page here';
    break;
    
    case 'customer_list.php':
        $config->title= 'A list of customers';
        $config->pageHeader = 'Our Customers';
        $config->subHeader = 'Don\'t sue us because we\'re using celebrity photos';
    break;
        
    case 'daily.php':
        $config->title= 'My daily page';
        $config->pageHeader = 'Daily Coffee Specials';
        $config->subHeader = 'All our coffee is special!';
    break;
        
    case 'contact.php':
        $config->title= 'My contact page';
        $config->pageHeader = 'Please contact us';
        $config->subHeader = 'We appreciate your feedback';
    break; 
        
    case 'db-test.php':
        $config->title= 'A database test page';
        $config->pageHeader = 'Database test page';
        $config->subHeader = 'Check this page to see if your db credentials are correct.';
    break; 
}


//creates theme virtual path for theme assets, JS, CSS, images
$config->theme_virtual = $config->virtual_path . 'themes/' . $config->theme . '/';

/*
 * adminWidget allows clients to get to admin page from anywhere
 * code will show/hide based on logged in status
*/
/*
 * adminWidget allows clients to get to admin page from anywhere
 * code will show/hide based on logged in status
*/
if(startSession() && isset($_SESSION['AdminID']))
{#add admin logged in info to sidebar or nav
    
    $config->adminWidget = '
        <a href="' . ADMIN_PATH . 'admin_dashboard.php">ADMIN</a> 
        <a href="' . ADMIN_PATH . 'admin_logout.php">LOGOUT</a>
    ';
}else{//show login (YOU MAY WANT TO SET TO EMPTY STRING FOR SECURITY)
    
    $config->adminWidget = '
        <a  href="' . ADMIN_PATH . 'admin_login.php">LOGIN</a>
    ';
}

/*
    makeLinks() will create nav items from an array
    echo makeLinks($nav1);
    ' . xxx . ' 
*/


?>