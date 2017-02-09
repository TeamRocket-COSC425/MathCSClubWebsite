<?php
 require_once("classes/Utils.php");
 require_once("classes/Login.php");
 require_once("classes/ConfirmBuilder.php");
 $login = new Login;
 if (!$login->isUserLoggedIn()) {
    header("Location: home");
 }

 $user = Utils::getCurrentUser();
 $currentuser = $user;

                 $user = $db->where('id', $_GET['user'])->getOne('users') ?: $user;

                $msg = "$currentuser[name] has chosen you as mentor, email them at $currentuser[preferred_email] if you would like them as a mentee.";

                $mail = Utils::createMail();

                $mail->setFrom("noreply@gulls.salisbury.edu", "SU Math/CS Club");
                $mail->addAddress($user['preferred_email']);
                $mail->Subject = "Mentor Request";
                $mail->Body = $msg;

                if (!$mail->send()) {
                    echo "Message could not be sent. Error: " . $mail->ErrorInfo;
                } else {
                    echo "Message has been sent.";
                    die();
                }

                //mail($user['preferred_email'], "Test", "test");

?>
