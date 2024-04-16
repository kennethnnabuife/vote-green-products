<?php include("connection.php");
session_start(); // Start session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the login credentials from the form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Sanitize input data
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    // Prepare SQL query to fetch the record corresponding to the provided email
    $sql = "SELECT council_id FROM localcouncils WHERE email='$email' AND password='$password'";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Check if a record with the provided email and password exists
    if (mysqli_num_rows($result) == 1) {
        // Fetch the council_id from the result
        $row = mysqli_fetch_assoc($result);
        $council_id = $row['council_id'];

        // Store council_id in session
        $_SESSION['council_id'] = $council_id;

        // Redirect to dashboard or any other page
        header("Location: localcouncil/dashboard.php");
        exit();
    } else {
        $_SESSION['error'] = "Invalid username or password"; 
        header("Location: signinlc.php?error=1");
        exit();
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
