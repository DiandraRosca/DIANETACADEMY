<?php
session_start();

include 'db_connection.php';
include 'mail_config.php';

header('Content-Type: application/json'); // Ensure the response is JSON

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["mail"];
    $phone = $_POST["phone"];
    $discordId = $_POST["discordid"];
    $course = $_POST["course"];
    $sessionTime = $_POST["session_time"];
    $message = $_POST["message"];
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : 'anonymous';

    // Debugging: Log received POST data
    error_log("Received POST data: " . print_r($_POST, true));

    // Prepare and bind SQL statement to fetch course details
    $sql = "SELECT live_session_days, start_time, end_time FROM courses WHERE course_name = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        error_log("Prepare failed: " . $conn->error);
        echo json_encode(["status" => "error", "message" => "Prepare failed: " . $conn->error]);
        exit;
    }
    $stmt->bind_param("s", $course);
    $stmt->execute();
    $stmt->bind_result($liveSessionDays, $startTime, $endTime);
    $stmt->fetch();
    $stmt->close();

    $timeDays = "Zile: $liveSessionDays<br>Oră: $startTime - $endTime";

    // Prepare and bind SQL statement to insert applicant
    $sql = "INSERT INTO aplicanti (name, email, phone, discord_id, course, session_time, message, username) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        error_log("Prepare failed: " . $conn->error);
        echo json_encode(["status" => "error", "message" => "Prepare failed: " . $conn->error]);
        exit;
    }
    $stmt->bind_param("ssssssss", $name, $email, $phone, $discordId, $course, $sessionTime, $message, $username);

    // Execute the statement
    if ($stmt->execute() === TRUE) {
        // Send confirmation email
        $liveSessionLink = "http://localhost/sesiune-live"; // Replace with actual link
        try {
            sendCourseApplicationEmail($email, $course, $timeDays, $liveSessionLink);
            echo json_encode(["status" => "success"]);
        } catch (Exception $e) {
            error_log("Mailer Error: " . $e->getMessage());
            echo json_encode(["status" => "error", "message" => "Mailer Error: " . $e->getMessage()]);
        }
    } else {
        error_log("Execute failed: " . $stmt->error);
        echo json_encode(["status" => "error", "message" => "Execute failed: " . $stmt->error]);
    }

    // Close statement and connection
    $stmt->close();
}

$conn->close();
?>
