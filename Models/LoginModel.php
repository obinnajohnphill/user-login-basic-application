<?php


class LoginModel extends DatabaseConnection
{
/**
 * Login Model holds the login business logic (data processes)
 *
 * @var string $username
 * @var string $password
 * *
 */
    protected $username;
    protected $password;

/**
 * Instantiates db connect
 * @param $username
 * @param $password
 *
 */
    function __construct($username,$password) {
        $this->username = $username;
        $this->password = $password;
        $this->check_login();
    }

/**
 * Select user data from db
 */
    function check_login() {
            $password = md5($this->password);
            $query = "SELECT * FROM users WHERE username='$this->username' AND password='$password'";
            $results = mysqli_query($this->connect(), $query);
            if (mysqli_num_rows($results) == 1) {
               return true;
            }else {
              return false;
            }
    }
}