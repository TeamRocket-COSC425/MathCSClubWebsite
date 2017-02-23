<?php

class ConfirmBuilder {

    const KEY_TEXT = "confirm_text";
    const KEY_TARGET = "confirm_target";
    const KEY_UID = "confirm_delete";

    public $uid;
    public $confirm_text;
    public $target_loc;

    function __construct($id) {
        $this->uid = $id;
    }

    public function confirmText($txt) {
        $this->confirm_text = $txt;
        return $this;
    }

    public function targetLoc($loc) {
        $this->target_loc = $loc;
        return $this;
    }

    public static function fromPost() {
        return (new ConfirmBuilder($_POST[self::KEY_UID]))->confirmText($_POST[self::KEY_TEXT])->targetLoc($_POST[self::KEY_TARGET]);
    }

    public function getContent($button_text, $button_styles = []) {
?>
        <form id="<?= $this->uid ?>" method="post" action="confirm">
            <input type="hidden" name="<?= self::KEY_UID; ?>" value="<?= $this->uid ?>"/>
            <input type="hidden" name="<?= self::KEY_TARGET; ?>" value="<?= $this->target_loc; ?>"/>
            <input type="hidden" name="<?= self::KEY_TEXT; ?>" value="<?= $this->confirm_text; ?>"/>
            <input type="submit" class="button dangerbutton <?= join(' ', $button_styles); ?>" name="confirm_submit" value="<?= $button_text; ?>"/>
        </form>
<?php
    }
}
