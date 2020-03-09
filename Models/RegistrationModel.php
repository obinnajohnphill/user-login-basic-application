<?php

require_once('DatabaseConnection.php');

class RegistrationModel
{
    protected $username;
    protected $password;
    protected $password_1;
    protected $email;
    protected $db;


    function __construct($username,$password,$email,$db) {
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->db = $db;
        $this->check_account();
    }

    function check_account(){
      // first check the database to make sure
      // a user does not already exist with the same username and/or email
      $user_check_query = "SELECT * FROM users WHERE username='$this->username' OR email='$this->email' LIMIT 1";
      $result = mysqli_query($this->db, $user_check_query);
      $user = mysqli_fetch_assoc($result);
      return  $user;
    }

    function create_account(){
        $this->password = md5($this->password_1);//encrypt the password before saving in the database
        $query = "INSERT INTO users (username, email, password) VALUES('$this->username', '$this->email', '$this->password')";
        mysqli_query($this->db, $query);
        $_SESSION['username'] = $this->username;
        $_SESSION['success'] = "You are now logged in";
        header('/');
     }
}