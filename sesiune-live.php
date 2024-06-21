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
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=634bd941c2af2800193d4ff4&product=inline-follow-buttons" async="async"></script>
</head>
<body>
    <?php include 'utilities/header.php'; ?>
    <main>
        <section class="video-area p-relative pb-120">
            <div class="container" style="padding-top: 20px;">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <div class="section-title center-align mb-50">
                            <h2>Vezi <span>sesiunile</span></h2>
                            <div class="line5">
                                <img src="img/bg/circle_left.png" alt="circle_left">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 twitch-player">
                        <iframe src="https://player.twitch.tv/?channel=dia_net_academy&parent=localhost" frameborder="0" allowfullscreen="true" scrolling="no" height="520"></iframe>
                    </div>
                    <div class="col-lg-12 twitch-chat">
                        <iframe id="chat_embed" src="https://www.twitch.tv/embed/dia_net_academy/chat?parent=localhost" height="520"></iframe>
                    </div>
                    <div class="col-lg-12 discord-widget">
                        <iframe src="https://discord.com/widget?id=1241356446461857812&theme=dark" width="350" height="500" allowtransparency="true" frameborder="0" sandbox="allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts"></iframe>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <?php include 'utilities/footer.php'; ?>
    <script src="js/vendor/jquery-v3.7.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
