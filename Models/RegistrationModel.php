<?php

require_once('DatabaseConnection.php');

class RegistrationModel
{
    /**
     * Registration Model holds the login business logic (data processes)
     *
     * @var string $username
     * @var string $password
     * * @var object $db
     */
    protected $username;
    protected $password;
    protected $email;
    protected $db;

    /**
     * Instantiates db connect
     * @param $username
     * @param $password
     * @param $email
     * @param $db
     */
    function __construct($username,$password,$email,$db) {
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->db = $db;
        $this->check_account();
    }

    /**
     * Checks uer already exist in database
     */
    function check_account(){
      // first check the database to make sure
      // a user does not already exist with the same username and/or email
      $user_check_query = "SELECT * FROM users WHERE username='$this->username' OR email='$this->email' LIMIT 1";
      $result = mysqli_query($this->db, $user_check_query);
      $user = mysqli_fetch_assoc($result);
      return  $user;
    }

    /**
     * Creates a new user and log user in automatically
     */
    function create_account(){
        $this->password = md5($this->password);//encrypt the password before saving in the database
        $query = "INSERT INTO users (username, email, password) VALUES('$this->username', '$this->email', '$this->password')";
        mysqli_query($this->db, $query);
        $_SESSION['username'] = $this->username;
        $_SESSION['success'] = "You are now logged in";
        header('/');
     }
}