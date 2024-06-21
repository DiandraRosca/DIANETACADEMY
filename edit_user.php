<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $sql = "UPDATE users SET username='$username', email='$email', role='$role' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(['status' => 'success', 'message' => 'Utilizator actualizat cu succes!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Eroare la actualizarea utilizatorului: ' . $conn->error]);
    }

    $conn->close();
}
?>
