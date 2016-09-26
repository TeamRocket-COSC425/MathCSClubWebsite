<html>

<?php
    $title = "SU Math/CS Club Log in";
    include("includes/header.html");
    include("includes/sidenav.html");
    include("includes/Dashboard.html");
?>

<head>
    <title>Math CS Club - Login</title>

     <link rel="stylesheet" href="css/loginreset.css">

    <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900'>
    <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Montserrat:400,700'>
    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<div class="container">
  <div class="info">
    <h1>Math CS Club<br>Login</h1>
  </div>
</div>
<div class="form">
  

  <form class="forgot-form">
    <p class="message">Forgot your password?</p><br>
    <input type="password" placeholder="password"/>
    <input type="text" placeholder="email address"/>
    <button>submit</button>
    <p class="message">Already registered? <a href="#">Sign In</a></p>
    <p class="message">Not registered? <a href="#">Create an account</a></p> <!-- needs link to create account -->
  </form>

  <form class="login-form">
    <input type="text" placeholder="email"/>
    <input type="password" placeholder="password"/>
    <button>login</button>
    <p class="message">Forgot your password? <a href="#">Get password</a></p>
    <p class="message">Not registered? <a href="#">Create an account</a></p> <!-- needs link to create account -->
  </form>
  
  </div>

<!-- <video id="video" autoplay="autoplay" loop="loop" poster="polina.jpg"> -->
<!--   <source src="http://andytran.me/A%20peaceful%20nature%20timelapse%20video.mp4" type="video/mp4"/>
</video> -->

  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src="js/index.js"></script>

</body>
</html>