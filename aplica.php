<?php
session_start();

include 'db_connection.php';

// Debug: Check if connection is established
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT course_name, start_time, end_time FROM courses";
$result = $conn->query($sql);

// Debug: Check if query was executed successfully
if (!$result) {
    die("Query failed: " . $conn->error);
}

$courses = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $courses[] = $row;
    }
} else {
    echo "No courses found."; // Debugging output
}
?>
<!DOCTYPE html>
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
</head>
<body>
<?php include 'utilities/header.php'; ?>
<main>
    <section class="breadcrumb-area d-flex align-items-center" style="background-image:url(img/bg/applyheader.png)">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-12 col-lg-12">
                    <div class="breadcrumb-wrap text-left">
                        <div class="breadcrumb-title">
                            <h2>Aplică</h2>
                            <div class="breadcrumb-wrap">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="acasa">Acasă</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">Aplică</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="contact" class="contact-area after-none contact-bg pt-120 pb-120 p-relative fix">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title center-align">
                        <h2>Înregistrează-te pentru sesiunile live</h2>
                        <h5>Completați formularul de mai jos pentru a vă înregistra la sesiunile noastre live și pentru a vă îmbunătăți abilitățile IT.</h5>
                    </div>
                    <?php if (empty($courses)): ?>
                        <p>No courses available.</p> <!-- Debugging output -->
                    <?php else: ?>
                    <form id="registerForm" class="contact-form mt-30" role="form">
                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <div class="contact-field p-relative c-name">
                                    <input type="text" name="name" class="form-control" placeholder="Nume/Prenume" required="">
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <div class="contact-field p-relative c-email">
                                    <input type="email" name="mail" class="form-control" placeholder="Adresă Email" required="">
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <div class="contact-field p-relative c-phone">
                                    <input type="tel" name="phone" pattern="0[0-9]{9}" class="form-control" placeholder="Număr de Telefon" required="">
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <div class="contact-field p-relative c-discord">
                                    <input type="text" name="discordid" class="form-control" placeholder="ID Discord (Optional)">
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <div class="contact-field p-relative c-course">
                                    <select id="course" name="course" class="form-select form-select-lg" style="background-color:#495057; padding-bottom: 7px; padding-top: 7px; color: white;" required="">
                                        <option value="" class="form-label">Selectează cursul</option>
                                        <?php foreach ($courses as $course): ?>
                                            <option value="<?php echo $course['course_name']; ?>" data-start-time="<?php echo $course['start_time']; ?>" data-end-time="<?php echo $course['end_time']; ?>">
                                                <?php echo $course['course_name']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <div class="contact-field p-relative c-time">
                                    <select id="session_time" name="session_time" class="form-select form-select-lg" style="background-color:#495057; padding-bottom: 7px; padding-top: 7px; color: white;" required="">
                                        <option value="" class="form-label">Selecteaza ora</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12 mb-3">
                                <div class="contact-field p-relative c-message">
                                    <textarea name="message" rows="6" class="form-control" placeholder="Comments/Special Requests (optional)"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="slider-btn">
                                    <button type="submit" name="submit" class="btn ss-btn" data-animation="fadeInRight" data-delay=".8s">Înregistrare</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <?php endif; ?>
                    <div id="successMessage" class="text-center" style="display: none;">
                        <h3>Te-ai înregistrat cu succes!</h3>
                        <p>Vei fi redirecționat(ă) la pagina principală în 2 secunde...</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php include 'utilities/footer.php'; ?>
<script src="js/vendor/jquery-v3.7.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
    console.log("Document ready");
    $('#registerForm').on('submit', function(e) {
        e.preventDefault();
        console.log("Form submitted");
        $.ajax({
            type: 'POST',
            url: 'inregistrare_curs.php',
            data: $(this).serialize(),
            dataType: 'json', // Expect a JSON response
            success: function(response) {
                console.log("AJAX call success");
                console.log(response);
                if (response.status === 'success') {
                    $('#registerForm').hide();
                    $('#successMessage').show();
                    setTimeout(function() {
                        window.location.href = 'acasa.php';
                    }, 2000);
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.log("AJAX call error");
                console.log(xhr.responseText);
            }
        });
    });

    // Update session time options based on selected course
    $('#course').on('change', function() {
        console.log("Course selected");
        var selectedOption = $(this).find('option:selected');
        var startTime = selectedOption.data('start-time');
        var endTime = selectedOption.data('end-time');
        $('#session_time').html('<option value="' + startTime + '-' + endTime + '">' + startTime + ' - ' + endTime + '</option>');
    });
});

</script>
</body>
</html>
