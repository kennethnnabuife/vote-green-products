<?php
session_start();

// Check if the session variable is set
if (!isset($_SESSION['compid'])) {
    // Redirect to the login page or another error page if the session variable is not set
    header("Location: ../signinent.php");
    exit();
}

// If the session variable is set, the user is allowed to access the restricted content
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vote Green Products</title>
  <link rel="icon" type="image/png" href="https://htmlcolorcodes.com/assets/images/colors/green-color-solid-background-1920x1080.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../styles.css">
  <style>
    /* Modal styles */
    .modal {
      display: none;
      position: fixed;
      z-index: 1;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0,0,0,0.4);
    }

    .modal-content {
      background-color: #fefefe;
      margin: 20% auto;
      padding: 20px;
      border: 1px solid #888;
      width: 50%;
    }

    .close {
      color: #aaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
    }

    .close:hover,
    .close:focus {
      color: black;
      text-decoration: none;
      cursor: pointer;
    }

    #noProductsMessage {
      display: none;
      text-align: center;
      padding: 20px;
      font-size: 18px;
    }
  </style>
</head>
<body>

<div class="enterprise-header">
  <a href="dashboard.php" class="ent-dashboard-head">
    Enterprise Dashboard
  </a>

  <div>
    <!-- Add a search input field -->
    <input type="text" id="searchInput" placeholder="Search products..." class="product-input-search">

    <!-- Add a dropdown menu for product pricing -->
    <select id="pricingFilter" class="product-input-search">
      <option value="all">All</option>
      <option value="Affordable">Affordable</option>
      <option value="Moderate">Moderate</option>
      <option value="Premium">Premium</option>
    </select>
  </div>

  <form method="post" action="../logout.php">
    <input class="logout" id="signup"  name="enterpriselogout" value="Logout" type="submit"/>
  </form>
</div>

<div class="products">
  <!-- Products will be displayed here -->
  <?php include 'fetch_products.php'; ?>
</div>

<!-- Modal for editing product -->
<div id="editModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeModal()">&times;</span>
    <h2>Edit Product</h2>
    <form id="editForm" method="post" action="update_product.php">
      <!-- Input fields for editing product information -->
      <input type="hidden" id="productId" name="productId">
      <label for="productName">Product Name:</label>
      <input type="text" id="productName" name="productName"><br>
      <label for="description">Description:</label>
      <input type="text" id="description" name="description"><br>
      <label for="size">Size:</label>
      <input type="text" id="size" name="size"><br>
      <label for="pricing">Pricing:</label>
      <input type="text" id="pricing" name="pricing"><br>
      <!-- Submit button to save changes -->
      <input type="submit" value="Save">
    </form>
  </div>
</div>

<!-- Message for no products -->
<div id="noProductsMessage">
  Sorry, no products available here.
</div>

<script>
  function editProduct(productId, productName, description, size, pricing) {
    let modal = document.getElementById("editModal");
    modal.style.display = "block";

    // Reset modal input fields
    document.getElementById("editForm").reset();

    // Set product details in the form fields
    document.getElementById("productId").value = productId;
    document.getElementById("productName").value = productName;
    document.getElementById("description").value = description;
    document.getElementById("size").value = size;
    document.getElementById("pricing").value = pricing;
  }

  function closeModal() {
    let modal = document.getElementById("editModal");
    modal.style.display = "none";
  }

  // Function to filter products based on search input and pricing
  function filterProducts() {
    let input, filter, products, product, productName, pricing, productsFound;
    input = document.getElementById('searchInput');
    filter = input.value.toUpperCase();
    products = document.getElementsByClassName('prod-content');
    pricing = document.getElementById('pricingFilter').value.toUpperCase();
    let noProductsMessage = document.getElementById('noProductsMessage');
    noProductsMessage.style.display = 'none';
    productsFound = false;

    for (let i = 0; i < products.length; i++) {
      product = products[i];
      productName = product.getElementsByClassName('prod-name')[0];
      let pricingText = product.querySelector('.prod-pricing').innerText.toUpperCase();

      if (productName.innerText.toUpperCase().indexOf(filter) > -1 && (pricing === 'ALL' || pricingText.indexOf(pricing) > -1)) {
        product.style.display = '';
        productsFound = true;
      } else {
        product.style.display = 'none';
      }
    }

    // Show no products message if no products found
    if (!productsFound) {
      noProductsMessage.style.display = 'block';
    } else {
      noProductsMessage.style.display = 'none';
    }
  }

  // Add event listeners
  document.getElementById('searchInput').addEventListener('keyup', filterProducts);
  document.getElementById('pricingFilter').addEventListener('change', filterProducts);
</script>

</body>
</html>
