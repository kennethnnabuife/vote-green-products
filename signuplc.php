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
    <title>Local Council Signup</title>
    <link rel="icon" type="image/png" href="https://htmlcolorcodes.com/assets/images/colors/green-color-solid-background-1920x1080.png">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="styles.css" />
  </head>
  <body>
    <?php include("./header.php"); ?>
    <section class="ent-back" style="background-image: url('https://images.unsplash.com/photo-1492538368677-f6e0afe31dcc?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');">
      <div class="ent-signup-content">
        <div class="ent-signup-back">
        <?php if (!empty($error)) : ?>
                        <div class="error-message"><div><?php echo $error; ?>!!!</div></div>
                    <?php endif; ?>
          <div class="ent-heading">Local Council Signup</div>
          <form method="post" action="process_lc_signup.php" class="ent-form" onsubmit="return validateForm()">
            <div for="council_name" class="ent-form-div">Council Name:</div>
            <input type="text" id="council_name" placeholder="Enter council name" name="council_name" required class="ent-form-input" />

            <div for="council_area" class="ent-form-div">Council Area:</div>
            <input type="text" id="council_area" placeholder="Enter council area" name="council_area" required class="ent-form-input" />

            <div for="email" class="ent-form-div">Email:</div>
            <input type="email" id="email" name="email" required placeholder="Enter email address" class="ent-form-input" />

            <div for="password" class="ent-form-div">Password:</div>
            <input type="password" id="password" name="password" required placeholder="Enter password" class="ent-form-input" />

            <div for="phone_number" class="ent-form-div">Phone Number:</div>
            <input type="tel" id="phone_number" name="phone_number" required placeholder="Enter phone number" class="ent-form-input" />

            <div style="display: flex; justify-content: center">
              <input type="submit" value="Submit" class="ent-signup-btn" />
            </div>
          </form>
        </div>
      </div>
    </section>

    <script>
      function validateForm() {
        // Retrieve form inputs
        let councilName = document.getElementById("council_name").value;
        let councilArea = document.getElementById("council_area").value;
        let email = document.getElementById("email").value;
        let password = document.getElementById("password").value;
        let phoneNumber = document.getElementById("phone_number").value;

        // Check if all required fields are filled out
        if (!councilName || !councilArea || !email || !password || !phoneNumber) {
          alert("All fields are required");
          return false; // Prevent form submission
        }

        return true; // Allow form submission
      }
    </script>
  </body>
</html>
