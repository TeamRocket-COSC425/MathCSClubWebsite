<?php
  require_once("classes/Login.php");
  require_once("classes/Utils.php");
  $login = new Login();
  if ($login->isUserLoggedIn()) {
    require_once('classes/registration-gc-mc.php');
    $gc = new gullcode();
    $mc = new math_challenge();
  	$user = Utils::getCurrentUser();

    $gcmembers = $db->get("gullcode_users_on_teams");
    $mcmembers = $db->get("math_challenge_users_on_teams");
    $regcheck = 0;
    foreach ($gcmembers as $gcmember) {
      if($gcmember['id'] == $user['id']) {
        $regcheck = 1;
      }
    }
    foreach ($mcmembers as $mcmember) {
      if($mcmember['id'] == $user['id']) {
        $regcheck =  1;
      }
    }
  }
  if ($regcheck == 1) {
    header("Location: gc-mc-notification");
    die();
  }
  else{
    $title = "SU Math/CS Club Registration";
  }

  include("includes/header.html");
  include("includes/sidenav.html");
  include("includes/topnav.php");
?>

<head>
	<title>Math CS Club - GullCode/Math Challenge Registration</title>
	<link rel="stylesheet" href="css/forms.css"/>
	<link rel="stylesheet" href="css/gc-mc-registration.css">
</head>

<body>
  <div id="main">
    <div id="content">
    <br><br><br>

<!-- Begin Tabs navigation -->
<div class = "tab">
  <div class="tabItems">
  <a href="javascript:void(0)"  onclick="openTab(event,'About Me')" id="defaultOpen"></a>
  <div class="mcTab"><a href="javascript:void(0)" class="tablinks" id="mathchallenge" onclick="openTab(event, 'Math-Challenge')">
  <h1>Math Challenge</h1></a></li>
</div>
  <div class="gcTab"><a href="javascript:void(0)" class="tablinks" id="gullcode" onclick="openTab(event, 'GullCode')">
  <h1>GullCode</h1></a></li>
</div>
</div>
</div>

<div id="About Me" class="tabcontent">
 Select Competition Link Above
</div>

<!--Math Challenge Tab Content-->
<?php
  if($login->isUserLoggedIn()) {
     $control = $db->where("admin_controls", "math_challenge_register")->getone("admin_controls");
    if($control["switch"] == 0){
      echo("<div id='Math-Challenge' class='tabcontent'><p class='center' style='color:red'><img src='images/message-icons/error.png' width='50'style='float: left; margin: -.25em -1.5em 2em 2em '><span><b><br>Registration for Math Challenge is currently closed.<br></b></p></div>");
    }
    else{
?>

<div id="Math-Challenge" class="form tabcontent">
<h3>Sign up Form</h3>

	<form method="post">
		<p class="message">Register As:</p>
		<select class="register-as" id="register-mc-as" name="registert-as" required>

		    <option value="0">Free Agent</option>
		    <option value="1">Team</option>

		</select>

	<div class="team" id="team-mc">
        <input type="text" placeholder="Team Name" name="team-name" />
    </div>
<br>
	<p class="message">Highest Math Course Taken(Select One):</p>
		<select name="mcourse">
			<optgroup label="Choose Highest Math Course Taken">
	  			<option value="MATH155">MATH 155 Modern Statistics With Computer Analysis</option>
	  			<option value="MATH160">MATH 160 Introduction to Applied Calculus</option>
	  			<option value="MATH201">MATH 201 Calculus I</option>
	  			<option value="MATH202">MATH 202 Calculus II</option>
	  			<option value="MATH213/214">MATH 213/214 Statistical Thinking</option>
	  			<option value="MATH215">MATH 215 Intro to Financial Mathematics</option>
	  			<option value="MATH300">MATH 300 Intro to Abstract Mathematics</option>
	  			<option value="MATH306">MATH 306 Linear Algebra </option>
	  			<option value="MATH310">MATH 310 Calculus III</option>
	  			<option value="MATH311">MATH 311 Differential Equations</option>
	  			<option value="MATH402">MATH 402 Theory of Numbers</option>
	  			<option value="MATH406">MATH 406 Geometric Structures</option>
	  			<option value="MATH413">MATH 413 Mathematical Statistics I</option>
	  			<option value="MATH415">MATH 415 Actuarial and Financial Models</option>
	  			<option value="MATH441">MATH 441 Abstract Algebra I</option>
	  			<option value="MATH451">MATH 451 Analysis I</option>
  			</optgroup>
		</select>
<br>

	<p class="message">T-Shirt Size:</p>
		<select name="t-size">
			<optgroup label="Size">
	  			<option value="0">Small</option>
	  			<option value="1">Medium</option>
	  			<option value="2">Large</option>
	  			<option  value="3">x-large</option>
	  			<option value="4">2x-large</option>
  		</optgroup>
		</select>

    <input name="mc-register" type="submit" value="Register for Math Challenge" class="insert"/>
	</form>
</div>
<?php
	}
	}

