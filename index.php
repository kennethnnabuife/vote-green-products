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
  <style>
    body {
      background: #121212;
      margin: 0;
      padding: 0;
    }

    .content-wrapper {
      position: relative;
      z-index: 1; /* Ensure the content is above the blurred overlay */
    }

    .blur-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.8);
      z-index: 999; /* Lower z-index to place it below the content */
      display: none;
      justify-content: center;
      align-items: center;
    }

    .blur-message {
      font-family: 'Poppins', sans-serif;
      color: #fff;
      font-size: 24px;
      text-align: center;
    }

    @media (max-width: 768px) {
      .blur-overlay {
        display: flex;
      }

      .content-wrapper {
        filter: blur(5px);
      }
    }
  </style>
</head>

<body>
  <div class="content-wrapper">
    <?php include("./header.php");?>

    <section class="hero">
      <div class="hero-content">
        <div class="upper-hero">
          <div class="upper-hero-text">Welcome to</div>
          <div class="upper-hero-text2">Vote Green Products!</div>
          <div class="motto">A voting platform aimed at connecting environmentally conscious consumers with<br/>businesses offering
            <span class="greener">green</span> products and services.</div>
        </div>
      </div>
    </section>

    <section class="signup-area">
      <a href="signupent.php" class="enterprise-signup">Sign up as an Eco-Friendly Enterprise</a>
      <div class="middle-bar"></div>
      <a href="signupcons.php" class="enterprise-signup">Sign up as an Eco Consumer</a>
      <!--<a href="signuplc.php" class="enterprise-signup">Sign up as Local Council</a>-->
    </section>
  </div>

  <div class="blur-overlay">
    <div class="blur-message">This website can only be viewed on desktop.</div>
  </div>

</body>
</html>
