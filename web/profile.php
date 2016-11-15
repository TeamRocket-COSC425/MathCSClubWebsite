<head>
	<title>User Profile</title>
    <link rel="stylesheet" href="css/forms.css"/>
    <link rel="stylesheet" href="css/profile.css"/>
</head>

<?php
    $title = "User Profile";
    require_once("classes/Utils.php");
    require_once("classes/Login.php");
    $login = new Login;
    if (!$login->isUserLoggedIn()) {
      header("Location: home");
    }

    $user = Utils::getCurrentUser();
    $currentuser = $user;

    $edit = isset($_GET['edit']);
	$delete = isset($_GET['delete']);
    if (isset($_GET['user'])) {
      $user = $db->where('id', $_GET['user'])->getOne('users') ?: $user;
    }

	$upload_error_message = "";
	$uploadOk = 1;

    // POST handling
    if (isset($_POST['submit'])) {

		// Make sure we have a new image at all
		if ($_FILES['image']['size'] !== 0) {

			$target_dir = 'images/';
			// Grab file extension
			$imageFileType = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
			// Generate a file name based on the md5 hash of the file content
			$target_file = $target_dir . hash_file("md5", $_FILES['image']['tmp_name']) . '.' . $imageFileType;
			$allowed_types = array('jpg', 'jpeg', 'png');

			// Make sure the size is valid
			$check = getimagesize($_FILES['image']['tmp_name']);
			// Make sure the size is <=1MB
			if ($_FILES['image']['size'] > (1 << 20)) {
				$uploadOk = 0;
				$upload_error_message = "Image is too large. Max size 1MB.";
			}
			// Make sure the file is an image
			if (!in_array($imageFileType, $allowed_types)) {
				$uploadOk = 0;
				$upload_error_message = "Image type \"" . $imageFileType . "\" not allowed. Must be one of " . implode(', ', $allowed_types) . '.';
			}
			// If we are still good, begin upload process
			if ($uploadOk == 1) {
				if ($check) {

					if (getenv('S3_BUCKET')) {
						// S3 info available, upload to AWS
						$s3 = Aws\S3\S3Client::factory();
						$bucket = getenv('S3_BUCKET') ?: die('No "S3_BUCKET" config found in env!');

						$upload = $s3->upload($bucket, $target_file, fopen($_FILES['image']['tmp_name'], 'rb'), 'public-read');
						$db->where('id', $user['id'])->update('users', array('image' => $upload->get('ObjectURL')));
					} else {
						// Move into uploads folder, we are on local
						$target_file = 'uploads/' . $target_file;

						// If the file already exists, reuse it.
						if (!file_exists($target_file)) {
							// Otherwise, move the tmp file into the real file's location
							if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
								//echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
							} else {
								$uploadOk = 0;
								$upload_error_message = "Sorry, there was an error uploading your file.";
							}
						}

						if ($uploadOk == 1) {
							$db->where('id', $user['id'])->update('users', array('image' => $target_file));
						}
					}
				} else {
					// Unknown error
					$uploadOk = 0;
					$upload_error_message = "Could not upload image.";
				}
			}
		}

		// If file upload failed, no need to continue
		if ($uploadOk === 1) {

			// Build array of data to update table width
			// Cannot directly use $_POST array due to injection potential
	        $data = array(
	            'email' => $_POST['email'],
	            'preferred_email' => $_POST['preferred_email'],
	            'major' => $_POST['major'],
	            'year' => $_POST['year'],
	            't_size' => $_POST['t_size'],
	            'bio' => $_POST['bio']
	        );

			if (Utils::currentUserAdmin()) {
				$admindata = array(
					'mentor' => isset($_POST['mentor']) ? 1 : 0,
					'admin' => isset($_POST['admin']) ? 1 : 0
				);
				$data = array_merge($data, $admindata);
			}

	        $db->where('id', $user['id'])->update('users', $data);

			// Rebuild URL without 'edit' param (maintains user param)
	        $loc = "profile";
	        if ($user !== $currentuser) {
	            $loc = $loc . '?user=' . $user['id'];
	        }

			// Redirect
	        header("Location: " . $loc);

		}
    }

    include("includes/header.html");
    include("includes/sidenav.html");
    include("includes/topnav.php");
?>

<body>

<div id="main">

<div id="content">
<?php

  if (($edit || $delete) && $user !== $currentuser && !Utils::currentUserAdmin()) {
?>
    <center>
      You cannot edit this page.<br/>
      <a id="to_my_profile" class="button" href="profile?edit">To My Profile</a>
    </center>
<?php
    die();
  }
?>
  <script>
	$(document).ready(function(){
		$("#delete_go_back").click(function(){
			window.history.back();
		});
	});
  </script>
  <center>
<?php
 if ($delete) {
	if ($user === $currentuser) {
?>
		<h3>You cannot delete your own profile!</h3>
		<a id="delete_go_back" class="button" href="#">Go Back</a>
<?php
	} elseif (isset($_POST['confirm_delete'])) {
		$db->where('id', $user['id'])->delete('users');
?>		Profile "<?php echo $user['email']; ?>" has been deleted
		<a class="button" href="dashboard">To Dashboard</a>
<?php
	} else {
?>  	<h4>Are you sure you want to delete the profile for "<?php echo $user['email']; ?>"?</h4>
		<p style="color:red;">This cannot be undone</p>
		<form method="post" id="delete_profile">
		</form>
		<input form="delete_profile" class="dangerbutton" type="submit" name="confirm_delete" id="delete_profile" value="Yes" />
		<a id="delete_go_back" class="button" href="#">Go Back</a>
<?php
	}
	die();
  }
?>
  </center>

