<?php
session_start();
$error = isset($_SESSION['error']) ? $_SESSION['error'] : '';
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
unset($_SESSION['error']);
unset($_SESSION['username']);
?>
<!DOCTYPE html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Autentificare - DIA NET ACADEMY</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="img/logo/logodia.ico">
    <link rel="shortcut icon" type="image/x-icon" href="img/logo/logodia.ico">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.4.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <style>
        .button-container .btn {
            width: 100%;
        }

        .parola_uitata{
            padding-top: 10px;
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
                                                <h3>Autentificare</h3>
                                                <a href="acasa" class="back-button">
                                                    <i class="bi bi-arrow-left"></i>
                                                </a>
                                            </div>
                                            <form action="login_process.php" method="post">
                                                <?php if (isset($error) && $error): ?>
                                                    <div class="alert alert-danger" role="alert">
                                                        <?php echo htmlspecialchars($error); ?>
                                                    </div>
                                                <?php endif; ?>
                                                <input type="text" id="username" name="username" required placeholder="Nume Utilizator" value="<?php echo isset($username) ? htmlspecialchars($username) : ''; ?>"><br>
                                                <div class="password-container">
                                                    <input type="password" id="password" name="password" required placeholder="Parolă">
                                                    <span class="toggle-password" onclick="togglePasswordVisibility()">
                                                        <i class="fas fa-eye"></i>
                                                    </span>
                                                </div><br>
                                                <div class="button-container">
                                                    <input type="submit" class="btn mb-3" value="Autentificare">
                                                    <button type="button" class="btn mb-3" onclick="window.location.href='inregistrare.php'">Înregistrare</button>
                                                </div>
                                                <div class="button-container parola_uitata">
                                                    <a href="parola_uitata">Ai uitat parola?</a>
                                                </div>
                                            </form>
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
