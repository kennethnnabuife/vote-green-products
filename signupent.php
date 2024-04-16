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
<body>
    <?php include("./header.php"); ?>
    <section class="ent-back">
        <div class="ent-signup-content">
            <div class="ent-signup-back">
              <?php if (!empty($error)) : ?>
                        <div class="error-message"><div><?php echo $error; ?>!!!</div></div>
                    <?php endif; ?>
                <div class="ent-heading">Enterprise Sign Up</div>
                
                <form
                    method="post"
                    action="process_enterprise_signup.php"
                    class="ent-form"
                    onsubmit="return validateForm()"
                >
                    <div for="company_name" class="ent-form-div">Company Name:</div>
                    <input
                        type="text"
                        id="company_name"
                        placeholder="Enter company name"
                        name="company_name"
                        required
                        class="ent-form-input"
                    />

                    <div for="email" class="ent-form-div">Email:</div>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        required
                        placeholder="Enter email address"
                        class="ent-form-input"
                    />

                    <div for="password" class="ent-form-div">Password:</div>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        required
                        placeholder="Enter password"
                        class="ent-form-input"
                    />

                    <div for="phone_number" class="ent-form-div">
                        Contact Information:
                    </div>
                    <input
                        type="text"
                        id="phone_number"
                        name="phone_number"
                        required
                        placeholder="Enter phone (e.g: 07918...)"
                        class="ent-form-input"
                    />

                    <div for="short_description" class="ent-form-div">
                        Short Description (max 150 characters):
                    </div>
                    <textarea
                        id="short_description"
                        name="short_description"
                        rows="3"
                        maxlength="150"
                        required
                        class="ent-form-input"
                    ></textarea>

                    <div style="display: flex; justify-content: center">
                        <input type="submit" value="Sign Up" class="ent-signup-btn" />
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script>
        function validateForm() {
            // Retrieve form inputs
            let companyName = document.getElementById("company_name").value;
            let email = document.getElementById("email").value;
            let password = document.getElementById("password").value;
            let contactInformation = document.getElementById(
                "phone_number"
            ).value;
            let shortDescription = document.getElementById("short_description").value;

            // Check if all required fields are filled out
            if (
                !companyName ||
                !email ||
                !password ||
                !contactInformation ||
                !shortDescription
            ) {
                alert("All fields are required");
                return false; // Prevent form submission
            }

            return true; // Allow form submission
        }
    </script>
</body>
</html>
