<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $course_name = $_POST["course_name"];
    $language = $_POST["language"];
    $level = $_POST["level"];
    $instructor = $_POST["instructor"];
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];
    $live_session_days = $_POST["live_session_days"];
    $start_time = $_POST["start_time"];
    $end_time = $_POST["end_time"];

    $sql = "INSERT INTO courses (course_name, language, level, instructor, start_date, end_date, live_session_days, start_time, end_time) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssss", $course_name, $language, $level, $instructor, $start_date, $end_date, $live_session_days, $start_time, $end_time);

    if ($stmt->execute() === TRUE) {
        echo json_encode(['status' => 'success', 'message' => 'Cursul a fost adăugat!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Eroare în adăugarea cursului!']);
    }

    $stmt->close();
    $conn->close();
}
?>
