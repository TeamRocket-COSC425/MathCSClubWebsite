<?php
 require_once("classes/Utils.php");
 require_once("classes/Login.php");
 require_once("classes/ConfirmBuilder.php");
 $login = new Login;
 if (!$login->isUserLoggedIn()) {
    header("Location: home");
 }

 $errors = null;

 if (isset($_GET['user'])) {

     $currentuser = Utils::getCurrentUser();
     $user = $db->where('id', $_GET['user'])->getOne('users');

     if (!$user) {
         $errors = "No such user exists.";
     } else {

         $existing = $db->where('id_mentee', $currentuser['id'])->getOne('mentor_mentee');
         if ($existing) {
             $errors = "You have already selected a mentor!";
         } else {
             $msg = "$currentuser[name] has chosen you as mentor, email them at $currentuser[preferred_email] if you would like them as a mentee.";

             $mail = Utils::createMail();

             $mail->setFrom("noreply@gulls.salisbury.edu", "SU Math/CS Club");
             $mail->addAddress($user['preferred_email']);
             $mail->Subject = "Mentor Request";
             $mail->Body = $msg;

             if (!$mail->send()) {
                 $errors = $mail->ErrorInfo;
             } else {
                 $data = [
                     'id_mentor' => $user['id'],
                     'id_mentee' => $currentuser['id'],
                     'confirmed' => 0
                 ];
                 $db->insert('mentor_mentee', $data);
                 header("Location: mentee.php");
             }
         }
     }
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
