<?php


class DatabaseConnection
{
    /**
     * Instantiate db connection function
     *
     */
    function __construct() {

        $this->connect();
    }

    /**
     * Create mysqli connection
     *
     */
    function connect() {
        $connect =  mysqli_connect('172.18.0.2', 'homestead', 'secret', 'homestead');
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL Database: " . mysqli_connect_error();
        }else{
            return $connect;
        }
    }
}