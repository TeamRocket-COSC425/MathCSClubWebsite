<?php
    $title = "SU Math/CS Club Officers";
    include("includes/header.html");
    include("includes/sidenav.html");
    include("includes/topnav.php");
    require_once("includes/database.php");
?>

<head>
	<title>Math CS Club - Officers</title>
    <link rel="stylesheet" href="css/officers.css"/>
</head>

<body>

<div id="main">

<div id="content">

<h1>
Meet Your Officers
</h1>

<div class='circle-container'>
	<div class='groupPic'><img src="images/officers/fall16septemberOfficers.jpg"></div>
	<?php
      	$positions = $db->get('officers');
      	foreach($positions as $pos) {
        	echo '<a  class="'. $pos["position"] .'"> <img src="' . $pos["image"] . '" ></a>';                    
    	  }
    ?>
     <div class="bubble">
        <h2>Chelsey Clement<br>President</h2>
        
        <!--<p>I’m also the Chair/Founder of SU ACM Chapter. Currently, I am a Data Analyst for Perdue Farms Inc. This will be my first year as an SI for Math 213 (Statistical Thinking) and Tutor for Project Enchant. I teach advanced tap, modern, jazz, and ballet at Xtreme Dance Studio. In my free time, I ride my motorcycle and take pictures for B&ampB Snapshots.</p>-->
        <p>The quick, brown fox jumps over a lazy dog. DJs flock by when MTV ax quiz prog. Junk MTV quiz graced by fox whelps. Bawds jog, flick quartz, vex nymphs. Waltz, bad nymph, for quick jigs vex! Fox nymphs grab quick-jived waltz. Brick quiz whangs jumpy veldt fox. Bright vixens jump; dozy fowl quack. Quick wafting zephyrs vex bold Jim. Quick zephyrs blow, vexing daft Jim. for quick jigs vex!</p>
    </div>
</div>

 <!--<div class="bubble">
        <h2>President</h2>
        <p>I’m also the Chair/Founder of SU ACM Chapter. Currently, I am a Data Analyst for Perdue Farms Inc. This will be my first year as an SI for Math 213 (Statistical Thinking) and Tutor for Project Enchant. I teach advanced tap, modern, jazz, and ballet at Xtreme Dance Studio. In my free time, I ride my motorcycle and take pictures for B&ampB Snapshots.</p>
        <p>The quick, brown fox jumps over a lazy dog. DJs flock by when MTV ax quiz prog. Junk MTV quiz graced by fox whelps. Bawds jog, flick quartz, vex nymphs. Waltz, bad nymph, for quick jigs vex! Fox nymphs grab quick-jived waltz. Brick quiz whangs jumpy veldt fox. Bright vixens jump; dozy fowl quack. Quick wafting zephyrs vex bold Jim. Quick zephyrs blow, vexing daft Jim. for quick jigs vex!</p>
</div>-->



<!--<form method="post" name="officerPic">
    <p class="message">Enter URL for picture</p>
    <input id="input_officer_pic" name="officer_pic" type="text" placeholder="URL" required>
    <input id="login_input_submit" type="submit" name="submit_button" value="Submit" />
  </form>

<?php
    $data = Array (
    'image' => $_POST['officer_pic']
    );
   
    $db->where ('name', 'Chelsey Clement');
    $db->update ('test_officers', $data)
        //echo $db->count . ' records were updated';
    //else
       // echo 'update failed: ' . $db->getLastError();
?>-->
</div>
</div>

</body>

</html>
