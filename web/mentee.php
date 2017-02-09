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

                $mail = new PHPMailer;

                $mail->isSMTP();
                $mail->SMTPDebug = 3;
                $mail->Debugoutput = 'html';

                if (getenv('MAILTRAP_API_TOKEN')) {
                    $mail->Host = 'mailtrap.io';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'e3386170e7a765';
                    $mail->Password = 'd8ab29b5c13eb0';
                    $mail->Port = 2525;
                } else {
                    $mail->Host = 'localhost';
                    $mail->Port = 25;
                }
				
                $mail->setFrom("noreply@gulls.salisbury.edu", "SU Math/CS Club");
                $mail->addAddress($user['preferred_email']);
                $mail->Subject = "Mentor Request";
                $mail->Body = $msg;

                if (!$mail->send()) {
                    $this->errors[] = "Message could not be sent. Error: " . $mail->ErrorInfo;
                } else {
                    echo "Message has been sent.";

                    // Assure this code only runs once
                    header('Location: login?reset');
                    die();
                }

                //mail($user['preferred_email'], "Test", "test");
                
?>