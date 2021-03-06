<?php
    require_once("classes/EditableText.php");
    require_once("classes/EditableImage.php");

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
<?php (new EditableImage("home_banner"))->getContent(); ?>
<?php (new EditableText("home"))->getContent(); ?>

<div id="home-widgets">
    <div class="fb-page" data-href="https://www.facebook.com/sumathcoscclub" data-tabs="timeline"
        data-small-header="false" data-adapt-container-width="true" data-hide-cover="false"
        data-show-facepile="true" float="left">
        <blockquote style="display:none;" cite="https://www.facebook.com/sumathcoscclub" class="fb-xfbml-parse-ignore">
            <a href="https://www.facebook.com/sumathcoscclub">SU Math &amp; COSC Club</a>
        </blockquote>
    </div>
    <div id="video-container">
        <h2>Here's an example of one of the events we host, GeoPong!</h2>
        <iframe src="https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2Frandy.cone%2Fvideos%2F10154655043466350%2F&show_text=0&width=560"
            width="600" height="400" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allowFullScreen="true">
        </iframe>
    </div>
</div>

</div>
</div>

</body>

</html>
