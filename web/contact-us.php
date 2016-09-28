<?php
    $title = "SU Math/CS Club Contact Us";
    include("includes/header.html");
    include("includes/sidenav.html");
    include("includes/Login.html");
?>

<head> 
	<title>Math CS Club - Contact Us</title>
</head> 

<body>

<div id="main">
<div id="content">

<h1>
Contact Us
</h1>

<form action="mailto:sumathcsclub@gmail.com" method="post" enctype="text/plain">
Name:<br>
<input type="text" name="name"><br>
E-mail:<br>
<input type="text" name="mail"><br>
Message:<br>
<input type="text" name="comment" size="50"><br><br>
<input type="submit" class="contact-submit" value="Submit">

</form>

</body>
</html>

<br/>
</div>
</div>

</body>

</html>