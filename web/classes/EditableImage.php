<?php

require_once 'vendor/autoload.php';
require_once 'classes/Utils.php';
require_once 'classes/EditableContent.php';

class EditableImage extends EditableContent
{
    protected $form_id;
    protected $simple = false;

    public function __construct($id) {
        $this->form_id = "edit_$id";
        parent::__construct($id);
    }

    public function save($content)
    {
        global $db;

        $uploadOk = 1;

        // Make sure we have a new image at all
		if ($_FILES['image']['size'] !== 0) {
			$target_dir = 'images/';

            // Generate a file name based on the md5 hash of the file content
            $target_file = $target_dir . hash_file("md5", $image['tmp_name']) . '.' . $imageFileType;

            $uploadOk = validate_image($_FILES['image']);


			// If we are still good, begin upload process
			if ($uploadOk == 1) {
				if (getenv('S3_BUCKET')) {
					// S3 info available, upload to AWS
					$s3 = Aws\S3\S3Client::factory();
					$bucket = getenv('S3_BUCKET');

					if (!$s3->doesObjectExist($bucket, $target_file)) {
						$upload = $s3->upload($bucket, $target_file, fopen($_FILES['image']['tmp_name'], 'rb'), 'public-read');
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
						if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
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

        return parent::save($content);
    }

    protected function validate_image($image)
    {
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
    }

    public function printText()
    {
        echo $this->text();
    }

    public function printHTML()
    {
        echo "<img id=\"$this->id\" src=\"" . $this->text() . '"/>';
    }

    public function printEditBox()
    {
?>
        <div id="image_upload_wrapper">
        <div id="image_upload_form">
<?php
            if (!$this->simple) {
?>
                <center>
                <h3>
                    Editing "<?php echo $this->id?>":
                </h3>
                </center>
<?php
            }
?>
            <form method="post" action="edit?page=<?php echo $_SERVER['REQUEST_URI']; ?>" id="edit_<?php echo $this->id; ?>" enctype="multipart/form-data">
            </form>
            <img id="edit_image_<?= $this->id ?>" src="<?= $this->text() ?>"/><br>
            <label class="image_upload">
                <input form="<?= $this->form_id ?>" type="file" name="image" value="<?= $this->text() ?>" />
                <i class="fa fa-upload fa-2x" aria-hidden="true"></i>
            </label>
        </div>
        </div>
        <input type="hidden" name="edit_content" value=":D" form="<?= $this->form_id ?>" />
        <input type="hidden" name="edit_id" value="<?php echo $this->id; ?>" form="<?= $this->form_id ?>" />
<?php
        if (!$this->simple) {
?>
            <input id="login_input_submit" type="submit" name="save" value="Save" form="<?= $this->form_id ?>" />
<?php
        }
    }

    public function getDefaultContent()
    {
        return 'images/no-image.jpg';
    }
}
