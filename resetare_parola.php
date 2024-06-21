<?php
include('db_connection.php');

$message = '';
$redirect = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reset-password'])) {
    $token = $_POST['token'];
    $new_password = $_POST['new_password']; // Store the password as plain text

    // Server-side validation for password
    if (!preg_match('/^(?=.*[A-Z])(?=.*[!@#$&*]).{8,}$/', $new_password)) {
        $message = "Parola trebuie să aibă cel puțin 8 caractere, să conțină cel puțin o literă mare și un simbol special (!@#$&*).";
    } else {
        // Validate token without checking expiry
        $query = "SELECT * FROM users WHERE reset_token = ?";
        $stmt = $conn->prepare($query);
        if ($stmt === false) {
            die('Pregătirea a eșuat: ' . htmlspecialchars($conn->error));
        }

        $stmt->bind_param("s", $token);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Update password
            $query = "UPDATE users SET password = ?, reset_token = NULL WHERE reset_token = ?";
            $stmt = $conn->prepare($query);
            if ($stmt === false) {
                die('Pregătirea a eșuat: ' . htmlspecialchars($conn->error));
            }

            $stmt->bind_param("ss", $new_password, $token);
            $stmt->execute();
            $message = "Parola a fost resetată cu succes.";
            $redirect = true;
        } else {
            $message = "Token invalid.";
        }
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
        .custom-error {
            color: red;
            margin-top: 5px;
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
                                            <h3>Resetare Parolă</h3>
                                            <a href="acasa" class="back-button">
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
                                        <?php if (empty($message) || $message == "Token invalid."): ?>
                                            <form id="resetForm" action="resetare_parola.php" method="post">
                                                <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token']); ?>" required>
                                                <span id="passwordError" class="custom-error">Parola trebuie să aibă cel puțin 8 caractere, să conțină cel puțin o literă mare și un simbol special (!@#$&*).</span>
                                                <div class="password-container">
                                                    <input type="password" id="password" name="new_password" placeholder="Introduceți noua parolă" required>
                                                    <span class="toggle-password" onclick="togglePasswordVisibility()">
                                                        <i class="fas fa-eye"></i>
                                                    </span>
                                                </div><br>
                                                <div class="button-container">
                                                    <button type="submit" class="btn mb-3" name="reset-password">Resetare Parolă</button>
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
<script src="js/resetare_parola.js"></script>
<script src="js/login.js"></script>
</body>
</html>
