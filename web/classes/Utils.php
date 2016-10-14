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
        return self::getCurrentUser()?:[self::KEY_ADMIN] === 1;
    }

    public static function editModeEnabled() {
        return self::currentUserAdmin() && isset($_SESSION['edit']) && $_SESSION['edit'];
    }
}

?>
