<?php

require_once('../Models/DatabaseConnection.php');


class LoginController
{
    protected $username;
    protected $password;
    protected $db;

    function __construct() {

       $this->username = $_POST['username'];
       $this->password = $_POST['password'];
       $db = new DatabaseConnection();
       $this->db = $db->connect();
       $this->login();
    }

    function login() {
        if (isset($_POST['login_user'])) {
            $this->username = mysqli_real_escape_string($this->db,  $this->username);
            $this->password = mysqli_real_escape_string($this->db, $this->password );

            if (empty($this->username)) {
                $_SESSION['username_empty'] = "Username is required";
                header('location: login.php');
            }
            if (empty($this->password)) {
                $_SESSION['password_empty']  = "Password is required";
                header('location: login.php');
            }
        }

        return null;

    }
}