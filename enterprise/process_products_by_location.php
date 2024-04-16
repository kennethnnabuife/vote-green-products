<?php include("../connection.php");
$company_id = $_SESSION['compid'];

// Query to fetch products of a specific company with vote count and areas where people voted
$query = "SELECT p.*, 
                 COUNT(CASE WHEN v.vote = 'Yes' THEN 1 END) AS yes_votes,
                 r.location AS vote_location,
                 COUNT(DISTINCT r.resident_id) AS residents_in_area
          FROM ecofriendlyproducts p 
          LEFT JOIN votes v ON p.product_id = v.product_id 
          LEFT JOIN residents r ON v.resident_id = r.resident_id
          WHERE p.company_id = $company_id 
          GROUP BY p.product_id, r.location 
          ORDER BY yes_votes DESC";

// Execute the query
$result = mysqli_query($conn, $query);

// Check if there are any products
if(mysqli_num_rows($result) > 0) {
    // Initialize variables to keep track of product details
    $prev_product_id = null;

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
        $vote_location = $row['vote_location'];
        $residents_in_area = $row['residents_in_area'];

        // Display product details only once for each product
        if ($product_id !== $prev_product_id) {
            // Display product details
            echo "<div class='prod-content'>";

            // Display image if available
            if($image_data !== null) {
                $base64_image = base64_encode($image_data);
                $image_src = "data:image/$image_type;base64,$base64_image";
                echo "<img src='$image_src' alt='$product_name' class='prod-img'>";
            }
            echo "<div class='prod-name'>$product_name</div>";
            echo "<div class='prod-name'>Description: $description</div>";
            echo "<div class='prod-name'>Size: $size</div>";
            echo "<div class='prod-name'>Pricing: $pricing</div>";
            echo "<div class='prod-name'>Yes Votes: $yes_votes</div>";
            
            // Display vote location and count
            echo "<div class='prod-name'>Votes by Location:";
            echo "<ul>";
        }

        // Display vote location and count
        echo "<li>Location: $vote_location (Residents Voted: $residents_in_area)</li>";

        // Update variable for next iteration
        $prev_product_id = $product_id;

        // Close the list and product content if it's the last record for the product
        if ($row = mysqli_fetch_assoc($result)) {
            if ($row['product_id'] !== $product_id) {
                echo "</ul>";
                echo "</div>"; // Close prod-content
            }
            mysqli_data_seek($result, mysqli_num_rows($result) - 1);
        } else {
            echo "</ul>";
            echo "</div>"; // Close prod-content
        }
    }
} else {
    echo "No products found for this company.";
}

// Close the database conn
mysqli_close($conn);
?>