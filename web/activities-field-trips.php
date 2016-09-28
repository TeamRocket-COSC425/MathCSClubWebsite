<?php
    $title = "SU Math/CS Club Activities & Field Trips";
    include("includes/header.html");
    include("includes/sidenav.html");
    include("includes/Login.html");
?>

<head>
	<title>Math CS Club - Activities &amp; Field Trips</title>

<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type='text/javascript' src='js/infinite-rotator.js'></script>
    <link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
</head>

<body>

<div id="main">

<div id="content">
    <!-- START: Rotating Images -->
    <div id="activities-rotating-item-wrapper">
      <img src="images/meeting/fall16september.jpg" alt="meetingpicture" class="activities-rotating-item" />
      <img src="https://raw.githubusercontent.com/mcnitt/jquery-infinite-rotator/master/images/entrance.jpg" alt="meetingpicture" class="activities-rotating-item" />
      <img src="https://raw.githubusercontent.com/mcnitt/jquery-infinite-rotator/master/images/bluepeople.jpg" alt="meetingpicture" class="activities-rotating-item" />
      <img src="https://raw.githubusercontent.com/mcnitt/jquery-infinite-rotator/master/images/reflection3.jpg" alt="meetingpicture" class="activities-rotating-item" />
      <img src="https://raw.githubusercontent.com/mcnitt/jquery-infinite-rotator/master/images/reflection2.jpg" alt="meetingpicture" class="activities-rotating-item" />
      <img src="https://raw.githubusercontent.com/mcnitt/jquery-infinite-rotator/master/images/manequine.jpg" alt="meetingpicture" class="activities-rotating-item" />
    </div>
    <!-- END: Rotating images images -->
<h1>
Activites &amp; Field Trips
</h1>


</div>
</div>

<script>
$(window).load(function() {	//start after HTML, images have loaded
	var InfiniteRotator = 
	{
		init: function()
		{
			var initialFadeIn = 1000; //initial fade-in time (in milliseconds)
			var itemInterval = 5000; //interval between items (in milliseconds)
			var fadeTime = 2500; //cross-fade time (in milliseconds)
			var numberOfItems = $('.activities-rotating-item').length; //count number of items
			var currentItem = 0; //set current item
			$('.activities-rotating-item').eq(currentItem).fadeIn(initialFadeIn); //show first item

			//loop through the items
			var infiniteLoop = setInterval(function(){
				$('.activities-rotating-item').eq(currentItem).fadeOut(fadeTime);
				if(currentItem == numberOfItems -1){
					currentItem = 0;
				}else{
					currentItem++;
				}
				$('.activities-rotating-item').eq(currentItem).fadeIn(fadeTime);
			}, itemInterval);	
		}	
	};
	InfiniteRotator.init();
});
</script>

</body>

</html>