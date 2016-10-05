<?php
    require_once(__DIR__.'/../vendor/autoload.php');

    if (!MysqliDb::getInstance()) {
        $url = parse_url(getenv("DATABASE_URL"));

        $host = $url["host"];
        $username = $url["user"];
        $password = $url["pass"];
        $database = substr($url["path"], 1);

        new MysqliDb($host, $username, $password, $database);
    }

    $db = MysqliDb::getInstance();
?>
