<?php

require_once('includes/database.php');

class Utils {

    const KEY_ID = 'id';
    const KEY_ADMIN = 'admin';

    const SESSION_KEY_ID = 'user_id';

    const USER_TABLE = 'users';

    public static function getCurrentUser() {
        global $db;

        if (isset($_SESSION[self::SESSION_KEY_ID])) {
            return $db->where(self::KEY_ID, $_SESSION[self::SESSION_KEY_ID])->getOne(self::USER_TABLE);
        } else {
            return null;
        }
    }

    public static function currentUserAdmin() {
        $user = self::getCurrentUser();
        if ($user) {
          return $user[self::KEY_ADMIN] === 1;
        }
        return false;
    }

    public static function editModeEnabled() {
        return self::currentUserAdmin() && isset($_SESSION['edit']) && $_SESSION['edit'];
    }

    public static function getDefaultImageValidator() {
        return function($image) {
            $uploadOk = 1;

            // Grab file extension
            $imageFileType = pathinfo($image['name'], PATHINFO_EXTENSION);
            $allowed_types = array('jpg', 'jpeg', 'png');

            // Make sure the size is valid
            list($width, $height) = getimagesize($image['tmp_name']);
            // Make sure the size is <=1MB
            if ($image['size'] > (1 << 20)) {
                $uploadOk = 0;
                $upload_error_message = "Image is too large. Max size 1MB.";
            }
            // Make sure the file is an image
            if (!in_array($imageFileType, $allowed_types)) {
                $uploadOk = 0;
                $upload_error_message = "Image type \"" . $imageFileType . "\" not allowed. Must be one of " . implode(', ', $allowed_types) . '.';
            }

            return $uploadOk;
        };
    }

    public static function handleImageUpload($name, $image_validator) {

        $content = $name;

        // Make sure we have a new image at all
		if (isset($_FILES[$name]) && $_FILES[$name]['size'] !== 0) {
            $image = $_FILES[$name];

			$target_dir = 'images/';

            // Grab file extension
			$imageFileType = pathinfo($image['name'], PATHINFO_EXTENSION);
            // Generate a file name based on the md5 hash of the file content
            $target_file = $target_dir . hash_file("md5", $image['tmp_name']) . '.' . $imageFileType;

            $uploadOk = $image_validator($image);

			// If we are still good, begin upload process
			if ($uploadOk == 1) {
				if (getenv('S3_BUCKET')) {
					// S3 info available, upload to AWS
					$s3 = Aws\S3\S3Client::factory();
					$bucket = getenv('S3_BUCKET');

					if (!$s3->doesObjectExist($bucket, $target_file)) {
						$upload = $s3->upload($bucket, $target_file, fopen($image['tmp_name'], 'rb'), 'public-read');
                        $content = $upload->get('ObjectURL');
                    } else {
                        $content = $s3->getObjectUrl($bucket, $target_file);
                    }
				} else {
					// Move into uploads folder, we are on local
					$target_file = 'uploads/' . $target_file;

					// If the file already exists, reuse it.
					if (!file_exists($target_file)) {
						// Otherwise, move the tmp file into the real file's location
						if (move_uploaded_file($image["tmp_name"], $target_file)) {
							//echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
						} else {
							$uploadOk = 0;
							$errors[] = "Sorry, there was an error uploading your file.";
						}
					}

					if ($uploadOk == 1) {
						$content = $target_file;
					}
				}
			}

            if ($uploadOk !== 1) {
                return $uploadOk;
            }
		}

        return $content;
    }

    public static function year($id) {
        if ($id == 0)
        {
             $class = 'Freshman';
        }
        if ($id == 1)
        {
            $class = 'Sophomore';
        }
        if ($id == 2)
        {
            $class = 'Junior';
        }
        if ($id == 3)
        {
            $class = 'Senior';
        }

        return $class;
    }

        public static function t_size($id) {
        if ($id == 0)
        {
             $size = 'Small';
        }
        if ($id == 1)
        {
            $size = 'Medium';
        }
        if ($id == 2)
        {
            $size = 'Large';
        }
        if ($id == 3)
        {
            $size = 'X-Large';
        }
        if ($id == 4)
        {
            $size = '2X-Large';
        }

        return $size;
    }
}
?>
