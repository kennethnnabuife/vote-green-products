<?php include("../connection.php");

$company_id = $_SESSION['compid'];

// Query to fetch products of a specific company with vote count
$query = "SELECT p.*, 
                 SUM(CASE WHEN v.vote = 'Yes' THEN 1 ELSE 0 END) AS yes_votes 
          FROM ecofriendlyproducts p 
          LEFT JOIN votes v ON p.product_id = v.product_id 
          WHERE p.company_id = $company_id 
          GROUP BY p.product_id 
          ORDER BY yes_votes DESC";

// Execute the query
$result = mysqli_query($conn, $query);

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
        $yes_votes = $row['yes_votes'];

        $image_src = "data:image/$image_type;base64,base64_encode($image_data)";
        
        // Display product details
        echo "<div class='prod-content'>";

            // Display image if available
            if($image_data !== null) {
                $base64_image = base64_encode($image_data);
                $image_src = "data:image/$image_type;base64,$base64_image";
                echo "<img src='$image_src' alt='$product_name' class='prod-img'>";
            }
            echo "<div class='prod-name'>$product_name</div>";
            echo "<div class='prod-description'>Description: $description</div>";
            echo "<div class='prod-size'>Size: $size</div>";
            echo "<div class='prod-pricing'>Pricing: $pricing</div>";
            echo "<div class='prod-name'>Yes Votes: $yes_votes</div>";
        
        // Display other product details as needed
        echo "</div>";
    }
} else {
    echo "No products found for this company.";
}

// Close the database conn
mysqli_close($conn);
?>
