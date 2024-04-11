<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ws310";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve title and description from form submission
    $title = $_POST['title'];
    $description = $_POST['description'];

    // Insert the note into the database
    $sql = "INSERT INTO notes (user_id, title, description, created_at) VALUES (?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $user_id, $title, $description);

    if ($stmt->execute()) {
        // Note inserted successfully
        echo "Note added successfully";
    } else {
        // Failed to insert note
        echo "Error: " . $conn->error;
    }
}

// Close prepared statement
$conn->close();

// Fetch notes for the logged-in user
$sql = "SELECT * FROM notes WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Close prepared statement
$stmt->close();

?>