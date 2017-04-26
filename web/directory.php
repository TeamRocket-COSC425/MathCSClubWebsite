<?php
    $title = "SU Math/DPS";
    include("includes/header.html");
    include("includes/sidenav.html");
    include("includes/topnav.php");
?>

<head>
	<title>User Directory</title>
    <link rel="stylesheet" href="css/forms.css"/>
	<link rel="stylesheet" href="css/directory.css"/>
</head>

<body>
    <div id="main">
        <div id="content">
            <div id="search-header" class="form">
                <h2> Search Users</h2>
                <br><br>
                <form>
                    <input type="text" id="search-query" placeholder="Name" name="q" value="<?= isset($_GET['q']) ? $_GET['q'] : "" ?>">
                    <input class="button" type="submit"></input>
                </form>
            </div>
<?php
            if (isset($_GET['q']) && $_GET['q'] != '') {
                echo '<p>';
                $query = strtolower(urldecode($_GET['q']));
                $users = $db->get('users');
                $results = array();
                foreach ($users as $user) {
                    if (strpos(strtolower($user['name']), $query) !== false) {
                        $results[] = $user;
                    }
                }
                echo "Found " . count($results) . " results:";
                echo '<ul>';
                foreach ($results as $result) {
?>
                    <li>
                        <div class="user-result" id="user-<?= $result['id'] ?>">
                            <a href="profile?user=<?= $result['id'] ?>"><?= $result['name'] ?></a>
                        </div>
                    </li>
<?php
                }
                echo '</ul>';
            }
?>
            </p>
        </div>
    </div>
</body>
