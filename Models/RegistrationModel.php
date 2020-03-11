<?php


class RegistrationModel extends DatabaseConnection
{
/**
 * Registration Model holds the login business logic (data processes)
 *
 * @var string $username
 * @var string $password
 *
 */
    protected $username;
    protected $password;
    protected $email;

/**
 * Instantiates db connect
 * @param $username
 * @param $password
 * @param $email
 *
 */
    function __construct($username,$password,$email) {
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->check_account();
    }

/**
 * Checks uer already exist in database
 */
    function check_account(){
      // first check the database to make sure
      // a user does not already exist with the same username and/or email
      $user_check_query = "SELECT * FROM users WHERE username='$this->username' OR email='$this->email' LIMIT 1";
      $result = mysqli_query($this->connect(), $user_check_query);
      $user = mysqli_fetch_assoc($result);
      return  $user;
    }

/**
 * Creates a new user and log user in automatically
 */
    function create_account(){
        $options = [
            'cost' => 16,
        ];
        $password =  password_hash($this->password, PASSWORD_BCRYPT, $options);
        $query = "INSERT INTO users (username, email, password) VALUES('$this->username', '$this->email', '$password')";
        mysqli_query($this->connect(), $query);
        $_SESSION['username'] = $this->username;
        $_SESSION['success'] = "You are now logged in";
        header('/');
     }
}