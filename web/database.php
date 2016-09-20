
<?php
    include("includes/header.html");
    include("includes/sidenav.html");
?>

<style>
body{margin:40px
auto;max-width:650px;line-height:1.6;font-size:18px;color:#444;padding:0
10px}h1,h2,h3{line-height:1.2}
</style>

<?php
    $url = parse_url(getenv("DATABASE_URL"));

    $host = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $database = substr($url["path"], 1);

    $conn = new mysqli($host, $username, $password, $database);
    if($conn->connect_error){
        echo "Connection failed: " . $conn->connect_error;
    }

    $sql = "SELECT * FROM test_table";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "id: " . $row["id"]. " - Name: " . $row["name"]. "<br>";
        }
    } else {
        echo "0 results";
    }

    $conn->close();
?>

</body>
</html>
