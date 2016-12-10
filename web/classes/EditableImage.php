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
        $image = Utils::handleImageUpload('image', Utils::getDefaultImageValidator());
        if ($image == 'image') {
            return 1;
        }
        return parent::save($image);
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

    protected function getType() {
        return 'image';
    }
}
