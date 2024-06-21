<?php
include 'db_connection.php';

if (isset($_POST['course_name'])) {
    $course_name = $_POST['course_name'];

    $query = "SELECT start_time, end_time FROM courses WHERE course_name = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $course_name);
    $stmt->execute();
    $stmt->bind_result($start_time, $end_time);

    $options = '<option value="">Selectează Ora</option>';
    while ($stmt->fetch()) {
        $options .= '<option value="' . htmlspecialchars($start_time . ' - ' . $end_time) . '">' . htmlspecialchars($start_time . ' - ' . $end_time) . '</option>';
    }

    $stmt->close();
    echo $options;
}
$conn->close();
?>
