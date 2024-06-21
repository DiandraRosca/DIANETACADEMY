<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Include Composer's autoloader
include('db_connection.php');

$message = '';
$redirect = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email'])) {
    $email = $_POST['email'];

    // Check if email exists in the database
    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Generate a unique token
        $token = bin2hex(random_bytes(50));

        // Store the token in the database
        $query = "UPDATE users SET reset_token = ? WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $token, $email);
        $stmt->execute();

        // Send reset email
        $reset_link = "http://localhost/resetare_parola?token=$token";

        try {
            $mail = new PHPMailer(true);
            $mail->CharSet = 'UTF-8';
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'dianetacademytest@gmail.com';
            $mail->Password   = 'tifr qmwl fnms onjg';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Recipients
            $mail->setFrom('dianetacademytest@gmail.com', 'Dia Net Academy');
            $mail->addAddress($email);

            // Conținut
            $mail->isHTML(true);
            $mail->Subject = 'Cerere de resetare a parolei';
            $mail->Body    = "Faceți clic pe următorul link pentru a vă reseta parola: <a href='$reset_link'>Resetează Parola!</a>";

            $mail->send();
            $message = "Link-ul de resetare a parolei a fost trimis pe e-mailul dvs.";
            $redirect = true;
        } catch (Exception $e) {
            $message = "Eroare la trimiterea e-mailului de resetare. Eroare Mailer: {$mail->ErrorInfo}";
        }
    } else {
        $message = "Nu a fost găsit niciun cont cu acel e-mail.";
    }
}
?>
<!DOCTYPE html>
<html class="no-js" lang="ro">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Resetare Parolă - DIA NET ACADEMY</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="img/logo/logodia.ico">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.4.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <style>
        .button-container .btn {
            width: 100%;
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
<main>
    <section id="home" class="slider-area slider-four fix p-relative">
        <div class="slider-active">
            <div class="single-slider slider-bg d-flex align-items-center" style="background: url(img/slider/index_img_bg.png) no-repeat; background-size: cover; background-position: center top;">
                <div class="container">
                    <div class="row justify-content-center pt-50">
                        <div class="col-lg-6 col-md-6">
                            <div class="slider-content s-slider-content">
                                <section class="registration-form-section">
                                    <div class="container">
                                        <div class="registration-header">
                                            <h3>Resetare Parolă Utilizator</h3>
                                            <a href="autentificare" class="back-button">
                                                <i class="bi bi-arrow-left"></i>
                                            </a>
                                        </div>
                                        <?php if ($message): ?>
                                            <div class="alert alert-info" role="alert">
                                                <?php echo htmlspecialchars($message); ?>
                                            </div>
                                            <?php if ($redirect): ?>
                                                <div class="alert alert-info" role="alert">
                                                    Veți fi redirecționat către pagina de autentificare în <span id="countdown">2</span> secunde.
                                                </div>
                                                <script>
                                                    var countdownElement = document.getElementById('countdown');
                                                    var countdown = 2;
                                                    setInterval(function() {
                                                        if (countdown > 0) {
                                                            countdown--;
                                                            countdownElement.textContent = countdown;
                                                        } else {
                                                            window.location.href = 'autentificare';
                                                        }
                                                    }, 1000);
                                                </script>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if (empty($message) || strpos($message, 'Eroare') !== false || strpos($message, 'Nu a fost găsit') !== false): ?>
                                            <form action="parola_uitata.php" method="post">
                                                <input type="email" id="forgot-email" name="email" placeholder="Introduce-ți adresa de Email" required><br>
                                                <div class="button-container">
                                                    <button type="submit" class="btn mb-3" name="reset-request">Resetează Parolă</button>
                                                </div>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php include 'utilities/footer.php'; ?>
<script src="js/login.js"></script>
</body>
</html>
