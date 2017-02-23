<?php
 require_once("classes/Utils.php");
 require_once("classes/Login.php");
 require_once("classes/ConfirmBuilder.php");
 $login = new Login;
 if (!$login->isUserLoggedIn()) {
    header("Location: home");
 }

 $errors = null;

 $currentuser = Utils::getCurrentUser();
 $user = $currentuser;

 if (isset($_GET['send'])) {

             $admins = $db->where('admin', 1)->get('users');
             $msg =  "$currentuser[name] has requested to be a mentor. Edit $currentuser[name]'s profile to make them a mentor.";

             $emails = array_map(function ($k) { return $k['preferred_email']; }, $admins);

            $errors = Utils::sendMail("noreply@gulls.salisbury.edu", $emails[0], "Request to be Mentor", $msg, $emails, "SU Math/CS Club");
            
            header("Location: mentor.php");

  } 

 include("includes/header.html");
 include("includes/sidenav.html");
 include("includes/topnav.php");

 ?>
 <head>
   <title>Math CS Club - Mentor Select</title>
   <link rel="stylesheet" href="css/contact-us.css"/>
   <link rel="stylesheet" href="css/mentee.css"/>
 </head>

 <div id="main">
     <div id="content">


                <p><h2>
                <div class="messageArea">
<?php
                if (!$errors) {
                    ?><img src="images/sent.png" alt="sentimg" class="thankYouImg"/><br><?php
                }
?>
                <div class="thankMessage">
<?php
                    if ($errors) {
?>
                        <h1>Message could not be sent.</h1>
                        <p><h3 class="errormsg">Error: <?= $errors ?></h3></p>
<?php
                    } else {
?>
                        <h1>Your message has been sent!</h1>
                        <p>
                            You have successfully requested to be a mentor,
                            the Admins will approve your request shortly.
                        </p>
<?php
                }
?>
                </div>
                </div>
                </h2></p>
      </div>
    </div>
</div>
