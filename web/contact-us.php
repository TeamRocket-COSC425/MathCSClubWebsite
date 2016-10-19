<?php
$title = "SU Math/CS Club Contact Us";
require_once("vendor/autoload.php");
    //get form data
  if(isset($_POST['contact_name'])){
    $contact_name = $_POST['contact_name'];
    $contact_email = $_POST['contact_email'];
    $contact_subject = $_POST['contact_subject'];
    $contact_message = $_POST['contact_message'];


    //verify email is an email
  if (!filter_var($_POST['contact_email'], FILTER_VALIDATE_EMAIL)){
    echo '<script>alert("The e-mail address you provided is not valid.");</script>';

  }
    //verify fields have entries
  elseif (empty($contact_name)){
    echo '<script type="text/javascript">alert("Please include your name.");</script>';
  } elseif (empty($contact_email)){
    echo '<script type="text/javascript">alert("Please include your email.");</script>';
  } else if(empty($contact_subject)){
    echo "Please include a subject for your message.";
  } else if(empty($contact_message)){
    echo "Please include your message message.";
  }

  else{
    $mail = new PHPMailer;

    $mail->isSMTP();
    // $mail->SMTPDebug = 3;
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
        <br><br>


        <form method="POST">

          <div class="group">      
            <input type="text" name="contact_name" required>
            <span class="highlight"></span>
            <span class="bar"></span>
            <label>Your Name</label>
          </div>

          <div class="group">      
            <input type="text" name="contact_email" required>
            <span class="highlight"></span>
            <span class="bar"></span>
            <label>Your Email</label>
          </div>

          <div class="group">      
            <input type="text" name="contact_subject" required>
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
