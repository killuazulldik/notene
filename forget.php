<?php include ('backend/connectiondb.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST["email"];

  // Check if the email exists in the database
  $stmt = $conn->prepare("SELECT user_id FROM user_tbl WHERE user_email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $stmt->store_result();
  $num_rows = $stmt->num_rows; // Store the number of rows

  if ($num_rows > 0) {
    // Generate a new random password
    function generateRandomPassword($length = 8)
    {
      $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
      $password = '';
      for ($i = 0; $i < $length; $i++) {
        $password .= $chars[rand(0, strlen($chars) - 1)];
      }
      return $password;
    }

    $new_password = generateRandomPassword(8);
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Update the password in the database
    $sql = "UPDATE user_tbl SET user_pass = ? WHERE user_email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $hashed_password, $email);
    if ($stmt->execute()) {
      $_SESSION["forget_message"] = "Password reset successfully. <br> New password: <b>$new_password";
    } else {
      $_SESSION["forget_error"] = "Error updating record: " . $conn->error;
    }
    $stmt->close(); // Close the statement after execution
  } else {
    $_SESSION["forget_error"] = "*<b>Email not found!</b> <br>Please enter a valid email address.";
  }

  // Redirect to prevent form resubmission on refresh
  header("Location: forget.php");
  exit();
}

$conn->close(); // Close the database connection
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/registration.css" />
  <style>
    .success-message {
      color: #006100;
    }

    .error-message {
      color: red;
    }
  </style>
</head>

<body>
  <div class="wrapper">
    <h2>Forgot Password</h2>
    <form action="forget.php" method="post">
      <?php if (isset($_SESSION["forget_error"])): ?>
        <div class='error-message'><?php echo $_SESSION["forget_error"]; ?></div>
        <?php unset($_SESSION["forget_error"]); ?>
      <?php endif; ?>
      <?php if (isset($_SESSION["forget_message"])): ?>
        <div class='success-message'><?php echo $_SESSION["forget_message"]; ?></div>
        <?php unset($_SESSION["forget_message"]); ?>
      <?php endif; ?>
      <div class="input-box">
        <input type="email" placeholder="Enter your email" name="email" required />
      </div>
      <div class="input-box button">
        <input type="submit" value="Reset Password" />
      </div>
      <div class="text">
        <h3>Already have an account? <a href="login.php">Login now</a></h3>
      </div>
    </form>
  </div>
</body>

</html>