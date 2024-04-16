<?php 
// Start the session
session_start();

// Include database connection
include("../connection.php");

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the session variable is set
    if(isset($_SESSION['compid'])) {
        // Get image data from uploaded file
        $imageData = file_get_contents($_FILES['product_image']['tmp_name']);

        // Escape special characters in image data
        $escapedImageData = $conn->real_escape_string($imageData);

        // Get MIME type of the image
        $imageType = $_FILES['product_image']['type'];

        // Get company ID from session storage
        $company_id = $_SESSION['compid'];

        // Set values for other columns
        $product_name = $_POST['product_name'];
        $description = $_POST['description'];
        $size = $_POST['size'];
        $environmental_benefits = $_POST['environmental_benefits'];
        $pricing = $_POST['pricing'];

        // Insert image data into database
        $sql = "INSERT INTO ecofriendlyproducts (company_id, product_name, description, size, environmental_benefits, pricing, image_data, image_type) 
                VALUES ('$company_id', '$product_name', '$description', '$size', '$environmental_benefits', '$pricing', '$escapedImageData', '$imageType')";

        // Execute the SQL query
        if ($conn->query($sql) === TRUE) {
            header('Location: my-products.php'); // Redirect back to signup page with error parameter
            exit();;
        } else {
            echo "<div style='font-size: 30px; font-weight: bold; height: 550px; display: flex; justify-content: center; align-items: center; background-color: #006400; color: #ffffff;'>
            <div style='text-align: center; background-color: #006400; color: #ffffff; padding: 20px;'>Error inserting image: Image cannot be more than 1MB, sorry.<br></div>
            <a style='color: #ffffff; display: block;' href='add-product.php'>Click to Re-attempt</a>
          </div>
          ";
        }
        
                
    } else {
        // Handle case when session variable is not set
        echo "Session variable 'compid' is not set.";
    }
}

// Close connection
$conn->close();
?>
