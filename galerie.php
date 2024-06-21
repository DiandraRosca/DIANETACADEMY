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
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'utilities/header.php'; ?>
    <main>
        <section class="breadcrumb-area d-flex align-items-center" style="background-image:url(img/bg/galleryheader.png)">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-12 col-lg-12">
                        <div class="breadcrumb-wrap text-left">
                            <div class="breadcrumb-title">
                                <h2>Galerie</h2>
                                <div class="breadcrumb-wrap">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a href="acasa">Acasă</a>
                                            </li>
                                            <li class="breadcrumb-item active" aria-current="page">Galerie</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="video-area p-relative pb-120" style="padding-top: 20px;">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <div class="section-title center-align mb-50">
                            <h2>Ultimul <span>videoclip Încărcat</span></h2>
                            <div class="line5"><img src="img/bg/circle_left.png" alt="circle_left"></div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/JaTO46oiCEM?si=9jEMbnMcGfmuDfQp" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </section>
        <section id="work" class="pb-90">
            <div class="container">
                <div class="portfolio">
                    <div class="row align-items-center mb-30">
                        <div class="col-lg-12">
                            <div class="section-title cta-title mb-35">
                                <h2>Istoric <span>cursuri</span></h2>
                                <img src="img/bg/circle_left.png" alt="circle left" />
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="my-masonry">
                                <div class="button-group filter-button-group">
                                    <button class="active" data-filter="*">Toate</button>
                                    <button data-filter=".video">Videoclipuri</button>
                                    <button data-filter=".poze">Poze</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="grid col4">
                        <div class="grid-item poze">
                            <a href="img/gallery/php1.jpg" class="popup-image">
                                <figure class="gallery-image">
                                    <img src="img/gallery/php1.jpg" alt="img" class="img">
                                    <figcaption>
                                        <h5>Proces Logare</h5>
                                        <p>Parte din Cod</p>
                                    </figcaption>
                                </figure>
                            </a>
                        </div>
                        <div class="grid-item poze">
                            <a href="img/gallery/php2.jpg" class="popup-image">
                                <figure class="gallery-image">
                                    <img src="img/gallery/php2.jpg" alt="img" class="img">
                                    <figcaption>
                                        <h5>Proces Înregistrare</h5>
                                        <p>Parte din Cod</p>
                                    </figcaption>
                                </figure>
                            </a>
                        </div>
                        <div class="grid-item video">
                            <iframe width="560" height="315" src="https://www.youtube.com/embed/JaTO46oiCEM?si=9jEMbnMcGfmuDfQp" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        </div>
                        <div class="grid-item video">
                            <iframe width="560" height="315" src="https://www.youtube.com/embed/-7D0vnvJjwk?si=h0livbSjRbIEfHKk" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        </div>
                        <div class="grid-item video">
                            <iframe width="560" height="315" src="https://www.youtube.com/embed/vyiDjta7nfE?si=Ndciuj4T5B76qQcl" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <?php include 'utilities/footer.php'; ?>
        <script src="js/vendor/jquery-v3.7.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.magnific-popup.min.js"></script>
        <script src="js/js_isotope.pkgd.min.js"></script>
        <script src="js/imagesloaded.min.js"></script>
        <script src="js/main.js"></script>
        <script src="js/galerie.js"></script>
    </body>
</html>
