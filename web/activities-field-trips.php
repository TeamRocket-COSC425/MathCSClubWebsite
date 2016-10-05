<?php
    $title = "SU Math/CS Club Activities & Field Trips";
    include("includes/header.html");
    include("includes/sidenav.html");
    include("includes/topnav.php");
?>

<head>
	<title>Math CS Club - Activities &amp; Field Trips</title>
	<link rel="stylesheet" href="css/activities.css"/>
	<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
</head>




<body>

<div id="main">

<div id="content">

    <img src="images/meeting/fall16september.jpg" alt="meetingpicture" class="mySlides w3-animate-fading"/>
    <img src="images/activities/meetingsp2015.jpg" alt="multicultural day" class="mySlides w3-animate-fading"/>
	<img src="images/activities/image3.jpg" alt="Wiffle ball" class="mySlides w3-animate-fading"/>
  	<img src="images/activities/oriolessp2016.png" alt="activities fair" class="mySlides w3-animate-fading"/> 
  	<img src="images/activities/IMG_1895.jpg" alt="chicken dinner" class="mySlides w3-animate-fading"/>

<h1 class="center">
Activites &amp; Field Trips
</h1>

<h2>
Fall 2016
</h2>

<!--EVENTS NEED TO BE DYNAMICALLY ALLOCATED IN THE DB SO PRES CAN ADD MORE AND STUFF-->

<button class="accordion">Orioles Game</button>
<div class="panel">
	<b>Date:</b> Friday September 23<sup>rd</sup>, 2016<br>
	<b>Price:</b> $20 per person <br>
	<b>Availability:</b> 30 tickets for sale <br>
	<b>Transportation:</b> Van will be provided along with car poolers <br>
	<b>Details:</b> Game starts at 7:05pm and we will leave the GUC parking lot at 4pm. The Orioles will be playing the Arizona Diamondbacks. It is a fan appreciation night and everyone will recieve a Hyun Soo Kim T-shirt and fireworks will take place after the game. <br>
	<b>What you need to do:</b> Contact Sam at <u>smaillie1@gulls.salisbury.edu</u> to RSVP and pay. <br>
<br>
<img src="images/activities/camdenYards.jpg" alt="Camden Yards"></div>

<button class="accordion">Slaughter House Farm</button>
<div class="panel">
  <b>Date:</b> Friday October 14<sup>th</sup> 2016<br>
	<b>Price:</b> $15 per person <br>
	<b>Availability:</b> 21 seats available <br>
	<b>Transportation:</b> Van will be provided along with car poolers <br>
	<b>Details:</b> Meet at 6:15pm in Henson 101. Event takes place in Laurel, DE (about 25 minutes away) and ends by 11pm.<br>
	<b>What you need to do:</b> Contact Chelsey at <u>cclement1@gulls.salisbury.edu</u> to RSVP and pay. <br>
</div>

<button class="accordion">Section 3</button>
<div class="panel">
  <p>Lorem ipsum...</p>
</div>



</p>
</div>
</div>


<script>
var myIndex = 0;
carousel();

function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";
    }
    myIndex++;
    if (myIndex > x.length) {myIndex = 1}
    x[myIndex-1].style.display = "block";
    setTimeout(carousel, 9000);
}

//script for accordion
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].onclick = function(){
        this.classList.toggle("active");
        this.nextElementSibling.classList.toggle("show");
    }
}
</script>
</body>

</html>