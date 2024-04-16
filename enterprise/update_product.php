<?php
include("../connection.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $productId = $_POST["productId"];
  $productName = $_POST["productName"];
  $description = $_POST["description"];
  $size = $_POST["size"];
  $pricing = $_POST["pricing"];
  
  // Update query to update product information
  $query = "UPDATE ecofriendlyproducts SET product_name='$productName', description='$description', size='$size', pricing='$pricing' WHERE product_id='$productId'";
  
  if(mysqli_query($conn, $query)) {
    // Redirect to another page
    header("Location: my-products.php");
    exit();
  } else {
    echo "Error updating product: " . mysqli_error($conn);
  }
  
  // Close the database connection
  mysqli_close($conn);
}
?>
