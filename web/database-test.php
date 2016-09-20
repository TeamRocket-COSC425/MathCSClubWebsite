
<?php
    include("includes/header.html");
    include("includes/sidenav.html");
    require_once("includes/database.php");
?>

<style>
body{margin:40px
auto;max-width:650px;line-height:1.6;font-size:18px;color:#444;padding:0
10px}h1,h2,h3{line-height:1.2}
</style>

<?php
    $result = $db->get('test_table');

    foreach ($result as $row) {
        echo "id: " . $row["id"]. " - Name: " . $row["name"]. "<br>";
    }
?>

</body>
</html>
