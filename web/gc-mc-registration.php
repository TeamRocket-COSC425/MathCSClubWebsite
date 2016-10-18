<?php
    $title = "SU Math/CS Club Registration";
    include("includes/header.html");
    include("includes/sidenav.html");
    include("includes/topnav.php");
?>

<head>
	<title>Math CS Club - GullCode/Math Challenge Registration</title>
	  <link rel="stylesheet" href="css/forms.css"/>
	  <link rel="stylesheet" href="css/gc-mc-registration.css">

</head>

<body class="gc-mc-background">
<div class="container">
<br><br><br><br><br><br>
<div id="tabbox">
<a href="#" id="gullcode" class="tab gullcode">Gull Code</a>
<a href="#" id="math-challenge" class="tab math-challenge">Math Challenge</a>;
</div>
<div id="panel">

<div id="math_challenge_box">
<center><h1><code>Math Challenge Sign up Form</code></h1></center>
 	

		<form action="">
		<strong><p>Register as (check one):</p></strong>
		<input type="radio" name="register-as" value="Free-Agent">Free Agent<br>
		<input type="radio" name="register-as" value="Team">Team <input type="text" name="team-name" placeholder="Team Name" />​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​
		<br>
			T-Shirt Size:
<select>

  <option value="small">small</option>
  <option value="medium">medium</option>
  <option value="large">large</option>
  <option value="xlarge">xlarge</option>
</select>
       


         <button> Submit </button>
		</form>
<br>





<!-- if the user is logged in and it shows he has a "0" for no team and a "1" if there is a value for team. -->
<!-- if 0 then ask them to create a team or sign up from list below -->
<!-- if 1 then say you already signed up for gullcode -->






</div>
<div id="gullcode_box">
<center><h1><code>GullCode Sign up Form</code></h1></center>
<!-- <?php $db->where ("email",$_SESSION["user_email"]); $user = $db->getOne ("users");?> <br> You have not signed up for Gull Code yet,
<?php echo $user['name']; ?> -->



		<form action="">
		<strong><p>Register as (check one):</p></strong>
		<input type="radio" name="register-as" value="Free-Agent">Free Agent<br>
		<input type="radio" name="register-as" value="Team">Team <input type="text" name="team-name" placeholder="Team Name" />​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​
		<br>
			T-Shirt Size:
<select>

  <option value="small">small</option>
  <option value="medium">medium</option>
  <option value="large">large</option>
  <option value="xlarge">xlarge</option>
</select>
       


         <button> Submit </button>
		</form>


<table>

<!-- 
<?php
$cols = Array ("name");
$users = $db->get ("users", null, $cols);
?>

<?php
if ($db->count > 0)
    foreach ($users as $user) ?> <tr><br> <?php { 
     print_r ($user); 
    }?> </tr>
 ?> -->

</table>




</div>
</div>
</div>


</div>



<!-- below is the script for our tab to change between gullcode and math challenge  -->
<script type="text/javascript" src="http://ajax.googleapis.com/
ajax/libs/jquery/1.5/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function()
{

$(".tab").click(function()
{
var X=$(this).attr('id');

if(X=='math-challenge')
{
$("#gullcode").removeClass('select');
$("#math-challenge").addClass('select');
$("#gullcode_box").slideUp();
$("#math_challenge_box").slideDown();
}
else
{
$("#math-challenge").removeClass('select');
$("#gullcode").addClass('select');
$("#math_challenge_box").slideUp();
$("#gullcode_box").slideDown();
}

});

});

jQuery(document).ready(function($) {
   // STOCK OPTIONS
	$('input.maxtickets_enable_cb').change(function(){
		if ($(this).is(':checked'))
    $(this).next('div.max_tickets').hide();
else
    $(this).next('div.max_tickets').show();
	}).change();
});
</script>
</body>
</html>