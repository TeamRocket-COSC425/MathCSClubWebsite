<?php
    $title = "SU Math/CS Club Log in";
    include("includes/header.html");
    include("includes/sidenav.html");
    include("includes/Dashboard.html");
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
   <br><br>

  <form class="login-form">
    <input type="text" placeholder="Email"/>
    <input type="password" placeholder="Password"/>
    <input type="text" placeholder="First Name"/>
    <input type="text" placeholder="Last Name"/>
    <input type="text" placeholder="Major"/>

	<br>
	<select>
	<option value="freshman">Freshman</option>
	<option value="sophmore">Sophmore</option>
	<option value="junior">Junior</option>
	<option value="senior">Senior</option>
	<option value="other">Other</option>
	</select>
	<br><br>

    <button>Sign Up</button>
    <p class="message">Already registered? <a href="login.php">Login</a></p>
  </form>
  
  </div>

  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src="js/index.js"></script>

</body>
</html>
