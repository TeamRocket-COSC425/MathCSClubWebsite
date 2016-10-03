<?php

require_once('vendor/phpmailer/phpmailer/PHPMailerAutoload.php');
include_once(__DIR__."/../includes/database.php");

/**
 * Class login
 * handles the user's login and logout process
 */
class Login
{

    /**
     * @var array Collection of error messages
     */
    public $errors = array();
    /**
     * @var array Collection of success / neutral messages
     */
    public $messages = array();

    /**
     * the function "__construct()" automatically starts whenever an object of this class is created,
     * you know, when you do "$login = new Login();"
     */
    public function __construct()
    {
        // create/read session, absolutely necessary
        @session_start();

        // check the possible login actions:
        // if user tried to log out (happen when user clicks logout button)
        if (isset($_GET["logout"])) {
            $this->doLogout();
        }
        // login via post data (if user just submitted a login form)
        elseif (isset($_POST["login"])) {
            $this->dologinWithPostData();
        }
        // mark account for reset and email token
        elseif (isset($_POST["reset"])) {
            $this->sendResetLink();
        }
        // validate token and reset password
        elseif (isset($_POST["update_password"])) {
            $this->updatePassword();
        }
    }

    /**
     * log in with post data
     */
    private function dologinWithPostData()
    {
        global $db;

        // check login form contents
        if (empty($_POST['user_email'])) {
            $this->errors[] = "Email field was empty.";
        } elseif (empty($_POST['user_password'])) {
            $this->errors[] = "Password field was empty.";
        } else {

                // Get user with same email
                $cols = array("email", "password");
                $result = $db->where("email", $_POST['user_email'])->getOne("users", null, $cols);

                // if this user exists
                if ($result) {

                    // using PHP 5.5's password_verify() function to check if the provided password fits
                    // the hash of that user's password
                    if (password_verify($_POST['user_password'], $result['password'])) {

                        // write user data into PHP SESSION (a file on your server)
                        $_SESSION['user_email'] = $result['email'];
                        $_SESSION['user_login_status'] = 1;

                    } else {
                        $this->errors[] = "Wrong password. Try again.";
                    }
                } else {
                    $this->errors[] = "This user does not exist.";
                }
        }
    }

    /**
     * perform the logout
     */
    public function doLogout()
    {
        // delete the session of the user
        $_SESSION = array();
        session_destroy();
        // return a little feeedback message
        $this->messages[] = "You have been logged out.";

    }

    public function sendResetLink()
    {
        global $db;

        if (empty($_POST['user_email'])) {
            $this->errors[] = "Email field was empty.";
        } else {

            $user = $db->where("email", $_POST["user_email"])->getOne("users");

            if ($user) {
                // Generate token
                $token = bin2hex(openssl_random_pseudo_bytes(16));

                // Store token in database
                $data = array(
                    'reset_token' => $token
                );
                $db->where('id', $user['id']);
                if ($db->update ('users', $data)) {
                    $this->messages[] = $db->count . ' records were updated';
                } else {
                    $this->errors[] = 'update failed: ' . $db->getLastError();
                }

                // Send email with reset link including token
                $params = array(
                    'email' => $user['preferred_email'],
                    'reset_token' => $token,
                );
                $msg = "Your password reset link is:\n\nhttp://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]?" . http_build_query($params);
                $msg = str_replace('login', 'password_reset', $msg);

                $mail = new PHPMailer;

                $mail->isSMTP();
                $mail->SMTPDebug = 3;
                $mail->Debugoutput = 'html';

                if (getenv('MAILTRAP_API_TOKEN')) {
                  $mail->Host = 'mailtrap.io';
                  $mail->SMTPAuth = true;
                  $mail->Username = 'e3386170e7a765';
                  $mail->Password = 'd8ab29b5c13eb0';
                  $mail->Port = 2525;
                } else {
                  $mail->Host = 'localhost';
                  $mail->Port = 25;
                }

                $mail->setFrom("noreply@sumathcsclub.com", "SU Math/CS Club");
                $mail->addAddress($user['preferred_email']);
                $mail->Subject = "SU Math/CS Club Password Reset";
                $mail->Body = $msg;

                if (!$mail->send()) {
                    $this->errors[] = "Message could not be sent. Error: " . $mail->ErrorInfo;
                } else {
                    $this->messages[] = "Message has been sent.";

                    // Assure this code only runs once
                    header('Location: login?reset');
                    die();
                }

                //mail($user['preferred_email'], "Test", "test");
            } else {
                $this->errors[] = "No user by that email.";
            }
        }
    }

    private function updatePassword()
    {
        if (empty($_POST['user_reset_token'])) {
            $this->errors[] = "No token provided.";
        } elseif (empty($_POST['user_password_new'])) {
            $this->errors[] = "No password given.";
        } elseif (empty($_POST['user_password_repeat'])) {
            $this->errors[] = "No repeat password given.";
        } elseif ($_POST['user_password_new'] != $_POST['user_password_repeat']) {
            $this->errors[] = "Passwords do not match.";
        } else {

            global $db;

            $db->where('reset_token', $_POST['user_reset_token']);
            $user = $db->getOne('users');

            if ($user) {
                $user_password = $_POST['user_password_new'];

                // crypt the user's password with PHP 5.5's password_hash() function, results in a 60 character
                // hash string. the PASSWORD_DEFAULT constant is defined by the PHP 5.5, or if you are using
                // PHP 5.3/5.4, by the password hashing compatibility library
                $user_password_hash = password_hash($user_password, PASSWORD_DEFAULT);

                $data = array( 'password' => $user_password_hash );
                $db->where('id', $user['id']);
                if ($db->update ('users', $data)) {
                    $this->messages[] = $db->count . ' records were updated';

                    // Assure this code only runs once
                    header('Location: login?updated');
                    die();
                } else {
                    $this->errors[] = 'update failed: ' . $db->getLastError();
                }
            } else {
                $this->errors[] = "No user with that token.";
            }
        }
    }

    /**
     * simply return the current state of the user's login
     * @return boolean user's login status
     */
    public function isUserLoggedIn()
    {
        if (isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] == 1) {
            return true;
        }
        // default return
        return false;
    }
}
