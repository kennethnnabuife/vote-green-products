<?php include("connection.php"); 
session_start(); // Start session
// Perform the SQL query to retrieve unique locations from the LocalCouncils table
$sql = "SELECT DISTINCT council_area FROM localcouncils";

// Execute the query
$result = mysqli_query($conn, $sql);

// Check if there are any results
if (mysqli_num_rows($result) > 0) {
    // Output options for each location
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<option value='" . $row['council_area'] . "'>" . $row['council_area'] . "</option>";
    }
} else {
    // No locations found
    echo "<option value=''>No locations found</option>";
}

// Close the database connection
mysqli_close($conn);
?>
