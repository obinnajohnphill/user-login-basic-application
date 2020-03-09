<?php

require_once('../Models/DatabaseConnection.php');
require_once('../Models/RegistrationModel.php');


class RegistrationController
{
    protected $db;

    function __construct() {
        $db = new DatabaseConnection();
        $this->db = $db->connect();
        $this->register();
    }


    public function register(){
        $errors = array();
        // REGISTER USER
        if (isset($_POST['reg_user'])) {
            // receive all input values from the form
            $username = mysqli_real_escape_string($this->db, $_POST['username']);
            $email = mysqli_real_escape_string($this->db, $_POST['email']);
            $password_1 = mysqli_real_escape_string($this->db, $_POST['password_1']);
            $password_2 = mysqli_real_escape_string($this->db, $_POST['password_2']);

            if ($password_1 != $password_2) {
                array_push($errors, "The two passwords do not match");
            }

            // Call registration model
            $user = new RegistrationModel($username,$password_1,$email,$this->db);
            $user = $user->check_account();

            if ($user) { // if user exists
                if ($user['username'] === $username) {
                    $_SESSION['user_exist'] = "Username already exists";
                    echo  $_SESSION['user_exist']."1";
                    echo '<script type="text/javascript">location.href = \'register.php\';</script>';
                    exit();
                }
                if ($user['email'] === $email) {
                    $_SESSION['user_exist'] = "Email already exists";
                    echo  $_SESSION['user_exist']."2";
                    echo '<script type="text/javascript">location.href = \'register.php\';</script>';
                }
            }

            // Finally, register user does not exist
            if (!$user) {
               $create_account = new RegistrationModel($username,$password_1,$email,$this->db);
               $create_account->create_account();
            }

           return null;

        }

    }


}