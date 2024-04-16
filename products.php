<?php 
session_start();

// Check if the session variable is set
if (!isset($_SESSION['resident_id'])) {
    // Redirect to the login page or another error page if the session variable is not set
    header("Location: ./signincons.php");
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
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet"
        />
  <link rel="stylesheet" href="./styles.css">
</head>
<body>
<div class="enterprise-header">
  <a href="products.php" class="ent-dashboard-head">
    Vote Green Products
  </a>

  <div>
    <input type="text" id="searchInput" placeholder="Search by product name" class="product-input-search">
    
    <select id="priceFilter" class="product-input-search">
      <option value="">All</option>
      <option value="Affordable">Affordable (Less than £200)</option>
      <option value="Moderate">Moderate (£200 to £1000)</option>
      <option value="Premium">Premium (Over £1000)</option>
    </select>
  </div>

  <form method="post" action="./logout.php">
    <input class="logout" id="signup"  name="residentlogout" value="Logout" type="submit"/>
  </form>
</div>

<div class="products">
  <?php include 'process_products.php'; ?>
</div>

<!-- Message for no products -->
<div id="noProductsMessage" style="display: none;
      text-align: center;
      padding: 20px;
      font-size: 18px;">
  Sorry, no products available here.
</div>

<script>
  // Function to filter products based on search input and price filter
  function filterProducts() {
    let searchInput = document.getElementById('searchInput').value.toLowerCase();
    let priceFilter = document.getElementById('priceFilter').value.toLowerCase();
    let products = document.getElementsByClassName('prod-content');
    let noProductsMessage = document.getElementById('noProductsMessage');

    let productsFound = false;

    for (let i = 0; i < products.length; i++) {
      let productName = products[i].getElementsByClassName('prod-name')[0].innerText.toLowerCase();
      let productDesc = products[i].getElementsByClassName('prod-description')[0].innerText.toLowerCase();
      let pricing = products[i].getElementsByClassName('prod-pricing')[0].innerText.toLowerCase();
      
      // Check if product matches search input and price filter
      let matchesSearch = productName.includes(searchInput);
      let matchesSearchd = productDesc.includes(searchInput);
      let matchesPrice = priceFilter === '' || pricing.includes(priceFilter);

      // Show/hide product based on filter criteria
      if (matchesSearch & matchesPrice) {
        products[i].style.display = '';
        productsFound = true;
      } else {
        products[i].style.display = 'none';
        if (matchesSearchd & matchesPrice) {
        products[i].style.display = '';
        productsFound = true;
      } else {
        products[i].style.display = 'none';
      }
      }
      
    }

    // Show/hide no products message based on products found
    if (productsFound) {
      noProductsMessage.style.display = 'none';
    } else {
      noProductsMessage.style.display = 'block';
    }
  }

  // Add event listeners for search input and price filter
  document.getElementById('searchInput').addEventListener('keyup', filterProducts);
  document.getElementById('priceFilter').addEventListener('change', filterProducts);

  // Initial filter on page load
  filterProducts();
</script>

</body>
</html>
