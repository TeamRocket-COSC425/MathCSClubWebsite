<div id="announcements">
<?php
    $announcements = $db->orderBy('time', 'desc')->get('announcements', 5);
    foreach ($announcements as $ann) {
?>
        <div class="announcement <?php echo $ann['type']; ?>" >
<?php
            $timestamp = strtotime($ann['time']);
            $date = date('l, F d Y', $timestamp);
            echo '<h3>';
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
            echo '  ' . $date . ' - ' . $ann['title'] . '</h3>';
            echo '<p>' . $ann['content'] . '</p>';
        echo '</div>';
    }
?>
</div>