<div id = "user_info">
<div id="left_column">
  <?php
    $image = $user['image'];
    if (!$image) {
      $image = "images/loginicon.jpg";
    }

    if ($edit) {
?>
        <div class="form">
            <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" id="profile" enctype="multipart/form-data">
            </form>

			<div class="editErrors" style="color:red;">
				<?php if ($uploadOk === 0) 
          {
            $errors='<img src="images/message-icons/error.jpg"/>'; 
            echo "<table><span>";
            echo "<tr>$errors $upload_error_message</tr>";
            echo "</table></span>";
          }
        ?>
			</div>
            <img id="profile_image" src="<?php echo $user['image']; ?>"/><br>
            <label class="profile_image_upload">
                <input form="profile" type="file" name="image" value="<?php echo $user['image']; ?>" />
                <i class="fa fa-upload fa-2x" aria-hidden="true"></i>
            </label>

            <p class="message">Email:</p>
            <input form="profile" type="text" name="email" value="<?php echo $user['email']; ?>" required/>

            <p class="message">Preferred Email:</p>
            <input form="profile" type="text" name="preferred_email" value="<?php echo $user['preferred_email']; ?>" />

            <!-- TODO this is copied from sign-up.php -->
            <p class="message">Major:</p>
            <select form="profile" id="reg_input_major" name="major" class="signUpDrop" value="<?php echo $user['major'];?>" required/>
              <optgroup label="Major">
<?php
              $majors = $db->get('majors');
              foreach($majors as $major) {
                $name = $major['major'];
                echo '<option ' . ($user['major'] === $name ? 'selected ' : '') . 'value="'. $name .'">'. $name .'</option>';
              }
?>
            </optgroup>
            </select>

            <br>
            <p class="message">Year:</p>
            <select form="profile" id="profile_input_year" name="year" value="<?php echo $user['year'];?>" required>
            <optgroup label="Class">
<?php
                for ($i = 0; $i <= 4; $i++) {
                    echo '<option ' . ($user['year'] === $i ? 'selected ' : '') . "value=\"$i\">" . Utils::year($i) . '</option>';
                }
?>
            </optgroup>
            </select>

            <p class="message">T-Shirt Size:</p>
            <select form="profile" id="profile_input_tsize" name="t_size" selected="<?php echo Utils::t_size($user['t_size']);?>" required>
                <optgroup label="T-Shirt Size">
<?php
                    for ($i = 0; $i <= 4; $i++) {
                        echo '<option ' . ($user['t_size'] === $i ? 'selected ' : '') . "value=\"$i\">" . Utils::t_size($i) . '</option>';
                    }
?>
                </optgroup>
            </select>
<?php
			if (Utils::currentUserAdmin())
			{
?>
				<input form="profile" type="checkbox" name="mentor", value=""> Mentor<br/>
				<input form="profile" type="checkbox" name="admin",  value=""> Admin<br/>
<?php
			}
?>
            <input class="profile_button" form="profile" type="submit" name="submit" value="Save"/>
        </div>
<?php
    } else {
        echo "<img src=\"$image\" />";
        echo '<center><h3>'. $user['name'] . ($user['admin'] ? ' (Admin)' : '') . '</h3></center>';
        $email = $user['email'];
        echo 'Email: ' . $email;
        if ($email !== $user['preferred_email']) {
            echo '<br>Preferred: ' . $user['preferred_email'];
        }
        echo '<br>Major: ' . $user['major'];
        echo '<br>Year: ' . Utils::year($user['year']);
        echo '<br>T-Shirt Size: ' . Utils::t_size($user['t_size']);

        $url = strtok($_SERVER['REQUEST_URI'], '?') . '?edit';
        if (isset($_GET['user'])) {
            $url = $url . '&user=' . $_GET['user'];
        }
?>
        <br>
<?php
		if ($user === $currentuser || Utils::currentUserAdmin()) {
?>
			<div id="profile_buttons">
				<a class="button profile_button" href="<?php echo $url; ?>">Edit Profile</a>
			</div>
<?php
		}
    }
  ?>
</div>
<div id="right_column">
  <div id="bio">
    <h3> Bio </h3><hr/>
    <p>
      <?php
        if ($edit) {
?>
            <textarea form="profile" id="profile_input_bio" rows="0" cols="0" name="bio"><?php echo $user['bio']; ?></textarea>
            <script src="jquery-3.1.0.min.js"></script>
            <!-- death to package managers -->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
            <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
            <script>
                var simplemde = new SimpleMDE();
            </script>
<?php
        } else {
            $parser = Parsedown::instance();
            echo $parser->text($user['bio']);
        }
      ?>
    </p>
  </div>
    <div id = "gullcode">
      <h3> Gullcode </h3><hr/>
      <center>
      <?php
        $userteam = $db->where('id', $user['id'])->getOne('gullcode_users_on_teams');
        if ($userteam) {
          $team = $db->where('team_id', $userteam['team_id'])->getOne('gullcode_teams');
          if ($team) {
            echo "You are on team \"$team[team_name]\"";
          } else {
            echo "Error, no team found!";
          }
        } else {
          echo "You are not on a team";
        }
      ?>
      </center>
    </div>
    <div id = "mathchallenge">
      <h3> Math Challenge </h3><hr/>
      <center>
      <?php
        $userteam = $db->where('id', $user['id'])->getOne('math_challenge_users_on_teams');
        if ($userteam) {
          $team = $db->where('team_id', $userteam['team_id'])->getOne('math_challenge_teams');
          if ($team) {
            echo "You are on team \"$team[team_name]\"";
          } else {
            echo "Error, no team found!";
          }
        } else {
          echo "You are not on a team";
        }
      ?>
      </center>
    </div>
</div>

</div>
</div>

</body>

</html>
