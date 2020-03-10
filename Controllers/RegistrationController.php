<?php

require_once('../Models/DatabaseConnection.php');
require_once('../Models/RegistrationModel.php');


class RegistrationController
{
    /**
     * Registration Controller holds the registration logic
     *
     * * @var object $db
     */
    protected $db;

    /**
     * Instantiates db connect and calls the register function
     */
    function __construct() {
        $db = new DatabaseConnection();
        $this->db = $db->connect();
        $this->register();
    }

    /**
     * Checks if user exists
     * Creates user account if not
     */
    public function register(){
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

            // Register user does not exist
            if (!$user) {
               $create_account = new RegistrationModel($username,$password_1,$email,$this->db);
               $create_account->create_account();
            }
            return false;

        }

    }


}