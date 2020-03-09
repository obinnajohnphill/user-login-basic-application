<?php

require_once('../Models/DatabaseConnection.php');
require_once('../Models/LoginModel.php');

class LoginController
{
    protected $username;
    protected $password;
    protected $db;

    function __construct()
    {

        $this->username = $_POST['username'];
        $this->password = $_POST['password'];
        $db = new DatabaseConnection();
        $this->db = $db->connect();
        $this->login();
    }

    function login()
    {
        if (isset($_POST['login_user'])) {
            $this->username = mysqli_real_escape_string($this->db, $this->username);
            $this->password = mysqli_real_escape_string($this->db, $this->password);

            $login = new LoginModel($this->username, $this->password, $this->db);
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