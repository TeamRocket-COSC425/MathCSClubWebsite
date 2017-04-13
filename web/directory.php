<?php
    $title = "SU Math/DPS";
    include("includes/header.html");
    include("includes/sidenav.html");
    include("includes/topnav.php");
?>

<head>
	<title>User Directory</title>
	<link rel="stylesheet" href="css/directory.css"/>
</head>

<body>
    <div id="main">
        <div id="content">
            <div id="search-header">
                <h2> Search Users </h2>
                <form>
                    <input type="text" id="search-query" name="q">
                </form>
            </div>
<?php
            if (isset($_GET['q'])) {
                echo '<p>';
                $query = strtolower(urldecode($_GET['q']));
                $users = $db->get('users');
                echo '<ul>';
                foreach ($users as $user) {
                    if (strpos(strtolower($user['name']), $query) !== false) {
?>
                        <li>
                            <div class="user-result" id="user-<?= $user['id'] ?>">
                                <a href="profile?user=<?= $user['id'] ?>"><?= $user['name'] ?></a>
                            </div>
                        </li>
<?php
                    }
                }
                echo '</ul>';
            }
?>
            </p>
        </div>
    </div>
</body>
