<?php
    $title = "SU Math/CS Club Registration";
    include("includes/header.html");
    include("includes/sidenav.html");
    include("includes/topnav.php");
require_once('classes/registration-gc-mc.php');
    $gc = new gullcode();
    $mc = new math_challenge();
?>

<head>
	<title>Math CS Club - GullCode/Math Challenge Registration</title>
	  <link rel="stylesheet" href=""/>
	  <link rel="stylesheet" href="css/gc-mc-registration.css">

</head>

<body class="gc-mc-background">
<div class="container">
<br><br><br><br><br>
  
<!-- Begin Tabs navigation -->
<ul class = "tab">

  <a href="javascript:void(0)"  onclick="openTab(event,'About Me')" id="defaultOpen"></a>
  <li><a href="javascript:void(0)" class="tablinks" onclick="openTab(event, 'Math-Challenge')">
  <h1>Math Challenge</h1></a></li>
  <li><a href="javascript:void(0)" class="tablinks" onclick="openTab(event, 'GullCode')">
  <h1>GullCode</h1></a></li>
</ul>

<div id="About Me" class="tabcontent">
         <center><strong> Select Competition Link Above </strong> </center>
      </div>
<!--Math Challenge Tab Content-->
<?php 
if($login->isUserLoggedIn()) {
    $user = Utils::getCurrentUser();

        $members = $db->get("math_challenge_users_on_teams");
        $check = 0 ;
        foreach ($members as $member) {
            if($member['id'] == $user['id']) {
                $check = 1;
            }

        }
        if($check == 1) {
            echo("<div id='Math-Challenge' class='tabcontent'>
              <p class='center' style='color:red'><img src='images/message-icons/error.gif' width='50'style='float: left; margin: -.25em .5em 2em 2em '><span><b>You have already registered for Math Challenge.<br>Check your profile for more info</b></p>
              </div>");
        }
        else{
          echo('
<div id="Math-Challenge" class="tabcontent">
 <center><strong><u>Sign up Form</u></strong></center>
 
		<form method="post">
		 	
		<label class="radio" for="pick">Register as (check one):</label><br>
		<input class="radio" type="radio" name="registert-as"  value="0">Free Agent<br>
		<input class="radio" type="radio" name="registert-as"  value="1">Team <input type="text" name="team-name" placeholder="Team Name"/>​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​
		<br>
			T-Shirt Size:
<select name="t-size">
<optgroup label="Class">
  <option value="0">Small</option>
  <option value="1">Medium</option>
  <option value="2">Large</option>
  <option  value="3">x-large</option>
  <option value="4">2x-large</option>
  </optgroup>
</select>
       </p>


         <input name="mc-register" type="submit" value="Register for Math Challenge" class="insert"/>


		</form>



</div>');
        }
      }
          ?>
 
	

<!-- GullCode Tab Content-->
<?php 
if($login->isUserLoggedIn()) {
    $user = Utils::getCurrentUser();

        $members = $db->get("gullcode_users_on_teams");
        $check = 0 ;
        foreach ($members as $member) {
            if($member['id'] == $user['id']) {
                $check = 1;
            }

        }
        if($check == 1) {
             echo("<div id='GullCode' class='tabcontent'>
              <p class='center' style='color:red'><img src='images/message-icons/error.gif' width='50'style='float: left; margin: -.25em .5em 2em 2em '><span><b>You have already registered for GullCode.<br>Check your profile for more info</b></p>
              </div>");
        }
        else{
          echo('<div id="GullCode" class="tabcontent">
          <center><strong><u> Sign up Form </u></strong></center>
  
		      <form method="post">
		      <label class="radio" for="pick">Register as (check one):</label><br>
		      <input type="radio" name="registert-as" value="0">Free Agent<br>
		      <input type="radio" name="registert-as" value="1">Team <input type="text" name="team-name" placeholder="Team Name" >​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​
		      <br>
			     T-Shirt Size:
          <select name="t-size">
          <optgroup label="Class">
          <option value="0">Small</option>
          <option value="1">Medium</option>
          <option value="2">Large</option>
          <option  value="3">x-large</option>
          <option value="4">2x-large</option>
          </optgroup>
          </select>
          <br><br>

          <input name="gc-register" type="submit" value="Register for GullCode" class="insert"/>
          
	       	</form>
          </div>');
        }
  }
?>


<script>
document.getElementById("defaultOpen").click();

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

</div>



                                        
</body>
</html>