<?php
session_start();
include 'db_connection.php';

$sql = "SELECT course_name, language, level, instructor, start_date, end_date, live_session_days, start_time, end_time FROM courses";
$result = $conn->query($sql);

if (isset($_GET['ajax']) && $_GET['ajax'] == 1) {
    // Handle AJAX request
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr align='center'>
                    <td>{$row['course_name']}</td>
                    <td>{$row['language']}</td>
                    <td>{$row['level']}</td>
                    <td>{$row['instructor']}</td>
                    <td>{$row['start_date']}</td>
                    <td>{$row['end_date']}</td>
                    <td>{$row['live_session_days']}</td>
                    <td>{$row['start_time']} / {$row['end_time']}</td>
                </tr>";
        }
    } else {
        echo "<tr><td colspan='8'>No courses available</td></tr>";
    }
    $conn->close();
    exit();
}
?>
<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>DIA NET ACADEMY</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="img/logo/logodia.ico">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .search-input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
    </style>
</head>
<body>
<?php include 'utilities/header.php'; ?>
<main>
<section class="breadcrumb-area d-flex align-items-center" style="background-image:url(img/bg/cursuripage.png)">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-xl-12 col-lg-12">
              <div class="breadcrumb-wrap text-left">
                <div class="breadcrumb-title">
                  <h2>Cursuri</h2>
                  <div class="breadcrumb-wrap">
                    <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                          <a href="acasa">Acasă</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Cursuri</li>
                      </ol>
                    </nav>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    <section id="about" class="about-area about-p pb-120 p-relative">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="col-lg-12" style="text-align: center;">
                        <div class="section-title cta-title mb-35">
                            <br><br>
                            <h1>Cursuri <span>valabile online</span></h1>    
                            <img src="img/bg/circle_left.png" alt="circle left"/>
                        </div>
                        <input class="search-input" type="text" id="searchInput" onkeyup="searchFunction()" placeholder="Cautare Curs..." title="Type in a course">
                        <br><br>
                        <table class="Tabel-Cursuri" id="courseTable" cellpadding="10" style="color: #FFFFFF;" bgcolor="#202020">
                            <thead>
                                <tr align="center" style="color: #E5D000;">
                                    <th>Numele cursului</th>
                                    <th>Limbaj</th>
                                    <th>Nivel</th>
                                    <th>Instructor</th>
                                    <th>Data de începere</th>
                                    <th>Data de sfârșit</th>
                                    <th>Zilele sesiunilor live</th>
                                    <th>Ora Start</th>
                                    <th>Ora Stop</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        echo "<tr align='center'>
                                                <td>{$row['course_name']}</td>
                                                <td>{$row['language']}</td>
                                                <td>{$row['level']}</td>
                                                <td>{$row['instructor']}</td>
                                                <td>{$row['start_date']}</td>
                                                <td>{$row['end_date']}</td>
                                                <td>{$row['live_session_days']}</td>
                                                <td>{$row['start_time']}</td>
                                                <td>{$row['end_time']}</td>
                                            </tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='9'>No courses available</td></tr>";
                                }
                                $conn->close();
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php include 'utilities/footer.php'; ?>
<script src="js/vendor/jquery-v3.7.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script SRC="js/cursuri.js"></script>
</body>
</html>
