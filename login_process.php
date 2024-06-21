<?php
session_start();
include_once "db_connection.php";

$error = '';
$username = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Preia detaliile utilizatorului din baza de date
    $sql = "SELECT username, password, role, is_active FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($db_username, $db_password, $role, $is_active);
        $stmt->fetch();

        // Verifică dacă utilizatorul și-a confirmat emailul
        if ($is_active == 1) {
            // Validează parola
            if ($password === $db_password) {
                // Parola este corectă, setează variabilele de sesiune
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $db_username;
                $_SESSION['role'] = $role;

                // Generează AuthToken (pentru demonstrație, folosind codificare base64)
                $authToken = base64_encode($db_username . ':' . time());

                // Setează AuthToken în cookie-uri
                setcookie('AuthToken', $authToken, time() + (86400 * 30), "/", "", false, true); // 86400 = 1 zi

                // Redirecționează către pagina corectă în funcție de rol
                if ($role == 'admin') {
                    header("Location: admin_dashboard");
                } else {
                    header("Location: acasa");
                }
                exit();
            } else {
                // Parolă incorectă
                $error = 'Parola introdusă este greșită.';
            }
        } else {
            // Contul nu este activat
            $error = 'Contul dvs. nu a fost confirmat. Vă rugăm să verificați emailul.';
        }
    } else {
        // Utilizatorul nu a fost găsit
        $error = 'Numele de utilizator este greșit.';
    }

    $stmt->close();
    $conn->close();

    if ($error) {
        $_SESSION['error'] = $error;
        $_SESSION['username'] = $username;
        header("Location: autentificare");
        exit();
    }
}
?>
