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

 if (isset($_GET['user'])) {
     $user = $db->where('id', $_GET['user'])->getOne('users');

     if (!$user) {
         $errors = "No such user exists.";
     } else {

         $existing = $db->where('id_mentee', $currentuser['id'])->getOne('mentor_mentee');
         if ($existing) {
             $errors = "You have already selected a mentor!";
         } else {

             $params = ['confirm' => $currentuser['id']];
             $msg =  "$currentuser[name] has chosen you as mentor, email them at $currentuser[preferred_email] if you would like them as a mentee.\n\n
                     To confirm their request, please follow this link: http://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]?" . http_build_query($params);

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
 } elseif (isset($_GET['confirm'])) {
     $entry = $db->where('id_mentee', $_GET['confirm'])->getOne('mentor_mentee');
     // Make sure this is the mentor
     if ($entry['id_mentor'] != $currentuser['id']) {
         header("Location: dashboard");
         die();
     }
     if (isset($_POST['mentor_confirm']) && $_POST['mentor_confirm'] == "true") {
         if ($_POST['mentor_confirm'])
         $db->where('id_mentee', $_GET['confirm'])->update('mentor_mentee', ['confirmed' => 1]);
         header("Location: profile");
     } else {
         $db->where('id_mentee', $_GET['confirm'])->delete('mentor_mentee');
     }
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
<?php
            if (isset($_GET['confirm'])) {
?>
                <center>
                <h4><?= "Are you sure you want to confirm " . $db->where('id', $_GET['confirm'])->getOne('users')['name'] ." as your mentee? "?></h4>
                <form id="dataform" method="post" action="<?= $_SERVER['REQUEST_URI'] ?>"></form>
        		<p style="color:red;">This cannot be undone</p>
                <div id="confirm_buttons">
            		<button form="dataform" type="submit" class="button dangerbutton" name="mentor_confirm" value="true"/>Yes</button><!--
                 --><button form="dataform" type="submit" class="button dangerbutton" name="mentor_confirm" value="false"/>No (deletes request)</button>
                </div>
        		<a id="delete_go_back" class="button" href="#">Go Back</a>
                </center>
<?php
            } else {
?>
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
                </h2></p>
<?php
            }
?>
        </div>
    </div>
</div>
