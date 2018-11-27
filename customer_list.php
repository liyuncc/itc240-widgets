<?php
//customer_list.php - shows a list of customer data
?>
<?php include 'includes/config.php';?>
<?php get_header()?>
<?php
$sql = "select * from test_Customers";

//we connect to the db here 
//add error ____ from db-test.php
$iConn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

//we extract the data here

$result = mysqli_query($iConn,$sql);

if(mysqli_num_rows($result) > 0)
{//show records
 
    //point at each row and get data from it
    while($row = mysqli_fetch_assoc($result))
    {
     //html and here:
        echo '<p>';
        echo 'FirstName: <b>' . $row['FirstName'] . '</b> '; //Might see unknown key warning
        echo 'LastName: <b>' . $row['LastName'] . '</b> ';
        echo 'Email: <b>' . $row['Email'] . '</b> ';
        
        echo '<a href="customer_view.php?id=' . $row['CustomerID'] . '">' . $row['FirstName'] . '</a>'; //this gives us the link
        
        echo '</p>';
    }    

}else{//inform there are no records
    echo '<p>There are currently no customers</p>';
}

//release web server resources
@mysqli_free_result($result);

//close connection to mysql
@mysqli_close($iConn);

?>
<?php get_footer()?>

