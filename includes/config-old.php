<?php
/*
    config.php
    stores configuration data for our application
*/

ob_start(); //prevents header errors (read the whole file and do not send data)


define('DEBUG',TRUE); #we want to see all errors

include 'credentials.php'; //db credentials

define('THIS_PAGE', basename($_SERVER['PHP_SELF']));

//here are the urls and page names for our main nav
$nav1['template.php']='Template';
$nav1['db-test.php']='DB Test';
$nav1['customer_list.php']='Customers';
$nav1['daily.php']='Daily';
$nav1['contact.php']='Contact';

/*echo '<pre>';
var_dump($nav1);
echo '</pre>';
die;
*/

//default page values
$title = THIS_PAGE;
$siteName = 'Site Name';
$slogan = 'Whatever it is you do, we do it better!';
$pageHeader = 'The developer forgot to put a page header';
$subHeader = 'The developer forgot to put a sub header';

switch(THIS_PAGE){
    case 'template.php':
        $title= 'My template page';
        $pageHeader = 'Put PageID here';
        $subHeader = 'Put more info about page here';
    break;
    
    case 'customer_list.php':
        $title= 'A list of customers';
        $pageHeader = 'Our Customers';
        $subHeader = 'Don\'t sue us because we\'re using celebrity photos';
    break;
        
    case 'daily.php':
        $title= 'My daily page';
        $pageHeader = 'Daily Coffee Specials';
        $subHeader = 'All our coffee is special!';
    break;
        
    case 'contact.php':
        $title= 'My contact page';
        $pageHeader = 'Please contact us';
        $subHeader = 'We appreciate your feedback';
    break; 
        
    case 'db-test.php':
        $title= 'A database test page';
        $pageHeader = 'Database test page';
        $subHeader = 'Check this page to see if your db credentials are correct.';
    break; 
}


function myerror($myFile, $myLine, $errorMsg)
{
    if(defined('DEBUG') && DEBUG)
    {
       echo "Error in file: <b>" . $myFile . "</b> on line: <b>" . $myLine . "</b><br />";
       echo "Error Message: <b>" . $errorMsg . "</b><br />";
       die();
    }else{
		echo "I'm sorry, we have encountered an error.  Would you like to buy some socks?";
		die();
    }
}

/*
    makeLinks() will create nav items from an array
    echo makeLinks($nav1);
    ' . xxx . ' 
*/

function makeLinks($nav){
    $myReturn = ''; //add data to this empty string
    foreach($nav as $key => $value){
        
        if(THIS_PAGE == $key)
        {//current page add active class
            $myReturn .= '
         <li class="nav-item ">
              <a class="nav-link active" href="' . $key . ' ">' . $value . ' </a>
         </li>
        '; 
        }else{//add no formatting
            $myReturn .= '
         <li class="nav-item">
              <a class="nav-link" href="' . $key . ' ">' . $value . ' </a>
         </li>
        ';
        }
    }
    return $myReturn;
}// end makeLinks