<?php 
    function connection(){

        $conn = mysqli_connect("localhost", "root", "", "novelNook");
        if (mysqli_connect_error()) {
            echo 'Error: Could not connect to database. Please try again later';
            exit;
        }
        return $conn;
    }

?>