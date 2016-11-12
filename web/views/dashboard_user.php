<div id="announcements">
    <h2>Announcements</h2>
<?php
    $announcements = $db->orderBy('time', 'desc')->get('announcements', 5);
    foreach ($announcements as $ann) {
?>
        <div class="announcement <?php echo $ann['type']; ?>" >
<?php
            $timestamp = strtotime($ann['time']);
            $date = date('l, F d Y', $timestamp);
            echo '<h3><strong>';
            switch ($ann['type']) {
                case 'note':
                    echo '<i class="fa fa-exclamation-circle" aria-hidden="true"></i>';
                    break;
                case 'important':
                    echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>';
                    break;
                default:
                    break;
            }
            echo '  ' . $ann['title']  . '</strong> - ' . $date . '</h3>';
<<<<<<< HEAD
            echo '<p>' . $ann['content'] . '</p>';
=======
            echo Parsedown::instance()->text($ann['content']);
>>>>>>> 7c90eec9fdbb9bb1e52407336748e6a9c1dde5c6
        echo '</div>';
    }

    if (isset($_GET['user'])) {
?>
        <a class="button" href="dashboard">Back to Admin Dashboard</a>
<?php
    }
?>
</div>
