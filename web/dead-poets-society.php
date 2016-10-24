<?php
    $title = "SU Math/DPS";
    include("includes/header.html");
    include("includes/sidenav.html");
    include("includes/topnav.php");
?>

<head>
	<title>Dead Poets Society</title>
	<link rel="stylesheet" href="css/dps.css"/>
</head>

<body>

<div id="main">

<div id="content">

<!--Top header line -->
<header>
<h1><code> Dead   &nbsp; Poets   &nbsp; Society</code></h1>
</header>
<br>

<div id="cols">
<!-- About container  -->

 <div class="center" style="text-align:justify;">
 	<center><b><h3><u> About</u></h3> </b></center>
In general, we gather every week to work on problems that excite us. Problems that evoke a sense of passion and prolonged energy to those that attempt them. Sometimes we work on problems that can’t be solved. The point is that we’re all working on it in solidarity. We attempt to look for balance in the unsteady, cohesion in the irrational, and beauty from all the places we never tried to see. </div>
<!-- End About container -->
<!--Images container -->


 <div class="center" >
   	<img src = "images/dead-poets-society/dead-poets-society.jpg" width="400" height="250">

<button class="accordion">DPS Questions October 6, 2016</button>
<div class="panel">
	
 <img src="images/dead-poets-society/DPS.Questions.10.06.16.01.JPG" alt="DPS Questions">

 <img src="images/dead-poets-society/DPS.Questions.10.06.16.02.JPG" alt="DPS Questions">
</div>

<button class="accordion">DPS Questions October 13, 2016</button>
<div class="panel">
  <img src="images/dead-poets-society/DPS.Questions.10.13.16.01.JPG" alt="DPS Questions">

 <img src="images/dead-poets-society/DPS.Questions.10.13.16.02.JPG" alt="DPS Questions">
</div>

<!--End Images container-->
<!--Rules container -->
<div class="center" style="text-align:justify;">
<p style=" position: 100% absolute; bottom: 0; left: 270px; width: 100%; text-align: justify;"> It’s not exactly possible to give a formal description of the DPS, as the DPS tries to challenge notions such as formality. I’ll give it a shot as a mental exercise. Let’s say that the DPS provides a space for interested individuals to showcase their successes, and challenge ideas that are regularly accepted as axiom. Its aim is to attempt to generate a unified theory of academia, and help break down the barriers that alienate us from other academic disciplines; except in the cases where they don't. Likewise, we should strive to avoid pretentiousness and pedantry, as the DPS is not a place for individuals to show off their acumen; except, of course, the cases that also belong to sentence (4) of this paragraph. For the most part, we should challenge any statement that leads with “of course”, “obviously”, or “clearly”. Instead I would like to stress the importance of collaboration and good faith effort. </p></div>
 </div>

</div>
</div>

<script>

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
