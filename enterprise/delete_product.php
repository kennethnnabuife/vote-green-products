<?php
// Include the database connection file
include("../connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['productId'])) {
    $productId = $_POST['productId'];

    // Delete related records from the `votes` table
    $deleteVotesQuery = "DELETE FROM votes WHERE product_id = $productId";
    if (!mysqli_query($conn, $deleteVotesQuery)) {
        // Error deleting related votes
        echo "Error deleting related votes: " . mysqli_error($conn);
        exit();
    }

    // Now delete the product from the `EcoFriendlyProducts` table
    $deleteProductQuery = "DELETE FROM ecofriendlyproducts WHERE product_id = $productId";
    if (mysqli_query($conn, $deleteProductQuery)) {
        // Product deleted successfully
        header("Location: my-products.php"); // Redirect back to the products page
        exit();
    } else {
        // Error deleting product
        echo "Error deleting product: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
