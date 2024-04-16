<?php
include("connection.php");
session_start(); // Start session

// Retrieve form data
$company_name = $_POST['company_name'];
$email = $_POST['email'];
$password = $_POST['password'];
$phone_number = $_POST['phone_number'];
$short_description = $_POST['short_description'];

// Sanitize input data
$company_name = mysqli_real_escape_string($conn, $company_name);
$email = mysqli_real_escape_string($conn, $email);
$password = mysqli_real_escape_string($conn, $password);
$phone_number = mysqli_real_escape_string($conn, $phone_number);
$short_description = mysqli_real_escape_string($conn, $short_description);

// Check if email already exists
$email_check_query = "SELECT * FROM greencompanies WHERE email='$email' LIMIT 1";
$result = mysqli_query($conn, $email_check_query);
$user = mysqli_fetch_assoc($result);

if ($user) { // If email exists
    if ($user['email'] === $email) {
        $_SESSION['error'] = "Email already exists"; // Set error message
        header('Location: signupent.php?error=1'); // Redirect back to signup page with error parameter
        exit();
    }
}

// Construct SQL INSERT statement
$sql = "INSERT INTO greencompanies (company_name, email, password, phone_number, short_description) 
        VALUES ('$company_name', '$email', '$password', '$phone_number', '$short_description')";

// Execute INSERT statement
if ($conn->query($sql) === TRUE) {
    // Fetch the company_id based on the inserted company_name
    $select_sql = "SELECT company_id FROM greencompanies WHERE company_name = '$company_name'";
    $result = $conn->query($select_sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $company_id = $row['company_id']; // Get the company_id from the result
        $_SESSION['compid'] = $company_id; // Store company_id in session
    }
    
    // Close database connection
    $conn->close();

    // Redirect to another page
    header("Location: enterprise/dashboard.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close database connection
$conn->close();
?>
