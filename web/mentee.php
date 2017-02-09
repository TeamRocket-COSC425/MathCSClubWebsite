<?php
 require_once("classes/Utils.php");
 require_once("classes/Login.php");
 require_once("classes/ConfirmBuilder.php");
 $login = new Login;
 if (!$login->isUserLoggedIn()) {
    header("Location: home");
 }

 include("includes/header.html");
 include("includes/sidenav.html");
 include("includes/topnav.php");

 ?>
 <head>
   <title>Math CS Club - Mentor Select</title>
   <link rel="stylesheet" href="css/contact-us.css"/>
 </head>

 <div id="main">
     <div id="content">
        <p><h2>
<?php

        $user = Utils::getCurrentUser();
        $currentuser = $user;

        $user = $db->where('id', $_GET['user'])->getOne('users') ?: $user;

        $msg = "$currentuser[name] has chosen you as mentor, email them at $currentuser[preferred_email] if you would like them as a mentee.";

        $mail = Utils::createMail();

        $mail->setFrom("noreply@gulls.salisbury.edu", "SU Math/CS Club");
        $mail->addAddress($user['preferred_email']);
        $mail->Subject = "Mentor Request";
        $mail->Body = $msg;
?>
        <div class="messageArea">
            <img src="images/sent.png" alt="sentimg" class="thankYouImg"/><br>
            <div class="thankMessage">
<?php
                if (!$mail->send()) {
?>
                    <h1>"Message could not be sent.</h1>
                    <p>Error: <?= $mail->ErrorInfo ?></p>
<?php
                } else {
?>
                    <h1>Your message has been sent!</h1>
                    <p>
                        The mentor you selected has received an email with your information.
                        They should contact you soon.
                    </p>
<?php
                }
?>
            </div>
        </div>
    </div>
</div>
