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
    <title>Document</title>
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
  <body>
  <div class="enterprise-header">
      <a href="dashboard.php" class="ent-dashboard-head">
        Enterprise Dashboard
      </a>

      <form method="post" action="../logout.php">
        <input class="logout" id="signup"  name="enterpriselogout" value="Logout" type="submit"/>
      </form>
    </div>
    <div class="products">
      <!-- Products will be displayed here -->
      <?php include 'process_products_by_location.php'; ?>
    </div>
  </body>
</html>
