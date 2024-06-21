<?php
session_start();
$error = isset($_SESSION['error']) ? $_SESSION['error'] : '';
$success = isset($_SESSION['success']) ? $_SESSION['success'] : '';
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
unset($_SESSION['error']);
unset($_SESSION['success']);
unset($_SESSION['username']);
unset($_SESSION['email']);
?>
<!DOCTYPE html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Registration - DIA NET ACADEMY</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="img/logo/logodia.ico">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.4.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        .error {
            color: red;
        }
        .success {
            color: green;
        }
        .countdown-text {
            color: black !important; 
            background: none !important; 
            font-weight: bold !important; 
            border: none !important; 
            text-decoration: none !important; 
            display: inline !important; 
            margin: 0; 
            padding: 0;
        }
        .custom-error {
            color: red;
            margin-top: 5px;
            display: none;
        }
    </style>
    <?php if ($success): ?>
        <meta http-equiv="refresh" content="5;url=login.php">
    <?php endif; ?>
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
                                                <h3>Formular Înregistrare</h3>
                                                <a href="acasa" class="back-button">
                                                    <i class="bi bi-arrow-left"></i>
                                                </a>
                                            </div>
                                            <?php if ($success): ?>
                                                <div class="alert alert-success" role="alert">
                                                    <?php echo htmlspecialchars($success); ?>
                                                </div>
                                                <p class="countdown-text">Vei fi redirecționat(ă) spre pagina de autentificare în <span id="seconds" class="countdown-text">5</span></p>
                                            <?php else: ?>
                                                <form id="registerForm" action="register_process.php" method="post">
                                                    <?php if ($error): ?>
                                                        <div class="alert alert-danger" role="alert">
                                                            <?php echo htmlspecialchars($error); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                    <span id="usernameError" class="custom-error">Te rog completează acest câmp.</span>
                                                    <input type="text" id="username" name="username" placeholder="Nume Utilizator" value="<?php echo htmlspecialchars($username); ?>"><br>
                                                    <span id="emailError" class="custom-error">Te rog completează acest câmp.</span>
                                                    <input type="email" id="email" name="email" placeholder="Adresă Email" value="<?php echo htmlspecialchars($email); ?>"><br>
                                                    <span id="passwordError" class="custom-error">Parola trebuie să aibă cel puțin 8 caractere, să conțină cel puțin o literă mare și un simbol special (!@#$&*).</span>
                                                    <div class="password-container">
                                                        <input type="password" id="password" name="password" placeholder="Parolă">
                                                        <span class="toggle-password" onclick="togglePasswordVisibility()">
                                                            <i class="fas fa-eye"></i>
                                                        </span>
                                                    </div><br>
                                                    <span id="arithmeticError" class="custom-error">Te rog completează acest câmp.</span>
                                                    <input type="text" id="arithmetic_answer" name="arithmetic_answer" placeholder="Cât este 100 + 100?"><br>
                                                    <input type="submit" value="Înregistrare">
                                                </form>
                                            <?php endif; ?>
                                            <div id="message" class="error"></div>
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
    <script src="js/vendor/jquery-v3.7.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/register.js"></script>
</body>
</html>
