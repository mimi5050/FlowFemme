<?php
// Database connection parameters
$servername = "p1us8ottbqwio8hv.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
$username = "nv8ts7qnvuhleqhb";
$password = "sf4fgiofbs3n5mol";
$dbname = "qu8h316ipkc2b6nx";
$port = 3306;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo " ";

?>






