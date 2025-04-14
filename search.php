<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$con = mysqli_connect("localhost", "root", "", "assignment2");
// connecting to the apache server and the databse "assignment2"

if (!$con){
    echo "Error: Could not connect to Database";
}

if ($_SERVER['REQUEST_METHOD'] == 'GET'){

}

?>