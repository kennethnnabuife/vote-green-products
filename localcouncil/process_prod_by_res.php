<?php include("../connection.php"); ?>

<?php

$council_id = $_SESSION['council_id'];

// Query to fetch eco-friendly products with vote count by the current council area
$query = "SELECT p.product_id, p.product_name, p.description, p.size, p.pricing, p.image_data, p.image_type,
                 COUNT(v.vote_id) AS vote_count
          FROM ecofriendlyproducts p
          JOIN votes v ON p.product_id = v.product_id
          JOIN residents r ON v.resident_id = r.resident_id
          WHERE r.location = (SELECT council_area FROM localcouncils WHERE council_id = $council_id)
          GROUP BY p.product_id
          ORDER BY vote_count DESC";

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
        $vote_count = $row['vote_count'];

        $image_src = "data:image/$image_type;base64,base64_encode($image_data)";
        
        // Display product details
        echo "<div class='prod-content' >";
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
        echo "<div class='prod-name'>Votes: $vote_count</div>";
        echo "</div>";
    }
} else {
    echo "No eco-friendly products found for your council area.";
}

// Close the database conn
mysqli_close($conn);
?>
