<html>
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
    <link rel="stylesheet" href="styles.css" />
</head>
<body>
<header class="home-header">
  <div class="logo">
    <a href="index.php" class="logo-text">Vote Green Products</a>
  </div>
  <div style="display: flex">
    <!-- <div class="login">Login</div> -->
    <div class="signup" id="signup" onclick="togglePopup()">Login</div>
  </div>
</header>

<div class="popup" id="popup">
  
  <a href="signinent.php" class="mult-sign">Login as an Enterprise</a>
  <a href="signincons.php" class="mult-sign">Login as a Consumer</a>
  <a href="signinlc.php" class="mult-sign">Login as Local Council</a>
  <div style="width: 100%; display: flex; justify-content: center; margin-top: 20px">
    <div class="close-btn" id="close-btn" onclick="closePopup()">&times;</div>
  </div>
</div>

<script>
  let popup = document.getElementById('popup');

  function togglePopup() {
    if (popup.style.display === 'block') {
      closePopup();
    } else {
      openPopup();
    }
  }

  function openPopup() {
    popup.style.display = 'block';
  }

  function closePopup() {
    popup.style.display = 'none';
  }

  document.addEventListener('DOMContentLoaded', function() {
    function handleClickOutside(event) {
      let isClickInsidePopup = popup.contains(event.target);
      let isClickInsideSignupBtn = document.getElementById('signup').contains(event.target);

      if (!isClickInsidePopup && !isClickInsideSignupBtn) {
        closePopup();
      }
    }

    document.addEventListener('click', handleClickOutside);
  });
</script>

</body>
</html>
