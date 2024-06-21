<?php
session_start();
include_once "db_connection.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$error = '';
$username = '';
$email = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['username']) || !isset($_POST['password']) || !isset($_POST['email']) || !isset($_POST['arithmetic_answer'])) {
        $error = "Vă rugăm să completați toate câmpurile obligatorii.";
    } else {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $arithmetic_answer = $_POST['arithmetic_answer'];

        // Validate arithmetic answer
        if ($arithmetic_answer != 200) {
            $error = "Răspunsul aritmetic este greșit.";
        } else {
            // Check if the username already exists
            $sql = "SELECT username FROM users WHERE username = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $error = "Numele de utilizator este deja folosit!";
            } else {
                $stmt->close();

                // Check if the email already exists
                $sql = "SELECT email FROM users WHERE email = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $stmt->store_result();

                if ($stmt->num_rows > 0) {
                    $error = "Adresa de email introdusă este deja folosită!";
                } else {
                    $stmt->close();

                    // Generate a unique token
                    $token = bin2hex(random_bytes(16));

                    // Insert the new user into the database with the token
                    $sql = "INSERT INTO users (username, email, password, token, is_active) VALUES (?, ?, ?, ?, 0)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("ssss", $username, $email, $password, $token);

                    if ($stmt->execute() === TRUE) {
                        // Send confirmation email
                        sendConfirmationEmail($email, $token);

                        $_SESSION['success'] = "Contul a fost creat cu success! Verificați emailul pentru a confirma contul.";
                        header("Location: inregistrare.php");
                        exit(); // Ensure no further code is executed after the success message
                    } else {
                        $error = "Oops! Ceva a mers greșit. Vă rugăm încercați mai târziu!";
                    }
                    $stmt->close(); // Close the statement after execution
                }
            }
        }
    }

    if ($error) {
        $_SESSION['error'] = $error;
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        header("Location: inregistrare.php");
        exit();
    }
} else {
    echo "Invalid request method.";
}

function sendConfirmationEmail($email, $token) {
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->CharSet = 'UTF-8'; // Set the character encoding to UTF-8
        $mail->SMTPDebug = 0;                      // Enable verbose debug output
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // Set the SMTP server to send through
        $mail->SMTPAuth   = true;
        $mail->Username   = 'dianetacademytest@gmail.com'; // SMTP username
        $mail->Password   = 'tifr qmwl fnms onjg'; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('dianetacademytest@gmail.com', 'DIA NET ACADEMY');
        $mail->addAddress($email);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Confirmare adresă de email!';
        $mail->Body    = "Vă rugăm să faceți clic pe linkul de mai jos pentru a confirma adresa dvs. de email:<br><a href='http://localhost/confirm.php?token=$token'>Confirmare Adresă Email!</a>";

        $mail->send();
    } catch (Exception $e) {
        // Handle errors here
    }
}
?>
