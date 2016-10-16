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
      	$positions = $db->get('test_officers');
      	foreach($positions as $pos) {
        	echo '<a  class="'. $pos["position"] .'"> <img src="' . $pos["image"] . '" ></a>';                    
    	  }
    ?>
</div>

<form method="post" name="officerPic">
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
?>
</div>
</div>

</body>

</html>
