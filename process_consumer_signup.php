<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("connection.php");
session_start(); // Start session

// Retrieve form data
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$phone_number = $_POST['phonenumber'];

// Sanitize input data
$username = mysqli_real_escape_string($conn, $username);
$email = mysqli_real_escape_string($conn, $email);
$password = mysqli_real_escape_string($conn, $password);
$phone_number = mysqli_real_escape_string($conn, $phone_number);

// Check if email already exists
$email_check_query = "SELECT * FROM residents WHERE email='$email' LIMIT 1";
$result = mysqli_query($conn, $email_check_query);
$user = mysqli_fetch_assoc($result);

if ($user) { // If email exists
    if ($user['email'] === $email) {
        $_SESSION['error'] = "Email already exists"; // Set error message
        header('Location: signupcons.php?error=1'); // Redirect back to signup page with error parameter
        exit();
    }
}

// Construct SQL INSERT statement
$sql = "INSERT INTO residents (username, email, password, phone_number) 
        VALUES ('$username', '$email', '$password', '$phone_number')";

// Execute INSERT statement
if ($conn->query($sql) === TRUE) {
    // Fetch the resident_id based on the inserted username
    $select_sql = "SELECT resident_id FROM residents WHERE username = '$username'";
    $result = $conn->query($select_sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $resident_id = $row['resident_id']; // Get the resident_id from the result
        $_SESSION['resident_id'] = $resident_id; // Store resident_id in session
    }
    
    // Close database connection
    $conn->close();

    // Redirect to another page
    header("Location: products.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close database connection
$conn->close();
?>
