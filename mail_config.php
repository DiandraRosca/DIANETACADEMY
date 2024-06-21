<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Include Composer's autoloader

function sendCourseApplicationEmail($to, $courseName, $timeDays, $liveSessionLink) {
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->CharSet = 'UTF-8'; // Set the character encoding to UTF-8
        $mail->SMTPDebug = 0;                      // Enable verbose debug output
        $mail->isSMTP();                           // Set mailer to use SMTP
        $mail->Host       = 'smtp.gmail.com';      // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true;                  // Enable SMTP authentication
        $mail->Username   = 'dianetacademytest@gmail.com'; // SMTP username
        $mail->Password   = 'tifr qmwl fnms onjg'; // SMTP app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  // Enable TLS encryption, `ssl` also accepted
        $mail->Port       = 587;                   // TCP port to connect to

        // Recipients
        $mail->setFrom('dianetacademytest@gmail.com', 'Dia Net Academy');
        $mail->addAddress($to);     // Add a recipient

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Confirmare Înregistrare curs!';
        $mail->Body    = "Mulțumim pentru că ați ales cursul nostru:<br>
                          Nume curs: $courseName<br>
                          $timeDays<br>
                          <a href='$liveSessionLink'>Alăturați-vă sesiunii live!</a>";

        $mail->send();
    } catch (Exception $e) {
        echo "Mesajul nu a putut fi trimis. Eroare: {$mail->ErrorInfo}";
    }
}
?>
