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
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Vote Green Products</title>
      <link rel="icon" type="image/png" href="https://htmlcolorcodes.com/assets/images/colors/green-color-solid-background-1920x1080.png">
      <link rel="preconnect" href="https://fonts.googleapis.com" />
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
      <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet"
      />
      <link rel="stylesheet" href="../styles.css" />
  </head>
  <body style="background-image: url('https://images.unsplash.com/photo-1594925397434-b70dbf330ff2?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'); background-size: cover; height: 680px;">
  <div class="ent-dash-content">
  <div class="enterprise-header">
    <a href="dashboard.php" class="ent-dashboard-head">
        Enterprise Dashboard
    </a>
    
    <form method="post" action="../logout.php">
        <input class="logout" id="signup"  name="enterpriselogout" value="Logout" type="submit"/>
    </form>
</div>
    <div class="ent-dashboard-content">
      <a href="add-product.php" class="dash-border">Add Products</a>
      <a href="my-products.php" class="dash-border">Edit Products</a>
      <a href="products-by-votes.php" class="dash-border">Display by<br/> Vote count</a>
    </div>
  </div>
  </body>
</html>
