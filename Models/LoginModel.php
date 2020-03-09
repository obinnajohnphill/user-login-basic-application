<?php

require_once('Models/DatabaseConnection.php');

class LoginModel
{
    protected $username;
    protected $password;
    protected $errors;
    protected $db;

    function __construct($username,$password,$errors,$db) {
        $this->username = $username;
        $this->password = $password;
        $this->errors = $errors;
        $this->db = $db;

        $this->check_login();
    }

    function check_login() {
        if (count($this->errors) == 0) {
            $this->password = md5($this->password);
            $query = "SELECT * FROM users WHERE username='$this->username' AND password='$this->password'";
            $results = mysqli_query($this->db, $query);
            if (mysqli_num_rows($results) == 1) {
                $_SESSION['username'] = $this->username;
                $_SESSION['success'] = "You are now logged in";
                header('location: index.php');
            }else {
                array_push($errors, "Wrong username/password combination");
            }
        }
    }

}