<?php

include_once "db_connection.php";

// Check connection
if ($conn->connect_error) {
    echo json_encode(["status" => "error", "message" => "Connection failed: " . $conn->connect_error]);
    exit();
}

// Form submission handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $discord_id = $_POST["discord_id"];
    $course = $_POST["course"];
    $session_time = $_POST["session_time"];
    $message = $_POST["message"];
    $username = $_POST["username"];

    // Prepare and bind SQL statement
    $sql = "INSERT INTO aplicanti (name, email, phone, discord_id, course, session_time, message, username) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss", $name, $email, $phone, $discord_id, $course, $session_time, $message, $username);

    // Execute the statement
    if ($stmt->execute() === TRUE) {
        echo json_encode(["status" => "success", "message" => "Un aplicant nou a fost adăugat!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error: " . $stmt->error]);
    }

    // Close statement and connection
    $stmt->close();
} else {
    echo json_encode(["status" => "error", "message" => "Metoda Invalidă!"]);
}

$conn->close();
?>