?>
<!-- GullCode Tab Content-->
<?php
  if($login->isUserLoggedIn()) {
     $control = $db->where("admin_controls", "gullcode_register")->getone("admin_controls");
    if($control["switch"] == 0){
      echo("<div id='GullCode' class='tabcontent'><p class='center' style='color:red'><img src='images/message-icons/error.png' width='50'style='float: left; margin: -.25em -1.5em 2em 2em '><span><b><br>Registration for GullCode is currently closed.<br></b></p></div>");
    }
    else{
?>

<div id="GullCode" class="form tabcontent">
<h3>Sign up Form</h3>

	<form method="post">
		<p class="message">Register As:</p>
		<select  class="register-as" id="register-gc-as" name="registert-as" required>

		    <option value="0">Free Agent</option>
		    <option value="1">Team</option>
		</select>

	<div class="team" id="team-gc">
        <input type="text" placeholder="Team Name" name="team-name" />
    </div>
	 <p class="message">Highest Computer Science Course Taken(Select One):</p>
		<select  name="ccourse">
			<optgroup label="Choose Highest Computer Science Course Taken">
	  			<option value="COSC117">COSC 117 Programming Fundamentals</option>
	  			<option value="COSC120">COSC 120 Computer Science I</option>
	  			<option value="COSC220">COSC 220 Computer Science II</option>
	  			<option value="COSC320">COSC 320 Advanced Data Structures And Algorithim Analysis</option>
	  			<option value="COSC350">COSC 350 Systems Software</option>
	  			<option value="COSC420">COSC 420 High Performance Computing</option>
  			</optgroup>
		</select>
<br>
	<p class="message">Highest Math Course Taken(Select One):</p>
		<select name="mcourse">
			<optgroup label="Choose Highest Math Course Taken">
	  			<option value="MATH155">MATH 155 Modern Statistics With Computer Analysis</option>
	  			<option value="MATH160">MATH 160 Introduction to Applied Calculus</option>
	  			<option value="MATH201">MATH 201 Calculus I</option>
	  			<option value="MATH202">MATH 202 Calculus II</option>
	  			<option value="MATH213/214">MATH 213/214 Statistical Thinking</option>
	  			<option value="MATH215">MATH 215 Intro to Financial Mathematics</option>
	  			<option value="MATH300">MATH 300 Intro to Abstract Mathematics</option>
	  			<option value="MATH306">MATH 306 Linear Algebra </option>
	  			<option value="MATH310">MATH 310 Calculus III</option>
	  			<option value="MATH311">MATH 311 Differential Equations</option>
	  			<option value="MATH402">MATH 402 Theory of Numbers</option>
	  			<option value="MATH406">MATH 406 Geometric Structures</option>
	  			<option value="MATH413">MATH 413 Mathematical Statistics I</option>
	  			<option value="MATH415">MATH 415 Actuarial and Financial Models</option>
	  			<option value="MATH441">MATH 441 Abstract Algebra I</option>
	  			<option value="MATH451">MATH 451 Analysis I</option>
  			</optgroup>
		</select>
<br>

	<p class="message">T-Shirt Size:</p>
		<select name="t-size">
			<optgroup label="Size">
	  			<option value="0">Small</option>
	  			<option value="1">Medium</option>
	  			<option value="2">Large</option>
	  			<option  value="3">x-large</option>
	  			<option value="4">2x-large</option>
 			</optgroup>
		</select>

    <input name="gc-register" type="submit" value="Register for GullCode" class="insert"/>
	</form>
</div>
<?php
  }
	}

?>
<script>
  document.getElementById("defaultOpen").click();
<?php
  if (isset($_GET['tab'])) {
?>
  document.getElementById("<?= $_GET['tab'] ?>").click();
<?php
  }
?>
  function openTab(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
  }
</script>

<script>
    // this toggles the visibility of other server
    function toggleFields() {
        if ($("#register-mc-as").val() == "1") {
            $("#team-mc").show();
        } else {
            $("#team-mc").hide();
        }

        if ($("#register-gc-as").val() == "1") {
            $("#team-gc").show();
        } else {
            $("#team-gc").hide();
        }
    }

    $(function () {
        toggleFields(); // call this first so we start out with the correct visibility depending on the selected form values
        // this will call our toggleFields function every time the selection value of our other field changes
        $(document).on("change", ".register-as", toggleFields);
    });
</script>

</body>
