<?php
  require_once('classes/Registration.php');
  $reg = new Registration();
  if ($reg->registered) {
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
  <link rel="stylesheet" href="css/forms.css"/>
</head>

<body class="login-background">
<div id="main">
<div id="content">
<div class="container">

</div>
<div class="form">
  <br>
   <div class="loginWords">Math CS Club<br>Sign Up</div>
   <div class="loginErrors" style="color:red;">
     <?php
      if ($reg->errors) {
        echo "<br>";
        foreach ($reg->errors as $err) {
          echo $err . "<br>";
        }
      }
    ?>
    </div>
    <br>

  <form method="post" action="sign-up" class="login-form">
    <input id="reg_input_email" name="user_email" type="text" placeholder="Email" required/>
    <input id="reg_input_password_new" name="user_password_new" type="password" placeholder="Password" required/>
    <input id="reg_input_password_repeat" name="user_password_repeat" type="password" placeholder="Repeat Password" required/>
    <input id="reg_input_id" name="user_id" type="text" placeholder="Student ID" required/>
    <input id="reg_input_firstname" name="user_firstname" type="text" placeholder="First Name" required/>
    <input id="reg_input_lastname" name="user_lastname" type="text" placeholder="Last Name" required/>

    <p class="message">Major:</p>
    <select id="reg_input_major" name="user_major" class="signUpDrop" required/>
      <optgroup label="Major">
      <?php
      $majors = $db->get('majors');
      foreach($majors as $major) {
        $name = $major['major'];
        echo '<option value="'. $name .'">'. $name .'</option>';
      }
      ?>
    </optgroup>
    </select>

	<br>
    <p class="message">Year:</p>
	<select id="reg_input_year" name="user_year" required>
        <optgroup label="Class">
<?php   for ($i = 0; $i < 5; $i++) { ?>
	       <option value="<?= $i ?>"><?= Utils::year($i) ?></option>
<?php   }  ?>
    </optgroup>
	</select>

 <br>

   <input id="login_input_submit" type="submit" name="register" value="Register" />

   <p class="message">Already registered? <a href="login">Login</a></p>
  </form>

  </div>



  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src="js/index.js"></script>


</div>
</div>
</body>
</html>
