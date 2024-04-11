<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ws310";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve form data
  $fname = $_POST["fname"];
  $lname = $_POST["lname"];
  $email = $_POST["email"];
  $uname = $_POST["uname"];
  $pass = $_POST["pass"];

  $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

  $stmt = $conn->prepare("INSERT INTO user_tbl (user_fname, user_lname, user_email, username, user_pass) VALUES (?, ?, ?, ?, ?)");
  $stmt->bind_param("sssss", $fname, $lname, $email, $uname, $hashed_password);

  if ($stmt->execute()) {
    echo "<script>alert('New record inserted successfully'); window.location.href = 'login.php';</script>";
  } else {
    echo "<script>alert('Error: " . $stmt->error . "');</script>";
  }


  // Close statement
  $stmt->close();
}

// Close connection
$conn->close();
?>


<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/registration.css" />
  <link rel="stylesheet" href="css/header.css">
  <script>
    function validateForm() {
      var fname = document.forms["registrationForm"]["fname"].value;
      var lname = document.forms["registrationForm"]["lname"].value;
      var email = document.forms["registrationForm"]["email"].value;
      var uname = document.forms["registrationForm"]["uname"].value;
      var pass = document.forms["registrationForm"]["pass"].value;
      if (fname == "" || lname == "" || email == "" || uname == "" || pass == "") {
        alert("Please fill in all fields.");
        return false;
      }
    }
  </script>
</head>

<body>
  <?php
  include "nav/header.php";
  ?>
  <div class="contianer">



    <div class="wrapper">
      <h2>Registration</h2>
      <form action="registration.php" method="post">
        <div class="input-box">
          <input type="text" placeholder="Enter your first name" name="fname" required />
        </div>
        <div class="input-box">
          <input type="text" placeholder="Enter your last name" name="lname" required />
        </div>
        <div class="input-box">
          <input type="email" placeholder="Enter your email" name="email" required />
        </div>
        <div class="input-box">
          <input type="text" placeholder="Enter your username" name="uname" required />
        </div>
        <div class="input-box">
          <input type="password" placeholder="Create password" name="pass" required />
        </div>
        <div class="input-box button">
          <input type="Submit" value="Register Now" />
        </div>
        <div class="text">
          <h3>Already have an account? <a href="login.php">Login now</a></h3>
        </div>
      </form>
    </div>

  </div>
</body>

</html>