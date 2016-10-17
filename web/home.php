<?php
    require_once("classes/EditableContent.php");

    include("includes/header.html");
    include("includes/sidenav.html");
    include("includes/topnav.php");
?>

</body>

<head>
	<title>Math CS Club - Home</title>
</head>

<body>
<div id="fb-root"></div>
<script>
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.7";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>

<div id="main">
<div id="content">
<?php (new EditableContent("home"))->getContent(); ?>

<div class="fb-page" data-href="https://www.facebook.com/sumathcoscclub/" data-tabs="timeline" data-width="500px"
data-height="500px" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false"
data-show-facepile="true"><blockquote cite="https://www.facebook.com/sumathcoscclub/" class="fb-xfbml-parse-ignore">
<a href="https://www.facebook.com/sumathcoscclub/">SU Math &amp; COSC Club</a></blockquote>
 </div>

</div>
</div>

</body>

</html>
