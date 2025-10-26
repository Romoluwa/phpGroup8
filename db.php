<!-- db.php -->
<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "voting_system";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>