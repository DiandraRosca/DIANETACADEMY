<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require 'db_connection.php';

echo "ID-ul utilizatorului din sesiune: " . (isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'Nesetat') . "<br>";

if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'user' || !isset($_SESSION['user_id'])) {
    echo "Redirecționare din cauza unei probleme cu sesiunea.<br>";
    header('Location: autentificare.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Se procesează cererea POST.<br>";
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password !== $confirm_password) {
        die("Parolele noi nu se potrivesc.");
    }

    $stmt = $conn->prepare("SELECT password FROM users WHERE id = ?");
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        if (password_verify($old_password, $hashed_password)) {
            if ($old_password !== $new_password) {
                $new_hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

                $update_stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
                $update_stmt->bind_param("si", $new_hashed_password, $_SESSION['user_id']);
                $update_stmt->execute();

                if ($update_stmt->affected_rows > 0) {
                    echo "Parola a fost actualizată cu succes.<br>";
                } else {
                    echo "Niciun rând actualizat, Eroare SQL: " . $update_stmt->error . "<br>";
                }

                $update_stmt->close();
            } else {
                echo "Parola nouă este identică cu cea veche.<br>";
            }
        } else {
            echo "Verificarea parolei vechi a eșuat.<br>";
        }
        $stmt->close();
    } else {
        echo "Utilizatorul nu a fost găsit în baza de date.<br>";
    }
    $conn->close();
} else {
    echo "Metodă de cerere nevalidă.<br>";
}
?>
