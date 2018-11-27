<?php include 'includes/config.php'?>
<?php
    
/* Peusocode: write out the order first
If day is passed via GET, show $day's coffee
If it's today, show $today's coffee
Place a link to show today's coffee if on another day
*/
    
if(isset($_GET['day'])){//If day is passed via GET, show $day's coffee
    $today = $_GET['day'];
    
}else{//If it's today, show $today's coffee
    $today = date('l');
    
}

//$today = date('l');
//echo $today;
//die;
    
?>





<?php get_header()?>

<p><?=$today?>'s special is Pumpkin Spice!</p>  

<p>Click below to find our what awesome flavors we have for each day of the week!</p>
<p><a href="daily.php?day=sunday">Sunday</a></p>
<?php get_footer()?>