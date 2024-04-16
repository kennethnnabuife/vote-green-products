<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "votegree_ken";
$password = "Kenreg123#";
$dbname = "votegree_registration";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Output JavaScript code to log message to console
//echo "<script>console.log('Connected successfully');</script>";
?>