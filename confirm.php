<?php
include_once "db_connection.php";

// Inițializează variabila $confirmationMessage
$confirmationMessage = '';

if (isset($_GET['token']) && !empty($_GET['token'])) {
    $token = $_GET['token'];

    // Verify the token
    $sql = "SELECT username FROM users WHERE token = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Token is valid, activate the user
        $sql = "UPDATE users SET token = NULL, is_active = 1 WHERE token = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $token);
        if ($stmt->execute()) {
            $confirmationMessage = "Adresa dvs. de email a fost confirmată. Acum vă puteți autentifica.";
        } else {
            $confirmationMessage = "Ceva a mers greșit. Vă rugăm să încercați din nou.";
        }
    } else {
        $confirmationMessage = "Token invalid.";
    }

    $stmt->close();
} else {
    $confirmationMessage = "Nu a fost furnizat niciun token.";
}
?>

<!DOCTYPE html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Confirmare Email - DIA NET ACADEMY</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="img/logo/logodia.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.4.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <style>
        .button-container .btn {
            width: 100%;
        }
        .confirmation-message {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            height: 100vh;
        }
        .confirmation-message h3 {
            color: #28a745;
        }
        .confirmation-message p {
            margin: 20px 0;

        }
        .confirmation-message .btn {
            margin-top: 20px;
            background-color: #ff7a00; /* Change button color */
            color: white;
        }
        .container-center {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }
    </style>
</head>
<body>
<main>
    <section id="home" class="slider-area slider-four fix p-relative">
        <div class="slider-active">
            <div class="single-slider slider-bg d-flex align-items-center" style="background: url(img/slider/index_img_bg.png) no-repeat; background-size: cover; background-position: center top;">
                <div class="container">
                    <div class="row justify-content-center pt-50">
                        <div class="col-lg-6 col-md-6">
                            <div class="slider-content s-slider-content">
                                <section class="confirmation-message">
                                    <div class="container">
                                        <h3>Confirmare Email</h3>
                                        <p><?php echo htmlspecialchars($confirmationMessage); ?></p>
                                        <div class="button-container">
                                            <button type="button" class="btn btn-primary" onclick="window.location.href='autentificare.php'">Autentificare</button>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php include 'utilities/footer.php'; ?>
</body>
</html>
