<?php
session_start();
require_once "connectDB.php";

// Check if the email parameter exists in the URL
if (isset($_GET['email']) && !empty($_GET['email'])) {
    // Sanitize the email input
    $email = mysqli_real_escape_string($link, $_GET['email']);
    
    // Check if the email exists and fetch its verified status
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($link, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        
        // Check if the user is already verified
        if ($row['verified'] == 1) {
            // Already verified; redirect to home page
            $_SESSION['message'] = "Your email is already verified.";
            header("location: user-home.php");
            exit();
        } else {
            // Update the verified field to 1
            $update_sql = "UPDATE users SET verified = 1 WHERE email = '$email'";
            if (mysqli_query($link, $update_sql)) {
                // Set a success message
                $_SESSION['message'] = "Your email has been successfully verified.";
                header("location: user-home.php"); // Redirect to the home page
                exit();
            } else {
                // Handle update error
                $_SESSION['message'] = "An error occurred while verifying your email. Please try again.";
            }
        }
    } else {
        // Email not found in the database
        $_SESSION['message'] = "Invalid verification link or email not found.";
        header("location: login.php");
        exit();
    }
} else {
    // No email parameter provided
    $_SESSION['message'] = "Invalid verification link.";
    header("location: login.php");
    exit();
}

// Close the database connection
mysqli_close($link);
?>
