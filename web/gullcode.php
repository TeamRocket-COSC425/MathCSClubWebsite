<?php
    $title = "SU Math/CS Club GullCode";
    include("includes/header.html");
    include("includes/sidenav.html");
    include("includes/topnav.php");
    require_once("classes/EditableContent.php");
    require_once("classes/Login.php");
    require_once("classes/Utils.php");
    $login = new Login();
?>
<head>
  <title>Math CS Club - GullCode</title>
    <link rel="stylesheet" href="css/gullcode.css"/>
</head>

<body>

<div id="main">

<div id="content" class = "center">
<h1 class="center">
<code>
GullCode
</code>
</h1>

<table id="gullcodeContent">
  <tr>
    <td><img src="images/gullcode/gullcode_sp2014.jpg" class="gullcodepic"></td>
    <td><?php (new EditableContent("gullcodeTime"))->getContent(); ?>
    <td><img src="images/gullcode/gullcode_fa2015.jpg" class="gullcodepic"></td>
  </tr>
</table>

<?php (new EditableContent("gullCodeDescription"))->getContent(); ?>

<?php
  if($login->isUserLoggedIn()) {
    $user = Utils::getCurrentUser();

        $members = $db->get("gullcode_users_on_teams");
    $check = 0 ;
        foreach ($members as $member) {
            if($member['id'] == $user['id']) {
                $check = 1;
            }

        }
        if($check == 1) {
            echo("<p class ='center' style='color:red;'><u>You have already registered for gullcode. Check your profile for info</u></p>");
        }
        else{
          include("views/GC-MC-Register.html");
        } 
  } else {
    include("views/SignUp.html");
  }
?>


</div>
</div>

</body>

</html>
