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
            $query = "SELECT * FROM users WHERE username='$this->username'";
            $result = mysqli_query($this->connect(), $query);
            $user = mysqli_fetch_assoc($result);
            if (password_verify($this->password, $user['password'])) {
                return true;
            }
            else {
                  return false;
            }
    }
}