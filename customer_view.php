<?php
//customer_view.php - shows details of a single customer
?>
<?php include 'includes/config.php';?>
<?php

//process querystring here
if(isset($_GET['id'])) //?id=5 (the query string)
{//process data
    //cast the data to an integer, for security purposes
    
    $id = (int)$_GET['id']; //(int) is the fastest way to process the bad data. $id is the casted version.
}else{//redirect to safe page (list page is the entry point of the app)
    header('Location:customer_list.php'); //an absolute or a relative path
}


$sql = "select * from test_Customers where CustomerID = $id";
//we connect to the db here
$iConn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

//we extract the data here
$result = mysqli_query($iConn,$sql);

if(mysqli_num_rows($result) > 0)
{//show records
    while($row = mysqli_fetch_assoc($result))
    {
        $FirstName = stripslashes($row['FirstName']);
        $LastName = stripslashes($row['LastName']);
        $Email = stripslashes($row['Email']);
        $title = "Title Page for " . $FirstName; 
        //inside the header is the title tag (identify what kind of data it is), so $title will show in header.php
        $pageHeader = $FirstName;
        $Feedback = '';//no feedback necessary
    }    
}else{//inform there are no records
    $Feedback = '<p>This customer does not exist</p>';
}
?>

<?php get_header()?>

<?php    
if($Feedback == '')
{//data exists, show it

    echo '<p>';
    echo 'FirstName: <b>' . $FirstName . '</b> ';
    echo 'LastName: <b>' . $LastName . '</b> ';
    echo 'Email: <b>' . $Email . '</b> ';
    
    echo '<img src="uploads/customer' . $id . '.jpg" />'; //$id embedded here to let us see the pictures
    
    echo '</p>'; 
}else{//warn user no data
    echo $Feedback;
}    

echo '<p><a href="customer_list.php">Go Back</a></p>';

//release web server resources
@mysqli_free_result($result);

//close connection to mysql
@mysqli_close($iConn);

?>
<?php get_footer()?>