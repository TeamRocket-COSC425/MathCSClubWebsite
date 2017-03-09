<?php

require_once __DIR__."/../includes/database.php";
require_once __DIR__. "/Utils.php";

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
    public $confirmed = false;

    /**
     * the function "__construct()" automatically starts whenever an object of this class is created,
     * you know, when you do "$registration = new Registration();"
     */
    public function __construct()
    {
        if (isset($_POST["register"])) {
            $this->registerNewUser();
        } elseif (isset($_GET['user']) && isset($_GET['confirm_token'])) {
            $this->confirmUser();
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
        } elseif( preg_match('/^\S+@(gulls\.)?salisbury\.edu$/i', $_POST['user_email']) !== 1) {
            $this->errors[] = "Email must be from an SU domain.";
        } elseif (empty($_POST['user_id'])) {
            $this->errors[] = "No Student ID provided";
        } elseif (strlen($_POST['user_id']) != 7) {
            $this->errors[] = "Student ID must have a length of 7 characters";
        } else {

            global $db;

            $user_email = strip_tags($_POST['user_email'], ENT_QUOTES);
            $user_password = $_POST['user_password_new'];
            $user_id = $_POST['user_id'];

            // crypt the user's password with PHP 5.5's password_hash() function, results in a 60 character
            // hash string. the PASSWORD_DEFAULT constant is defined by the PHP 5.5, or if you are using
            // PHP 5.3/5.4, by the password hashing compatibility library
            $user_password_hash = password_hash($user_password, PASSWORD_DEFAULT);

            // Check for existing account
            $db->where('email', $user_email);
            $existing = $db->get('users');

            // Check for existing userID
            $db->where('id', $user_id);
            $IDexisting = $db->get('users');

            if (count($existing) > 0) {
                $this->errors = array("Sorry, that username / email address is already taken.", print_r($existing[0]));
            }
            elseif (count($IDexisting) > 0) {
                $this->errors[] = "Student ID is already being used";
            } else {

                $data = array(
                    'id' => $_POST['user_id'],
                    'email' => $user_email,
                    'preferred_email' => $user_email, //temp
                    'password' => $user_password_hash,
                    'name' => $_POST['user_firstname'] . ' ' . $_POST['user_lastname'],
                    'year' => $_POST['user_year'],
                    'major' => $_POST['user_major'],
                    'bio' => "This user has not yet created a bio.",
                    'reset_token' => bin2hex(openssl_random_pseudo_bytes(16))
                );

                // write new user's data into database
                $id = $db->insert('users', $data);

                // if user has been added successfully
                if ($id) {
                    $params = ['user' => $data['id'], 'confirm_token' => $data['reset_token']];
                    $msg = "Welcome to the Salisbury University Math & Computer Science Club! To confirm your account, please click the link below:\n\nhttp://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]?" . http_build_query($params);
                    $err = Utils::sendMail("noreply@sumathcsclub.com", $user_email, "SU Math/CS Club Account Confirm", $msg, [], "SU Math/CS Club");
                    if ($err) {
                        $this->errors[] = $err;
                        $db->where('id', $data['id'])->delete('users');
                    } else {
                        $this->messages[] = "You have been sent a confirmation email. Please click the link to confirm your account.";
                        $this->registered = true;
                    }
                } else {
                    $this->errors[] = $db->getLastError();
                }
            }
        }
    }

    public function confirmUser() {
        global $db;
        $user = $db->where('id', $_GET['user'])->getOne('users');
        if ($user['reset_token'] == $_GET['confirm_token']) {
            $db->where('id', $user['id'])->update('users', ['reset_token' => null, 'confirmed' => 1]);
            $this->confirmed = true;
        }
    }
}
