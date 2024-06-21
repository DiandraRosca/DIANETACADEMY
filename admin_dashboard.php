<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'admin') {
    header('Location: autentificare.php');
    exit();
}

include 'db_connection.php';

$sql_users = "SELECT id, username, email, password, role FROM users";
$result_users = $conn->query($sql_users);

$sql_applicants = "SELECT id, name, email, phone, discord_id, course, session_time, message, username FROM aplicanti";
$result_applicants = $conn->query($sql_applicants);

$sql_courses = "SELECT id, course_name, language, level, instructor, start_date, end_date, live_session_days, start_time, end_time FROM courses";
$result_courses = $conn->query($sql_courses);

if (isset($_GET['ajax'])) {
    if ($_GET['ajax'] == 1) {
        $courses = [];
        if ($result_courses->num_rows > 0) {
            while ($row = $result_courses->fetch_assoc()) {
                $courses[] = $row;
            }
        }
        echo json_encode($courses);
        $conn->close();
        exit();
    } elseif ($_GET['ajax'] == 'users') {
        while ($row = $result_users->fetch_assoc()) {
            echo "<tr id='user-{$row['id']}'>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['role'] . "</td>";
            echo "<td><button class='btn-edit' data-id='" . $row['id'] . "' data-toggle='modal' data-target='#editUserModal'>Editare</button> <button class='btn-delete2' data-id='" . $row['id'] . "'>Șterge</button></td>";
            echo "</tr>";
        }
        $conn->close();
        exit();
    } elseif ($_GET['ajax'] == 'applicants') {
        while ($row = $result_applicants->fetch_assoc()) {
            echo "<tr id='applicant-{$row['id']}'>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['phone'] . "</td>";
            echo "<td>" . $row['discord_id'] . "</td>";
            echo "<td>" . $row['course'] . "</td>";
            echo "<td>" . $row['session_time'] . "</td>";
            echo "<td>" . $row['message'] . "</td>";
            echo "<td>" . $row['username'] . "</td>";
            echo "</tr>";
        }
        $conn->close();
        exit();
    }
}
?>
<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Admin Dashboard - DIA NET ACADEMY</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="img/logo/logodia.ico">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/admin_styles.css"> <!-- External CSS file -->
</head>
<body>
    <?php include 'utilities/header.php'; ?>
    <main>
        <section id="admin-features" class="features-area pt-120 pb-120">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12 col-md-12">
                        <button id="toggleUserTableBtn" class="btn btn-custom">Utilizatori Înregistrați</button>
                        <button id="toggleCoursesBtn" class="btn btn-custom">Vizualizare Cursuri</button>
                        <button id="toggleApplicantsBtn" class="btn btn-custom">Aplicanți Cursuri</button>

                        <div id="userTableContainer" class="table-container">
                            <h3>Utilizatori Înregistrați</h3>
                            <input type="text" id="searchUserInput" class="search-input" placeholder="Search users...">
                            <button id="addUserBtn" class="btn-add" data-toggle="modal" data-target="#addUserModal">Adaugă</button>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nume Utilizator</th>
                                        <th>Adresa Email</th>
                                        <th>Rol</th>
                                        <th>Acțiune</th>
                                    </tr>
                                </thead>
                                <tbody id="userTableBody">
                                    <?php
                                    if ($result_users->num_rows > 0) {
                                        while ($row = $result_users->fetch_assoc()) {
                                            echo "<tr id='user-{$row['id']}'>";
                                            echo "<td>" . $row['id'] . "</td>";
                                            echo "<td>" . $row['username'] . "</td>";
                                            echo "<td>" . $row['email'] . "</td>";
                                            echo "<td>" . $row['role'] . "</td>";
                                            echo "<td><button class='btn-edit' data-id='" . $row['id'] . "' data-toggle='modal' data-target='#editUserModal'>Editare</button> <button class='btn-delete' data-id='" . $row['id'] . "'>Șterge</button></td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='5'>No users found</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <div id="courseTableContainer" class="table-container">
                            <h3>Cursuri</h3>
                            <input type="text" id="searchCourseInput" class="search-input" placeholder="Search courses...">
                            <button id="addCourseBtn" class="btn-add" data-toggle="modal" data-target="#addCourseModal">Adaugă</button>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Numele cursului</th>
                                        <th>Limbaj</th>
                                        <th>Nivel</th>
                                        <th>Instructor</th>
                                        <th>Data Început/Sfârșit</th>
                                        <th>Zilele sesiunilor live</th>
                                        <th>Ora Start/Stop</th>
                                        <th>Acțiune</th>
                                    </tr>
                                </thead>
                                <tbody id="courseTableBody">
                                    <!-- Course data will be loaded via AJAX -->
                                </tbody>
                            </table>
                        </div>

                        <div id="applicantsTableContainer" class="table-container">
                            <h3>Aplicanți Cursuri</h3>
                            <input type="text" id="searchApplicantsInput" class="search-input" placeholder="Search applicants...">
                            <button id="addApplicantBtn" class="btn-add" data-toggle="modal" data-target="#addApplicantModal">Adaugă</button>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nume</th>
                                        <th>Email</th>
                                        <th>Telefon</th>
                                        <th>Discord ID</th>
                                        <th>Curs</th>
                                        <th>Ora Sesiune</th>
                                        <th>Mesaj</th>
                                        <th>Utilizator</th>
                                    </tr>
                                </thead>
                                <tbody id="applicantsTableBody">
                                    <?php
                                    if ($result_applicants->num_rows > 0) {
                                        while ($row = $result_applicants->fetch_assoc()) {
                                            echo "<tr id='applicant-{$row['id']}'>";
                                            echo "<td>" . $row['id'] . "</td>";
                                            echo "<td>" . $row['name'] . "</td>";
                                            echo "<td>" . $row['email'] . "</td>";
                                            echo "<td>" . $row['phone'] . "</td>";
                                            echo "<td>" . $row['discord_id'] . "</td>";
                                            echo "<td>" . $row['course'] . "</td>";
                                            echo "<td>" . $row['session_time'] . "</td>";
                                            echo "<td>" . $row['message'] . "</td>";
                                            echo "<td>" . $row['username'] . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='9'>No applicants found</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Add User Modal -->
    <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Adaugă Utilizator</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addUserForm">
                        <div class="form-group">
                            <label for="username">Nume Utilizator</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Adresa Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="role">Rol</label>
                            <select name="role" class="form-control" required>
                                <option value="user">Utilizator</option>
                                <option value="admin">Administrator</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="password">Parolă</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Adaugă Utilizator</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Editare Utilizator</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editUserForm" action="edit_user.php" method="post">
                        <input type="hidden" name="id" id="editUserId">
                        <div class="form-group">
                            <label for="username">Nume Utilizator</label>
                            <input type="text" name="username" id="editUsername" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Adresa Email</label>
                            <input type="email" name="email" id="editEmail" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="role">Rol</label>
                            <select name="role" id="editRole" class="form-control" required>
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Salvează</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Course Modal -->
    <div class="modal fade" id="addCourseModal" tabindex="-1" role="dialog" aria-labelledby="addCourseModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCourseModalLabel">Adaugă Curs</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addCourseForm">
                        <div class="form-group">
                            <label for="course_name">Numele cursului</label>
                            <input type="text" name="course_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="language">Limbaj</label>
                            <input type="text" name="language" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="level">Nivel</label>
                            <input type="text" name="level" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="instructor">Instructor</label>
                            <input type="text" name="instructor" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="start_date">Data de începere</label>
                            <input type="date" name="start_date" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="end_date">Data de sfârșit</label>
                            <input type="date" name="end_date" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="live_session_days">Zilele sesiunilor live</label>
                            <input type="text" name="live_session_days" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="start_time">Ora Start</label>
                            <input type="time" name="start_time" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="end_time">Ora Stop</label>
                            <input type="time" name="end_time" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Adaugă Curs</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Course Modal -->
    <div class="modal fade" id="editCourseModal" tabindex="-1" role="dialog" aria-labelledby="editCourseModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCourseModalLabel">Editare Curs</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editCourseForm">
                        <input type="hidden" name="id" id="editCourseId">
                        <div class="form-group">
                            <label for="course_name">Numele cursului</label>
                            <input type="text" name="course_name" id="editCourseName" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="language">Limbaj</label>
                            <input type="text" name="language" id="editLanguage" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="level">Nivel</label>
                            <input type="text" name="level" id="editLevel" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="instructor">Instructor</label>
                            <input type="text" name="instructor" id="editInstructor" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="start_date">Data de începere</label>
                            <input type="date" name="start_date" id="editStartDate" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="end_date">Data de sfârșit</label>
                            <input type="date" name="end_date" id="editEndDate" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="live_session_days">Zilele sesiunilor live</label>
                            <input type="text" name="live_session_days" id="editLiveSessionDays" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="start_time">Ora Start</label>
                            <input type="time" name="start_time" id="editStartTime" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="end_time">Ora Stop</label>
                            <input type="time" name="end_time" id="editEndTime" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Salvează</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Applicant Modal -->
    <div class="modal fade" id="addApplicantModal" tabindex="-1" role="dialog" aria-labelledby="addApplicantModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addApplicantModalLabel">Adaugă Aplicant</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addApplicantForm">
                        <div class="form-group">
                            <label for="name">Nume</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Adresa Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Telefon</label>
                            <input type="text" name="phone" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="discord_id">Discord ID</label>
                            <input type="text" name="discord_id" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="course">Curs</label>
                            <select name="course" id="course" class="form-control" required>
                                <option value="">Selectează Curs</option>
                                <?php
                                if ($result_courses->num_rows > 0) {
                                    while ($row = $result_courses->fetch_assoc()) {
                                        echo "<option value='{$row['course_name']}'>{$row['course_name']}</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="session_time">Ora Sesiune</label>
                            <select name="session_time" id="session_time" class="form-control">
                                <option value="">Selectează Ora</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="message">Mesaj</label>
                            <textarea name="message" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="username">Utilizator</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Adaugă Aplicant</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="notification" id="notification"></div>

    <?php include 'utilities/footer.php'; ?>

    <script src="js/vendor/jquery-v3.7.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/admin_dashboard.js"></script>
</body>
</html>

<?php
$conn->close();
?>
