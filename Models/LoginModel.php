<?php

require_once('../Models/DatabaseConnection.php');

class LoginModel
{
    protected $username;
    protected $password;
    protected $errors;
    protected $db;

    function __construct($username,$password,$db) {
        $this->username = $username;
        $this->password = $password;
        $this->db = $db;
        $this->check_login();
    }

    function check_login() {
            $this->password = md5($this->password);
            $query = "SELECT * FROM users WHERE username='$this->username' AND password='$this->password'";
            $results = mysqli_query($this->db, $query);
            if (mysqli_num_rows($results) == 1) {
               return true;
            }else {
              return false;
            }
    }
}