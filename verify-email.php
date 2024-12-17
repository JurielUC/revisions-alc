<?php
session_start();
require_once "connectDB.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';

// Check if email exists in session; otherwise, block access
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
} else {
    echo "Session expired or unauthorized access. Please restart the process.";
    exit();
}

// Function to resend verification link
function resendVerificationLink($email)
{
    // $verificationLink = "http://localhost/alc/email-verified?token=" . md5($email . time()) . "&email=" . $email;
    $verificationLink = "https://accuracylaboratoryclinic.com/email-verified?token=" . md5($email . time()) . "&email=" . $email; // Example token generation
    $_SESSION['verification_link'] = $verificationLink;

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'accuracylaboratoryclinic@gmail.com'; // Replace with your email
        $mail->Password = 'jgfd uaif wgpi dwuj'; // Replace with your app-specific password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('accuracylaboratoryclinic@gmail.com', 'Accuracy Laboratory Clinic');
        $mail->addAddress($email);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Resend Verification Link';
        $mail->Body = "<p>Click the link below to verify your email address:</p>
                       <p><a href='$verificationLink'>$verificationLink</a></p>";

        $mail->send();
        return "A new verification link has been sent to: " . htmlspecialchars($email);
    } catch (Exception $e) {
        return "Error sending verification link: " . $mail->ErrorInfo;
    }
}

// Handle Resend Verification button click
$resend_message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['resend_link'])) {
    $resend_message = resendVerificationLink($email);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "partials/header.php"; ?>
    <title>Verify Your Email</title>
</head>
<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <div class="brand-logo">
                                <img src="assets/img/logo.png" alt="logo">
                            </div>
                            <h4>Email Verification</h4>
                            <p class="fw-light">
                                A verification link was sent to <strong><?php echo htmlspecialchars($email); ?></strong>. 
                                Please check your inbox and follow the instructions.
                            </p>

                            <!-- Resend Success or Error Message -->
                            <?php if (!empty($resend_message)): ?>
                                <div class="alert alert-info" role="alert">
                                    <?php echo $resend_message; ?>
                                </div>
                            <?php endif; ?>

                            <!-- Resend Verification Link Form -->
                            <form class="pt-3" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                <div class="mt-3">
                                    <button type="submit" name="resend_link" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn mb-4">
                                        Resend Verification Link
                                    </button>
                                </div>
                            </form>

                            <p class="text-center mt-4">
                                Didn't receive the email? Check your spam folder or click the button above to resend.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "partials/scripts.php"; ?>
</body>
</html>
