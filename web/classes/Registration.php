<?php

require_once __DIR__."/../includes/database.php";

/**
 * Class registration
 * handles the user registration
 */
class Registration
{
    /**
     * @var array $errors Collection of error messages
     */
    public $errors = array();
    /**
     * @var array $messages Collection of success / neutral messages
     */
    public $messages = array();

    public $registered = false;

    /**
     * the function "__construct()" automatically starts whenever an object of this class is created,
     * you know, when you do "$registration = new Registration();"
     */
    public function __construct()
    {
        if (isset($_POST["register"])) {
            $this->registerNewUser();
        }
    }

    /**
     * handles the entire registration process. checks all error possibilities
     * and creates a new user in the database if everything is fine
     */
    private function registerNewUser()
    {
        if (empty($_POST['user_email'])) {
            $this->errors[] = "Empty Email";
        } elseif (empty($_POST['user_password_new']) || empty($_POST['user_password_repeat'])) {
            $this->errors[] = "Empty Password";
        } elseif ($_POST['user_password_new'] !== $_POST['user_password_repeat']) {
            $this->errors[] = "Password and password repeat are not the same";
        } elseif (strlen($_POST['user_password_new']) < 6) {
            $this->errors[] = "Password has a minimum length of 6 characters";
        } elseif (strlen($_POST['user_email']) > 64) {
            $this->errors[] = "Email cannot be longer than 64 characters";
        } elseif (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = "Your email address is not in a valid email format";
        } else {

            global $db;

                $user_email = strip_tags($_POST['user_email'], ENT_QUOTES);
                $user_password = $_POST['user_password_new'];

                // crypt the user's password with PHP 5.5's password_hash() function, results in a 60 character
                // hash string. the PASSWORD_DEFAULT constant is defined by the PHP 5.5, or if you are using
                // PHP 5.3/5.4, by the password hashing compatibility library
                $user_password_hash = password_hash($user_password, PASSWORD_DEFAULT);

                // Check for existing account
                $db->where('email', $user_email);
                $existing = $db->get('users');

            if (count($existing) > 0) {
                $this->errors = array("Sorry, that username / email address is already taken.", print_r($existing[0]));
            } else {

                $data = array(
                    'email' => $user_email,
                    'preferred_email' => $user_email, //temp
                    'password' => $user_password_hash,
                    'name' => $_POST['user_firstname'] . ' ' . $_POST['user_lastname'],
                    'year' => $_POST['user_year'],
                    'major' => $_POST['user_major']
                );

                // write new user's data into database
                $id = $db->insert('users', $data);

                // if user has been added successfully
                if ($id) {
                    $this->messages[] = "Your account has been created successfully. You can now log in.";
                    $this->registered = true;
                } else {
                    $this->errors[] = $db->getLastError();
                }
            }
        }
    }
}
