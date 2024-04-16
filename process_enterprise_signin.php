<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("connection.php");
session_start(); // Start session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Sanitize input data
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    // Construct SQL SELECT statement to retrieve user data
    $sql = "SELECT company_id FROM greencompanies WHERE email = '$email' AND password = '$password'";

    // Execute SELECT statement
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // If user exists, fetch the company_id
        $row = $result->fetch_assoc();
        $company_id = $row['company_id'];

        // Store company_id in session
        $_SESSION['compid'] = $company_id;

        // Redirect to another page
        header("Location: enterprise/dashboard.php");
        exit();
    } else {
        $_SESSION['error'] = "Invalid username or password"; // Set error message
        header('Location: signinent.php?error=1'); // Redirect back to signup page with error parameter
        exit();
    }
}
?>
