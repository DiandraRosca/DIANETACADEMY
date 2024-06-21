<?php
session_start();
?>
<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>DIA NET ACADEMY</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="img/logo/logodia.ico">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/default.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
</head>
<body>
    <?php include 'utilities/header.php'; ?>
    <main>
        <section id="home" class="slider-area slider-four fix p-relative">
            <div class="slider-active">
                <div class="single-slider slider-bg d-flex align-items-center" style="background: url(img/slider/index_img_bg.png) no-repeat;background-size: cover; background-position: center top;">
                    <div class="container">
                        <div class="row justify-content-center pt-50">
                            <div class="col-lg-6 col-md-6">
                                <div class="slider-content s-slider-content">
                                    <h5 data-animation="fadeInDown" data-delay=".4s">Construiește viitorul, cod cu cod.</h5>
                                    <h2 data-animation="fadeInUp" data-delay=".4s">DIA NET ACADEMY</h2>
                                    <div class="slider-btn"><a href="desprenoi" class="btn ss-btn mr-15">Citește despre noi</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="graph" class="features-area pt-120 pb-120" style="background-color: #212529;">
            <div class="container">
                <div class="row align-items-center text-center">
                    <div class="col-lg-12 col-md-12">
                        <div class="section-title cta-title mb-20">
                            <h2>Alăturați-vă nouă<br> pentru a fi la zi cu sesiunile noastre</h2>
                            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                                <a href="aplica" class="btn ss-btn mr-15 active">Alătură-te acum</a>
                            <?php else: ?>
                                <a href="autentificare" class="btn ss-btn mr-15 active">Autentificare</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <?php include 'utilities/footer.php'; ?>
    <script src="js/vendor/jquery-v3.7.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/acasa.js"></script>
</body>
</html>
