<?php
    $title = "SU Math/CS Club Activities & Field Trips";
    include("includes/header.html");
    include("includes/sidenav.html");
    include("includes/topnav.php");
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
      <img src="images/activities/meetingsp2015.jpg" alt="multicultural day" class="activities-rotating-item" />
      <img src="images/activities/image3.jpg" alt="Wiffle ball" class="activities-rotating-item" />
      <img src="images/activities/IMG_1895.jpg" alt="chicken dinner" class="activities-rotating-item" />
      <img src="images/activities/oriolessp2016.png" alt="activities fair" class="activities-rotating-item" />
      <img src="images/activities/slaughterhousefa2015.jpg" alt="tower of hanoi" class="activities-rotating-item" />
    </div>
    <!-- END: Rotating images images -->
<h1 class="center">
Activites &amp; Field Trips
</h1>

<h2 class="center">
Fall 2016 
</h2>

<h3 style="text-align: left;">
Orioles Game
</h3>

<p>
<strong>Date:</strong> Friday September 23rd 2016<br>
<strong>Price:</strong> $20 per person <br>
<strong>Availability:</strong> 30 tickets for sale <br>
<strong>Transportation:</strong> Van will be provided along with car poolers <br>
<strong>Details:</strong> Game starts at 7:05pm and we will leave the GUC parking lot at 4pm. THe Orioles will be playing the Arizona Diamondbacks. It is a fan appreciation night and everyone will recieve a Hyun Soo Kim T-shirt and fireworks will take place after the game. <br>
<strong>What you need to do:</strong> Contact Sam at <u>smaillie1@gulls.salisbury.edu</u> to RSVP and pay. <br>
<br>
<img src="images/activities/camdenyards.jpg" alt="Camden Yards" width="100%">

</p>
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