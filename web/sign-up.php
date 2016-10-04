<?php
  require_once('classes/Registration.php');
  $login = new Registration();
  if ($login->registered) {
    header("Location: login");
    die();
  } else {
    $title = "SU Math/CS Club Sign Up";
    include("includes/header.html");
    include("includes/sidenav.html");
    include("includes/topnav.php");
  }
?>

<head>
  <title>Math CS Club - Sign Up</title>
</head>

<body class="login-background">
<div class="container">

</div>
<div class="form">
  <br>
   <div class="loginWords">Math CS Club<br>Sign Up</div>
   <div class="loginErrors" style="color:red;">
     <?php
      if ($login->errors) {
        echo "<br>";
        foreach ($login->errors as $err) {
          echo $err . "<br>";
        }
      }
    ?>
    </div>
    <br><br>

  <form method="post" action="sign-up" class="login-form">
    <input id="reg_input_email" name="user_email" type="text" placeholder="Email" required/>
    <input id="reg_input_password_new" name="user_password_new" type="password" placeholder="Password" required/>
    <input id="reg_input_password_repeat" name="user_password_repeat" type="password" placeholder="Repeat Password" required/>
    <input id="reg_input_firstname" name="user_firstname" type="text" placeholder="First Name" required/>
    <input id="reg_input_lastname" name="user_lastname" type="text" placeholder="Last Name" required/>
    
    <select id="reg_input_major" name="user_major" class="signUpDrop" required/>
      <option selected disabled>Major</option>
      <?php
      $majors = $db->get('majors');
      foreach($majors as $major) {
        $name = $major['major'];
        echo '<option value="'. $name .'">&nbsp;&nbsp;'. $name .'</option>';
      }
      ?>
    </select>

	<br>
	<select id="reg_input_year" name="user_year" required>
    <option selected disabled>&nbsp;&nbsp;Class</option>
	<option value="0">&nbsp;&nbsp;Freshman</option>
	<option value="1">&nbsp;&nbsp;Sophmore</option>
	<option value="2">&nbsp;&nbsp;Junior</option>
	<option value="3">&nbsp;&nbsp;Senior</option>
	<option value="4">&nbsp;&nbsp;Other</option>
	</select>

   <p class="message">Upload a photo:</p>
              <input type="file" name="fileToUpload" id="fileToUpload">
              <input type="submit" class="message" value="Upload Image" name="submit" required>
  <br><br>



  <input id="login_input_submit" type="submit" name="register" value="Register" />
  <!--submit button needs to do something-->
    <p class="message">Already registered? <a href="login">Login</a></p>
  </form>

  </div>



  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src="js/index.js"></script>



</body>
</html>
