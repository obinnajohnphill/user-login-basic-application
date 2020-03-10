<?php

require_once('../Models/DatabaseConnection.php');

class LoginModel
{
    /**
     * Login Model holds the login business logic (data processes)
     *
     * @var string $username
     * @var string $password
     * * @var object $db
     */
    protected $username;
    protected $password;
    protected $db;

    /**
     * Instantiates db connect
     * @param $username
     * @param $password
     * @param $db
     */
    function __construct($username,$password,$db) {
        $this->username = $username;
        $this->password = $password;
        $this->db = $db;
        $this->check_login();
    }

    /**
     * Select user data from db
     */
    function check_login() {
            $password = md5($this->password);
            $query = "SELECT * FROM users WHERE username='$this->username' AND password='$password'";
            $results = mysqli_query($this->db, $query);
            if (mysqli_num_rows($results) == 1) {
               return true;
            }else {
              return false;
            }
    }
}