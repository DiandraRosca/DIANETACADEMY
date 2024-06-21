<?php
include 'db_connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM courses WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(['status' => 'success', 'message' => 'Curs șters cu succes!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Eroare la ștergerea cursului: ' . $conn->error]);
    }

    $conn->close();
}
?>
