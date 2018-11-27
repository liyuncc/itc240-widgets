<?php include 'includes/config.php'?>
<?php get_header()?>

<?php

// the if block is the formhandler itself; the else block is the form!!
if(isset($_POST['Name'])){ //show data
    //echo $_POST['FirstName'];
    
    /*echo '<pre>';
    var_dump($_POST);
    echo '</pre>';
    die;
    */
    $to      = 'liyuncecil@gmail.com';
    $subject = 'clean contact page';
    
    //$message = 'Hello from '.$_POST['Name'];
    $message = process_post(); //formhandler
    $replyTo = 'lightly_sarah@yahoo.com.tw'; //client side
    $headers = 'From: noreply@liyuncecilcodes.com' . PHP_EOL .
        'Reply-To: ' . $replyTo . PHP_EOL .
        'X-Mailer: PHP/' . phpversion();
    mail($to, $subject, $message, $headers);
    echo '
        <p>Thanks for contacting us!</p>
        <a href="">Back</a>
        '; //feedback
    
}else{ //show form, no data
    echo '
    <form action="" method="post" name="sentMessage" id="contactForm" novalidate>
            <div class="control-group">
              <div class="form-group floating-label-form-group controls">
                <label>Name</label>
                <input type="text" class="form-control" placeholder="Name" 
                id="name" name="Name" required data-validation-required-message="Please enter your name.">
                <p class="help-block text-danger"></p>
              </div>
            </div>
            <div class="control-group">
              <div class="form-group floating-label-form-group controls">
                <label>Email Address</label>
                <input type="email" class="form-control" placeholder="Email Address" id="email" name="Email" required data-validation-required-message="Please enter your email address.">
                <p class="help-block text-danger"></p>
              </div>
            </div>
            
            
            <div class="control-group">
              <div class="form-group floating-label-form-group controls">
                <label>Message</label>
                <textarea rows="5" class="form-control" placeholder="Message" id="message" name="Message" required data-validation-required-message="Please enter a message."></textarea>
                <p class="help-block text-danger"></p>
              </div>
            </div>
            
            <br>
            <div id="success"></div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary" id="sendMessageButton">Send</button>
            </div>
            </div>
          </form>
    ';
}
?>
<?php get_footer()?>

<?php
function process_post()
{//loop through POST vars and return a single string
    $myReturn = ''; //set to initial empty value

    foreach($_POST as $varName=> $value)
    {#loop POST vars to create JS array on the current page - include email
         $strippedVarName = str_replace("_"," ",$varName);#remove underscores
        if(is_array($_POST[$varName]))
         {#checkboxes are arrays, and we need to collapse the array to comma separated string!
             $myReturn .= $strippedVarName . ": " . implode(",",$_POST[$varName]) . PHP_EOL;
         }else{//not an array, create line
             $myReturn .= $strippedVarName . ": " . $value . PHP_EOL;
         }
    }
    return $myReturn;
}
?>


