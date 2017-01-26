<?php
    require_once("classes/UserFunctions.php");
    if (isset($_POST['unRSVP'])) {
        Users::unRSVP();
    }
?>
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
            echo '<p>' . $ann['content'] . '</p>';
        echo '</div>';
    }

    if (isset($_GET['user'])) {
?>
        <a class="button" href="dashboard">Back to Admin Dashboard</a>
<?php
    }
    $user = Utils::getCurrentUser();
    if (isset($_POST['RSVP'])) {
        $data = array(
            'id' => $user['id'],
            'name' => $user['name'],
            'item' => $_POST['item']

        );
        $db->insert('picnic_rsvp', $data);
    }
    $rsvps = $db->get('picnic_rsvp');
    $going = 0;
    foreach ($rsvps as $rsvp)
    {
        if ($rsvp['id'] == $user['id'])
        {
            $going = 1;
        }
    }
    if($going == 0)
    {
        echo '<h2>RSVP for the end of year picnic?</h2>';
        echo '<form id="RSVP" method="post">
                <p class="message">If you want to bring a dish to the picnic, enter it below:</p>
                <input type="text" id="item" name="item" placeholder="item"/>
              </form>
              <input  form="RSVP" type="submit" name="RSVP"/>';
    }
    else 
    {
        echo '<h2>Thank you for RSVPing for the end of year picnic</h2>';
        echo '<form method="post">
                <p class="message">If you would like to unRSVP, click below</p>
                <input class="dangerbutton" name="unRSVP" type="submit"/>
              </form>';
    }

?>
</div>
