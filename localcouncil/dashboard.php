<?php
session_start();

// Check if the session variable is set
if (!isset($_SESSION['council_id'])) {
    // Redirect to the login page or another error page if the session variable is not set
    header("Location: ../signinlc.php");
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
  <body class="ent-back" style="background-image: url('https://images.unsplash.com/photo-1492538368677-f6e0afe31dcc?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'); height: 680px; background-size: cover;">
    <div style="background-color: rgba(0, 0, 0, 0.5); height: 100%;">
    <div class="enterprise-header">
        <a href="dashboard.php" class="ent-dashboard-head">
      Local Council Dashboard
        </a>

      <form method="post" action="../logout.php">
        <input class="logout" id="signup"  name="lclogout" value="Logout" type="submit"/>
      </form>
    </div>
    
    <div style="width: 80%; display: flex; justify-content: center; align-items: center;" class="ent-dashboard-content">
      <a href="prod-by-res.php" class="dash-border">Products Voted<br/>By Your council<br/>Residents</a>
    </div>
    </div>
  </body>
</html>
