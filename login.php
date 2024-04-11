<?php include ('backend/loginquery.php');
session_start();
?>

<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="css/login.css" />
  <link rel="stylesheet" href="css/header.css">
  <style>
    .error-message {
      color: red;
    }
  </style>
</head>


<body>
  <?php
  include_once "nav/header.php";
  ?>
  <div class="wrapper">
    <div class="title">Login Form</div>

    <form action="login.php" method="post">
      <?php if (isset($_SESSION["login_error"])): ?>
        <div class='error-message'><?php echo $_SESSION["login_error"]; ?></div>
        <?php unset($_SESSION["login_error"]); ?>
      <?php endif; ?>
      <div class="field">
        <input type="text" name="email" required />
        <label>Email Address</label>
      </div>
      <div class="field">
        <input type="password" name="pass" id="password" required />
        <img src="image/eye-close.png" id="eyeicon" alt="">
        <label>Password</label>
      </div>
      <div class="content">
        <div class="checkbox">
          <input type="checkbox" id="remember-me" name="remember" />
          <label for="remember-me">Remember me</label>
        </div>
        <div class="pass-link">
          <a href="forget.php">Forgot password?</a>
        </div>
      </div>
      <div class="field">
        <input type="submit" value="Login" />
      </div>
      <div class="signup-link">
        Not a member? <a href="registration.php">Signup now</a>
      </div>
    </form>
  </div>
  <script>
    let eyeicon = document.getElementById("eyeicon");
    let password = document.getElementById("password");

    eyeicon.onclick = function () {
      if (password.type == "password") {
        password.type = "text";
        eyeicon.src = "image/eye-open.png";
      } else {
        password.type = "password";
        eyeicon.src = "image/eye-close.png";
      }
    }
  </script>
</body>

</html>