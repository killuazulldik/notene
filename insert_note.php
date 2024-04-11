<?php
// Retrieve form data
$title = $_POST['title'];
$description = $_POST['description'];
$user_id = $_SESSION['user_id']; // Add this line to retrieve the user_id

// Insert data into the database
$sql = "INSERT INTO notes (user_id, title, description, created_at) VALUES (?, ?, ?, NOW())";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iss", $user_id, $title, $description);

if ($stmt->execute()) {
    echo "Note added successfully";
} else {
    echo "Error: " . $stmt->error;
}

if ($stmt->execute()) {
    $response = array(
        "status" => "success",
        "message" => "Note added successfully"
    );
} else {
    $response = array(
        "status" => "error",
        "message" => "Error: " . $stmt->error
    );
}

// Return response as JSON
header('Content-Type: application/json');
echo json_encode($response);

$conn->close();
?>