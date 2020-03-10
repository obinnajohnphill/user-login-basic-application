<?php

require_once('../Models/LoginModel.php');

class LoginController extends DatabaseConnection
{
/**
 * Login Controller holds the login logic
 *
 * @var string $username
 * @var string $password
 *
 */
    protected $username;
    protected $password;

/**
 * Instantiates db connect
 */
    function __construct()
    {

        $this->username = $_POST['username'];
        $this->password = $_POST['password'];
        $this->login();
    }

/**
 * Login if user is permitted
 */
    function login()
    {
        if (isset($_POST['login_user'])) {
                $this->username = mysqli_real_escape_string($this->connect(), $this->username);
                $this->password = mysqli_real_escape_string($this->connect(), $this->password);

                $login = new LoginModel($this->username, $this->password);
                $permission = $login->check_login();
                if ($permission) {
                    $_SESSION['username'] = $this->username;
                    $_SESSION['success'] = "You are now logged in";
                    header('/');
                }
                if (!$permission) {
                    $_SESSION['wrong_username_password'] = "Wrong username/password combination";
                    echo '<script type="text/javascript">location.href = \'login.php\';</script>';
                }
            }
            return null;
        }
}