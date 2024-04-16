<?php

// Include the database connection file
include("../connection.php");

// Get the company ID from the session
$company_id = $_SESSION['compid'];

// Query to fetch products of a specific company in reverse order
$query = "SELECT * FROM ecofriendlyproducts WHERE company_id = $company_id ORDER BY product_id DESC";

// Execute the query
$result = mysqli_query($conn, $query);

// Check if the query executed successfully
if ($result) {
    // Check if there are any products
    if(mysqli_num_rows($result) > 0) {
        // Loop through the products
        while($row = mysqli_fetch_assoc($result)) {
            // Access product details
            $product_id = $row['product_id'];
            $product_name = $row['product_name'];
            $description = $row['description'];
            $size = $row['size'];
            $pricing = $row['pricing'];
            $image_data = $row['image_data']; // Assuming image data is stored in the database
            $image_type = $row['image_type']; // Assuming image type is stored in the database

            // Display product details
            echo "<div class='prod-content'>";
            
            // Display image if available
            if($image_data !== null) {
                $image_src = "data:image/$image_type;base64," . base64_encode($image_data);
                echo "<img src='$image_src' alt='$product_name' class='prod-img'>";
            }
            echo "<div class='prod-name'>$product_name</div>";
            echo "<div class='prod-description'>Description: $description</div>";
            echo "<div class='prod-size'>Size: $size</div>";
            echo "<div class='prod-pricing'>Pricing: $pricing</div>";

            // Edit button for each product
            echo "<button class='yes-but' onclick='editProduct($product_id, \"$product_name\", \"$description\", \"$size\", \"$pricing\")'>Edit</button>";
            
            // Delete button for each product
            echo "<form method='post' action='delete_product.php' style='display: inline-block;' >";
            echo "<input type='hidden' name='productId' value='$product_id'>";
            echo "<input type='submit' value='Delete' class='reset-btn' style='width: 80px'>";
            echo "</form>";
            
            // Display other product details as needed
            echo "</div>";
        }
    } else {
        echo "No products found for this company.";
    }
} else {
    // Error in executing the query
    echo "Error: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
