<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ws310";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["pass"];

    // Query the database to fetch user's hashed password and user_id
    $stmt = $conn->prepare("SELECT user_id, user_pass FROM user_tbl WHERE user_email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($user_id, $hashed_password);
    $stmt->fetch();
    $stmt->close();

    // Verify password using password_verify function
    if (password_verify($password, $hashed_password)) {
        // User authenticated, store user_id in session
        $_SESSION["user_id"] = $user_id;

        // Check if "Remember me" is checked
        if (isset($_POST['remember']) && $_POST['remember'] == 'on') {
            // Generate a random token
            $token = bin2hex(random_bytes(16));

            // Store the token in the database
            $stmt = $conn->prepare("UPDATE user_tbl SET rememberme_token = ? WHERE user_id = ?");
            $stmt->bind_param("si", $token, $user_id);
            $stmt->execute();
            $stmt->close();

            // Set the token as a cookie
            setcookie('remember_me', $token, time() + (86400 * 30), "/"); // 30 days expiration
        }

        header("Location: dash.php");
        exit();
    } else {
        // Invalid credentials, display error message
        $_SESSION["login_error"] = "Invalid email or password. Please try again.";
        header("Location: login.php");
        exit();
    }
}
// Check if remember me cookie exists and automatically log in the user
if (isset($_COOKIE['remember_me'])) {
    $token = $_COOKIE['remember_me'];

    // Query the database to find user by token
    $stmt = $conn->prepare("SELECT user_id FROM user_tbl WHERE rememberme_token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->bind_result($user_id);
    $stmt->fetch();
    $stmt->close();

    if ($user_id) {
        $_SESSION["user_id"] = $user_id;

        // Refresh the remember me cookie expiration time
        setcookie('remember_me', $token, time() + 86400, "/");

        header("Location: dash.php");
        exit();
    }
}

$conn->close();
?>