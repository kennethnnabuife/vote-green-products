<?php
session_start();

// Check if the session variable is set
if (!isset($_SESSION['compid'])) {
    // Redirect to the login page or another error page if the session variable is not set
    header("Location: signinent.php");
    exit();
}

// If the session variable is set, the user is allowed to access the restricted content
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Vote Green Products</title>
    <link
      rel="icon"
      type="image/png"
      href="https://htmlcolorcodes.com/assets/images/colors/green-color-solid-background-1920x1080.png"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="../styles.css" />
  </head>
  <body>
  <div class="enterprise-header">
      <a href="dashboard.php" class="ent-dashboard-head">
        Enterprise Dashboard
      </a>

      <form method="post" action="../logout.php">
        <input class="logout" id="signup"  name="enterpriselogout" value="Logout" type="submit"/>
      </form>
    </div>
    <div class="add-product-body">
      <div class="add-product-content">
        <div id="ent-add-product-head">Add Eco-Friendly Product</div>
        <form
          action="process_add_product.php"
          method="post"
          enctype="multipart/form-data"
          onsubmit="return validateForm()"
        >

          <div for="product_name">Product Name:</div>

          <input
            type="text"
            id="product_name"
            name="product_name"
            required
            class="ent-form-input"
          />

          <div for="description">Description:</div>

          <textarea
            id="description"
            name="description"
            rows="3"
            cols="50"
            required
            class="ent-form-input"
          ></textarea>

          <div for="size">Size:</div>

          <input type="text" id="size" name="size" class="ent-form-input" required/>

          <div for="environmental_benefits">Environmental Benefits:</div>

          <textarea
            id="environmental_benefits"
            name="environmental_benefits"
            rows="3"
            cols="50"
            required
            class="ent-form-input"
          ></textarea>

          <div for="pricing">Pricing:</div>

          <select id="pricing" name="pricing" required>
            <option value="">Select Pricing</option>
            <option value="affordable">Affordable</option>
            <option value="moderate">Moderate</option>
            <option value="premium">Premium</option>
          </select>
          <br />
          <br />

          <div for="product_image">Product Image (max 1MB):</div>

          <input
            type="file"
            id="product_image"
            name="product_image"
            accept="image/*"
            onchange="previewImage(event)"
            required
            class="ent-form-input"
          />

          <div style="display: flex; justify-content: center">
            <img
              id="image-preview"
              class="preview-image"
              src="https://www.generationsforpeace.org/wp-content/uploads/2018/03/empty.jpg"
              alt="Image Preview"
            />
          </div>

          <div style="display: flex; justify-content: center">
            <input type="submit" value="Add Product" class="ent-signup-btn" />
          </div>
        </form>
      </div>
    </div>


    <script>
      function previewImage(event) {
        let reader = new FileReader();
        reader.onload = function () {
          let output = document.getElementById("image-preview");
          output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
      }

      function validateForm() {
        let company_id = document.getElementById("company_id").value;
        let product_name = document.getElementById("product_name").value;
        let description = document.getElementById("description").value;
        let environmental_benefits = document.getElementById(
          "environmental_benefits"
        ).value;
        let pricing = document.getElementById("pricing").value;

        if (
          company_id === "" ||
          product_name === "" ||
          description === "" ||
          environmental_benefits === "" ||
          pricing === ""
        ) {
          alert("Please fill in all fields.");
          return false;
        }
        return true;
      }
    </script>
  </body>
</html>
