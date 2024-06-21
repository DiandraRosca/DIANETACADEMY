<?php
include 'db_connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM courses WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $course = $result->fetch_assoc();
        echo json_encode($course);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Cursul nu a fost găsit.']);
    }

    $conn->close();
}
?>
