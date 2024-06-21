
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
    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="font-flaticon/flaticon.css">
    <link rel="stylesheet" href="css/dripicons.css">
    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="css/meanmenu.css">
    <link rel="stylesheet" href="css/default.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <script>
      var seconds = 2;
      var foo;

      function redirect() {
        document.location.href = 'acasa.php';
      }

      function updateSecs() {
        document.getElementById("seconds").innerHTML = seconds;
        seconds--;
        if (seconds == -1) {
          clearInterval(foo);
          redirect();
        }
      }

      function countdownTimer() {
        foo = setInterval(function() {
          updateSecs()
        }, 1000);
      }
      countdownTimer();
    </script>
  </head>
  <body>
    <section id="about" class="about-area about-p pb-120 p-relative">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="error-page text-center">
              <div class="error-code">
                <h1>Inregistrat!</h1>
              </div>
              <div class="error-message">
                <h3>Vei fi redirecționat(ă) la pagina principală în <span id="seconds">2</span> secunde. </h3>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    </main>
    <?php include 'utilities/footer.php'; ?>
    <script src="js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="js/vendor/jquery-v3.7.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/ajax-form.js"></script>
    <script src="js/paroller.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/js_isotope.pkgd.min.js"></script>
    <script src="js/imagesloaded.min.js"></script>
    <script src="js/parallax.min.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/jquery.meanmenu.min.js"></script>
    <script src="js/parallax-scroll.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/element-in-view.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>