<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    // Include database connection
    include 'connection.php';

    // Check if resident_id is set in the session
    if(isset($_SESSION['resident_id'])) {
        $resident_id = $_SESSION['resident_id'];

        // Check if product_id and vote are set
        if(isset($_POST['vote'])) {
            $product_id = $_POST['product_id'];
            $vote = $_POST['vote'];
            
            // Sanitize inputs
            $resident_id = mysqli_real_escape_string($conn, $resident_id);
            $product_id = mysqli_real_escape_string($conn, $product_id);
            $vote = mysqli_real_escape_string($conn, $vote);
            
            // Check if the resident has already voted for this product
            $query = "SELECT vote FROM votes WHERE resident_id = '$resident_id' AND product_id = '$product_id'";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $previous_vote = $row['vote'] ?? null;
            
            if ($previous_vote === $vote) {
                // Resident is trying to vote the same as before, do nothing
            } elseif ($previous_vote !== null) {
                // Resident is changing their vote, update the vote
                $query = "UPDATE votes SET vote = '$vote' WHERE resident_id = '$resident_id' AND product_id = '$product_id'";
                $result = mysqli_query($conn, $query);
            } else {
                // Resident is voting for the first time, insert the vote
                $query = "INSERT INTO votes (resident_id, product_id, vote) VALUES ('$resident_id', '$product_id', '$vote')";
                $result = mysqli_query($conn, $query);
            }

            // Handle reset vote request
            if ($vote === 'Reset') {
                // Delete the resident's vote for this product
                $query = "DELETE FROM votes WHERE resident_id = '$resident_id' AND product_id = '$product_id'";
                $result = mysqli_query($conn, $query);
                
                if ($result) {
                    // Redirect back to the products page after vote reset
                    echo "<script>window.location = '{$_SERVER['PHP_SELF']}';</script>";
                    exit();
                } else {
                    echo 'Failed to reset vote. Please try again.';
                }
            } else {
                // Redirect back to the products page after vote submission or update
                echo "<script>window.location = '{$_SERVER['PHP_SELF']}';</script>";
                exit(); // Terminate script execution after redirection
            }
        }

        // Query to fetch all products with vote counts and company information, ordered by highest "Yes" votes
        $query = "SELECT p.*, c.company_name,
                         COUNT(CASE WHEN v.vote = 'Yes' THEN 1 END) AS yes_votes, 
                         COUNT(CASE WHEN v.vote = 'No' THEN 1 END) AS no_votes 
                  FROM ecofriendlyproducts p 
                  LEFT JOIN votes v ON p.product_id = v.product_id 
                  LEFT JOIN greencompanies c ON p.company_id = c.company_id 
                  GROUP BY p.product_id
                  ORDER BY yes_votes DESC";
        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $product_id = $row['product_id'];
                $product_name = $row['product_name'];
                $description = $row['description'];
                $size = $row['size'];
                $pricing = $row['pricing'];
                $image_data = $row['image_data'];
                $image_type = $row['image_type'];
                $company_name = $row['company_name'];
                $yes_votes = $row['yes_votes'];
                $no_votes = $row['no_votes'];

                // Check if the user has previously voted for this product
                $user_vote_query = "SELECT vote FROM votes WHERE resident_id = '$resident_id' AND product_id = '$product_id'";
                $user_vote_result = mysqli_query($conn, $user_vote_query);
                $user_vote_row = mysqli_fetch_assoc($user_vote_result);
                $user_vote = $user_vote_row['vote'] ?? null;

                // Determine button colors based on user's previous vote
                $yes_button_color = ($user_vote === 'Yes') ? 'green' : '';
                $no_button_color = ($user_vote === 'No') ? 'red' : '';

                $image_src = "data:image/$image_type;base64," . base64_encode($image_data);

                echo "<div class='prod-content'>";
                if($image_data !== null) {
                    echo "<img src='$image_src' alt='$product_name' class='prod-img'>";
                }
                echo "<div class='prod-name'>$product_name</div>";
                echo "<div class='prod-description'>Description: $description</div>";
                echo "<div class='prod-size'>Size: $size</div>";
                echo "<div class='prod-pricing'>Pricing: $pricing</div>";
                echo "<div class='prod-comp-name'>Posted by: $company_name</div>"; // Display the company name
                echo "<div class='vote'>Vote: $yes_votes Yes / $no_votes No</div>"; // Display number of "Yes" and "No" votes
                echo "<form method='POST' action='{$_SERVER['PHP_SELF']}' onsubmit='return redirectToSelf()'>";
                echo "<div class='vote-logic'>";
                echo "<input type='hidden' name='product_id' value='$product_id'  >";
                echo "<button type='submit' name='vote' value='Yes' style='background-color: $yes_button_color;' class='yes-but'>Yes</button>";
                echo "<button type='submit' name='vote' value='No' style='background-color: $no_button_color;'class='yes-but'>No</button>";
                echo "</div>";
                echo "<div style='width: 200px; justify-content: center; align-items: center;display: flex;'><button type='submit' name='vote' value='Reset' class='reset-btn'>Withdraw</button></div>"; // Button to reset vote
                echo "</form>";
                echo "</div>";
            }
        } else {
            echo "No products found.";
        }

        // Close the database connection
        mysqli_close($conn);
    } else {
        echo 'Error: Resident ID not set in session.';
    }
?>

<script>
function redirectToSelf() {
    // Perform any necessary actions before redirection
    return true; // Return true to allow form submission
}
</script>
