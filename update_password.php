<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

include_once "db_connection.php"; // Include your database connection configuration here

// Check if the connection is successful
if ($link->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed: ' . $link->connect_error]);
    exit;
}

$new_password = $_POST['new_password'] ?? '';

if (empty($new_password)) {
    echo json_encode(['success' => false, 'message' => 'Invalid password']);
    exit;
}

// Debugging line: log received new_password
error_log("Received new password: $new_password");

$sql = "UPDATE users SET password = ? WHERE id = ?";
$stmt = $link->prepare($sql);

if ($stmt === false) {
    // Debugging line: log prepare statement error
    error_log("Prepare statement error: " . $link->error);
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $link->error]);
    exit;
}

$stmt->bind_param("si", $new_password, $_SESSION['id']);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    // Debugging line: log SQL error
    error_log("SQL error: " . $stmt->error);
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $stmt->error]);
}

$stmt->close();
$link->close();
?>
