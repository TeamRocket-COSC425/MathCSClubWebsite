
<?php
    $title = "SU Math/CS Club Home";
    include("includes/header.html");
    include("includes/sidenav.html");
    require_once("classes/Login.php");

    $login = new Login();

    if ($login->isUserLoggedIn()) {
      include('views/Logout.html');
    } else {
      include('views/Login.html');
      include('views/Register.html');
    }
?>
</body>

<head>
	<title>Math CS Club - Home</title>
</head>

<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.7";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div id="main">

<div id="content">

<img src="images/mathCSbanner_transparent.png" alt="mathCSbannerIMG" class="homeImage"/><br>
<br>

<?php
  if ($login->isUserLoggedIn()) {
    echo "You are logged in as " . $_SESSION['user_email'] . ".";
  } else {
    echo "You are not logged in.<br><br>Errors: ";
    print_r($login->errors);
  }
?>
<br>

Welcome to the Salisbury University Mathematics and Computer Science Club Website, featuring the Dead Poet's Society!
The club is open to everyone - majors, minors, and anyone else in the SU
community with an interest in mathematics, computer science, and much more.
We host a wide variety of events including: talks, field trips, coding competitions,
math challenge competitions, pumpkin carving, Association for Computing Machinery (<a href="https://www.acm.org/">ACM</a>) meetings, and more!
<p>Club meetings currently take place in Henson 101 at 6pm every Thursday. </p>

<br>
<div class="fb-page" data-href="https://www.facebook.com/sumathcoscclub/" data-tabs="timeline" data-width="500px"
data-height="500px" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false"
data-show-facepile="true"><blockquote cite="https://www.facebook.com/sumathcoscclub/" class="fb-xfbml-parse-ignore">
<a href="https://www.facebook.com/sumathcoscclub/">SU Math &amp; COSC Club</a></blockquote></div>

</div>
</div>

</body>

</html>
