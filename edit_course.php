<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $course_name = $_POST['course_name'];
    $language = $_POST['language'];
    $level = $_POST['level'];
    $instructor = $_POST['instructor'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $live_session_days = $_POST['live_session_days'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    $sql = "UPDATE courses SET course_name='$course_name', language='$language', level='$level', instructor='$instructor', start_date='$start_date', end_date='$end_date', live_session_days='$live_session_days', start_time='$start_time', end_time='$end_time' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(['status' => 'success', 'message' => 'Curs actualizat cu succes!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Eroare la actualizarea cursului: ' . $conn->error]);
    }

    $conn->close();
}
?>
