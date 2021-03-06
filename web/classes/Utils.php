<?php

require_once 'vendor/autoload.php';
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

    public static function sessionCheck($key, $check) {
        return isset($_SESSION[$key]) && $_SESSION[$key] == $check;
    }

    public static function sendMail($from_email, $to_email, $subject, $msg, $cc = [], $from_name = null, $to_name = null, $debug = false) {

        if (getenv('SUMATHCS_PRODUCTION')) {
            $from = new SendGrid\Email($from_name, $from_email);
            $to = new SendGrid\Email($to_name, $to_email);
            $content = new SendGrid\Content("text/plain", $msg);
            $mail = new SendGrid\Mail($from, $subject, $to, $content);

            $apiKey = getenv('SENDGRID_API_KEY');
            $sg = new \SendGrid($apiKey);

            $response = $sg->client->mail()->send()->post($mail);
            if ($response->statusCode() % 100 == 2) {
                return null;
            } else {
                return $response->statusCode() . ": " . $response->body() . "$apiKey";
            }
        } else {
            $mail = new PHPMailer;

            $mail->isSMTP();
            $mail->SMTPDebug = $debug ? 3 : 0;
            $mail->Debugoutput = 'html';

            if (getenv('MAILTRAP_API_TOKEN')) {
                $mail->Host = 'mailtrap.io';
                $mail->SMTPAuth = true;
                $mail->Username = getenv('MAILTRAP_USERNAME');
                $mail->Password = getenv('MAILTRAP_PASSWORD');
                $mail->Port = 2525;
            } else {
                $mail->Host = 'localhost';
                $mail->Port = 25;
            }

            $mail->setFrom($from_email, $from_name);
            $mail->addAddress($to_email, $to_name);
            $mail->Subject = $subject;
            $mail->Body = $msg;

            return $mail->send() ? $mail->ErrorInfo : null;
        }
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

    private static $year_names = ['Freshman', 'Sophomore', 'Juinor', 'Senior'];

    public static function year($id) {
        return $id < 0 ? 'Invalid Year' : $id >= count(self::$year_names) ? 'Super Senior' : self::$year_names[$id];
    }

    private static $tshirt_sizes = ['Small', 'Medium', 'Large', 'X-Large', '2X-Large', '3X-Large'];

    public static function t_size($id) {
        return $id < 0 || $id >= count(self::$tshirt_sizes) ? 'Invalid Size' : self::$tshirt_sizes[$id];
    }
}
?>
