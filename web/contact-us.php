<?php
$title = "SU Math/CS Club Contact Us";
require_once("vendor/autoload.php");

$errorMsg = "";       //holds error messages
  //get form data
if(isset($_POST['contact_name'])){
  $contact_name = $_POST['contact_name'];
  $contact_email = $_POST['contact_email'];
  $contact_subject = $_POST['contact_subject'];
  $contact_message = $_POST['contact_message'];

  function validateEmail($email){
    $result=false;

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
      //echo '<script>alert("The e-mail address you provided is not valid."); return false;</script>';
      $errorMsg = "The e-mail address you provided is not valid";
      return $result;
    }

    else{
      $result = true;
      return $result;
    }
  }

    //verify email is an email
  if(validateEmail($_POST['contact_email']) == false){
    $errorMsg = "The e-mail address you provided is not valid";
  }
  else if(validateEmail($_POST['contact_email']) == true){
      $mail = new PHPMailer;

      $mail->isSMTP();
  
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

      $mail->setFrom($contact_email);
      $mail->addAddress('sumathcsclub@gmail.com');
      $mail->addCC($contact_email); //to cc the user
      $mail->Subject = $contact_subject;
      $mail->Body = $contact_message;

    if ($mail->send()) {
      // Assure this code only runs once takes you to thankyou page
      header('Location: contactThanks');
      exit();
    }
}
}
include("includes/header.html");
include("includes/sidenav.html");
include("includes/topnav.php");
?>

<head>
  <title>Math CS Club - Contact Us</title>
  <link rel="stylesheet" href="css/contact-us.css"/>
</head>

<body>

  <div id="main">
    <div id="content">

      <div id="outer" align="center">

        <br>
        <h1>Contact Us</h1>
        <p>*All fields are required*</p>
        <br>

        <!--Display error messages-->
        <div class="loginErrors" style="color:red;">
          <?php if( isset($errorMsg) && $errorMsg != '' ) { echo $errorMsg; } ?>
        </div>
        <br>

        <form method="POST">

          <div class="group">
            <input type="text" name="contact_name" value="" required>
            <span class="highlight"></span>
            <span class="bar"></span>
            <label>Your Name</label>
          </div>

          <div class="group">
            <input type="email" name="contact_email" onkeyup="this.setAttribute('value', this.value);" value="" required>
            <span class="highlight"></span>
            <span class="bar"></span>
            <label>Your Email</label>
          </div>

          <div class="group">
            <input type="text" name="contact_subject" value="" required>
            <span class="highlight"></span>
            <span class="bar"></span>
            <label>Subject</label>
          </div>

          <div class="group">
            <textarea type="textarea" name="contact_message" required></textarea>
            <span class="bar"></span>
            <label>Message...</label>
          </div>

          <button type="submit" class="btn btn-start-order">Send Message</button>

        </form>

      </div>
    </div>
  </div>

</body>
</html>
