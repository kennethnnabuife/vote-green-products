<?php
// Include database connection
include("connection.php");

// Start session
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Sanitize input data
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    // Construct SQL SELECT statement to retrieve user data
    $sql = "SELECT resident_id FROM residents WHERE email = '$email' AND password = '$password'";

    // Execute SELECT statement
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // If user exists, fetch the resident_id
        $row = $result->fetch_assoc();
        $resident_id = $row['resident_id'];

        // Store resident_id in session
        $_SESSION['resident_id'] = $resident_id;

        // Redirect to another page
        header("Location: products.php");
        exit();
    } else {
        $_SESSION['error'] = "Invalid username or password";
        header("Location: signincons.php?error=1");
        exit();
    }
}
?>
