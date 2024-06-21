<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>View Users</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="img/logo/logodia.ico">
    <!-- CSS here -->
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
    <style>
        /* Add your CSS styling here */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<body>

    <!-- header -->
    <header class="header-area header-three">
        <!-- Your header content goes here -->
    </header>
    <!-- header-end -->
    <!-- main-area -->
    <main>
        <!-- about-area -->
        <!-- Your existing HTML content goes here -->

        <!-- PHP-generated table -->
        <section id="about" class="about-area about-p pb-120 p-relative">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="col-lg-12" style="text-align: center;">
                            <div class="section-title cta-title mb-35">
                                <br> <br>
                                <h1>Users</h1>
                                <img src="img/bg/circle_left.png" alt="circle left" />
                            </div>
                            <table>
                                <?php
                                // Database configuration
                                $servername = "localhost";
                                $username = "root";
                                $password = ""; // Default password for root is empty
                                $dbname = "user_registration";

                                // Create connection
                                $conn = new mysqli($servername, $username, $password, $dbname);

                                // Check connection
                                if ($conn->connect_error) {
                                    die("Connection failed: " . $conn->connect_error);
                                }

                                // Fetch data from the users table
                                $sql = "SELECT id, name, email, phone, discord_id, course, session_time, message FROM users";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    echo "<table border='1'>";
                                    echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Discord ID</th><th>Course</th><th>Session Time</th><th>Message</th></tr>";
                                    // Output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr><td>" . $row["id"] . "</td><td>" . $row["name"] . "</td><td>" . $row["email"] . "</td><td>" . $row["phone"] . "</td><td>" . $row["discord_id"] . "</td><td>" . $row["course"] . "</td><td>" . $row["session_time"] . "</td><td>" . $row["message"] . "</td></tr>";
                                    }
                                    echo "</table>";
                                } else {
                                    echo "0 results";
                                }

                                $conn->close();
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- about-area-end -->
        <!-- Your existing HTML content goes here -->
    </main>

    <!-- footer -->
    <!-- Your footer content goes here -->
    <!-- footer-end -->

    <!-- JS here -->
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
