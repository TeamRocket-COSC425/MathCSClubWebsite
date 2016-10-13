<?php
    $title = "SU Math/CS Club Activities & Field Trips";
    include("includes/header.html");

    session_start();

    if (isset($_POST['text_info'])) {
      $myfile = fopen("content/resources.md", "w") or die("Unable to open file!");
      $text = $_POST['text_info'];
      fwrite($myfile, $text);

      $_SESSION['edit'] = false;
    }

    include("includes/sidenav.html");
    include("includes/topnav.php");
?>

<head>
	<title>Math CS Club - Extra Resources</title>
	<link rel="stylesheet" href="css/home.css"/>
</head>

<body>

<div id="main">
<div id="content">
   <?php
      if (isset($_SESSION['edit']) && $_SESSION['edit']) {
        ?>
          <form method="post" action="resources" id="edit">
          </form>
          <textarea rows="40" cols="150" name="text_info" form="edit"><?php
            echo file_get_contents('content/resources.md');?>
          </textarea>
          <input id="login_input_submit" type="submit" name="save" value="Save" form="edit" />
        <?php
      } else {
        $parser = new Parsedown();

        $text = file_get_contents('content/resources.md');
        echo $parser->text($text);
      }
    ?>
</div>
</div>

</body>
</html>
