<?php
session_start();
$error = isset($_SESSION['error']) ? $_SESSION['error'] : "";
unset($_SESSION['error']); // Clear the error message after retrieving it
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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="styles.css" />
</head>
<body style="height: 100%; background: #121212;">
    <?php include("./header.php"); ?>
    <section class="ent-back" style="background-image: url('https://images.unsplash.com/photo-1532635241-17e820acc59f?q=80&w=1415&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');">
        <div class="ent-signup-content">
            <div class="ent-signup-back">
            <?php if (!empty($error)) : ?>
                        <div class="error-message"><div><?php echo $error; ?>!!!</div></div>
                    <?php endif; ?>
                <div class="ent-heading">Local Council Sign In</div>
                <form action="process_lc_login.php" method="post" class="ent-form">
                    <div for="email" class="ent-form-div">Email:</div>
                    <input type="email" name="email" required class="ent-form-input" placeholder="Enter email address">
                    
                    <div for="password" class="ent-form-div">Password:</div>
                    <input type="password" name="password" required class="ent-form-input" placeholder="Enter password">
                    
                    <div style="display: flex; justify-content: center;">
                        <input type="submit" value="Sign In" class="ent-signup-btn">
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>
</html>
