<?php
include("connection.php");
session_start(); // Start session

// Retrieve values from the signup form
$council_name = $_POST['council_name'];
$council_area = $_POST['council_area'];
$email = $_POST['email'];
$password = $_POST['password'];
$phone_number = $_POST['phone_number'];

// Sanitize input data
$council_name = mysqli_real_escape_string($conn, $council_name);
$council_area = mysqli_real_escape_string($conn, $council_area);
$email = mysqli_real_escape_string($conn, $email);
$password = mysqli_real_escape_string($conn, $password);
$phone_number = mysqli_real_escape_string($conn, $phone_number);

// Check if email already exists
$email_check_query = "SELECT * FROM localcouncils WHERE email='$email' LIMIT 1";
$result = mysqli_query($conn, $email_check_query);
$user = mysqli_fetch_assoc($result);

if ($user) { // If email exists
    if ($user['email'] === $email) {
        $_SESSION['error'] = "Email already exists"; // Set error message
        header('Location: signuplc.php?error=1'); // Redirect back to signup page with error parameter
        exit();
    }
}

// Perform the SQL query to insert data into the LocalCouncils table
$sql = "INSERT INTO localcouncils (council_name, council_area, email, password, phone_number)
        VALUES ('$council_name', '$council_area', '$email', '$password', '$phone_number')";

// Execute the query
if (mysqli_query($conn, $sql)) {
    // Fetch the council_id based on the inserted council_name
    $select_sql = "SELECT council_id FROM localcouncils WHERE council_name = '$council_name'";
    $result = mysqli_query($conn, $select_sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $council_id = $row['council_id']; // Get the council_id from the result
        $_SESSION['council_id'] = $council_id; // Store council_id in session
    }
    // Redirect to another page
    header("Location: localcouncil/dashboard.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
mysqli_close($conn);
?>
