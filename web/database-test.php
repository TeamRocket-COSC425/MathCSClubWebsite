
<?php
    include("includes/header.html");
    include("includes/sidenav.html");
    require_once("includes/database.php");
?>

<div id="main">
  <div id="content">

<?php
    $result = $db->get('test_table');

    foreach ($result as $row) {
        echo "id: " . $row["id"]. " - Name: " . $row["name"]. "<br>";
    }
?>

  </div>
</div>

</body>
</html>
