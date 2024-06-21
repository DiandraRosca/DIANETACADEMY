<?php
session_start();
require 'db_connection.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'user') {
    header('Location: autentificare.php');
    exit();
}

$username = $_SESSION['username'];
$query = $conn->prepare("
    SELECT aplicanti.course, aplicanti.session_time, aplicanti.message, aplicanti.created_at, courses.live_session_days 
    FROM aplicanti 
    JOIN courses ON aplicanti.course = courses.course_name 
    WHERE aplicanti.username = ?");
$query->bind_param("s", $username);
$query->execute();
$result = $query->get_result();
$courses = [];
while ($row = $result->fetch_assoc()) {
    $courses[] = $row;
}
$query->close();
?>
<!doctype html>
<html lang="zxx">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>User Profile - DIA NET ACADEMY</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="img/logo/logodia.ico">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
      #coursesTable table {
        color: white;
      }
    </style>
  </head>
  <body>
    <?php include 'utilities/header.php'; ?>
    <main>
      <section class="features-area pt-120 pb-120">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-12 col-md-12">
              <h1>Bine ai venit, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
              <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#changePasswordModal"> Schimbă Parola </button>
              <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="changePasswordModalLabel">Schimbă Parola</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                      <form id="changePasswordForm" action="change_password.php" method="post">
                        <div class="form-group">
                          <label for="old-password">Parola Veche:</label>
                          <div class="password-container">
                            <input type="password" class="form-control" id="old-password" name="old_password" required>
                            <span class="toggle-password" onclick="togglePasswordVisibility('old-password')"><i class="fas fa-eye"></i></span>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="new-password">Parola Nouă:</label>
                          <div class="password-container">
                            <input type="password" class="form-control" id="new-password" name="new_password" required>
                            <span class="toggle-password" onclick="togglePasswordVisibility('new-password')"><i class="fas fa-eye"></i></span>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="confirm-password">Confirmă Parola Nouă:</label>
                          <div class="password-container">
                            <input type="password" class="form-control" id="confirm-password" name="confirm_password" required>
                            <span class="toggle-password" onclick="togglePasswordVisibility('confirm-password')"><i class="fas fa-eye"></i></span>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="security-question">Cât fac 100+100?</label>
                          <input type="text" class="form-control" id="security-question" name="security_answer" placeholder="Răspunde" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Schimbă Parola</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <br /><br />
              <h2>Cursurile la care ați aplicat</h2>
              <button class="btn btn-info mb-3" onclick="toggleCoursesVisibility()">Afișează/Ascunde</button>
              <div id="coursesTable" style="display:none;">
                <table class="table table-striped table-hover">
                  <thead class="thead-dark">
                    <tr>
                      <th>Numele Cursului</th>
                      <th>Ora Sesiunii</th>
                      <th>Ziua Sesiunii</th>
                      <th>Data Aplicării</th>
                      <th>Detalii</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (!empty($courses)): ?>
                      <?php foreach ($courses as $course): ?>
                        <tr>
                          <td><?php echo htmlspecialchars($course['course']); ?></td>
                          <td><?php echo htmlspecialchars($course['session_time']); ?></td>
                          <td><?php echo htmlspecialchars($course['live_session_days']); ?></td>
                          <td><?php echo htmlspecialchars(date("Y-m-d", strtotime($course['created_at']))); ?></td>
                          <td><?php echo htmlspecialchars($course['message']); ?></td>
                        </tr>
                      <?php endforeach; ?>
                    <?php else: ?>
                      <tr>
                        <td colspan="5">Nu ați aplicat la niciun curs.</td>
                      </tr>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
    <?php include 'utilities/footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
      function toggleCoursesVisibility() {
        var x = document.getElementById("coursesTable");
        x.style.display = x.style.display === "none" ? "block" : "none";
      }
    </script>
    <script>
      function togglePasswordVisibility(passwordFieldId) {
        var passwordInput = document.getElementById(passwordFieldId);
        var toggleIcon = passwordInput.nextElementSibling.querySelector('i');
        if (passwordInput.type === 'password') {
          passwordInput.type = 'text';
          toggleIcon.classList.remove('fa-eye');
          toggleIcon.classList.add('fa-eye-slash');
        } else {
          passwordInput.type = 'password';
          toggleIcon.classList.remove('fa-eye-slash');
          toggleIcon.classList.add('fa-eye');
        }
      }
    </script>
  </body>
</html>
<?php
$conn->close();
?>
