<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once 'utils.php';
try {
    $host = "localhost";
    $user = "root";
    $password = "";
    $db = "votingsystem";

    $conn = new mysqli($host, $user, $password, $db);
    //Check connection

} catch (Exception $e) {
    report("Error: " . $e->getMessage());
}
