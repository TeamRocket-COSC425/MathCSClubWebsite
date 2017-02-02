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

    public static function fromSession() {
        return (new ConfirmBuilder($_SESSION[self::KEY_UID]))->confirmText($_SESSION[self::KEY_TEXT])->targetLoc($_SESSION[self::KEY_TARGET]);
    }

    public static function flush() {
        unset($_SESSION[self::KEY_UID]);
        unset($_SESSION[self::KEY_TEXT]);
        unset($_SESSION[self::KEY_TARGET]);
    }

    public function getLink() {
        $_SESSION[self::KEY_TEXT] = $this->confirm_text;
        $_SESSION[self::KEY_TARGET] = $this->target_loc;
        $_SESSION[self::KEY_UID] = $this->uid;
        return "confirm";
    }
}
