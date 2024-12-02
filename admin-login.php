<?php
session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: admin-dashboard");
    exit;
}

require_once "connectDB.php";

$email = $password = $email_err = $password_err = $login_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter email.";
    } else {
        $email = trim($_POST["email"]);
    }

    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter password.";
    } else {
        $password = trim($_POST["password"]);
    }

    if (empty($email_err) && empty($password_err)) {
        $sql = "SELECT admin_id, email, password FROM admins WHERE email = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_email);

            $param_email = $email;

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    mysqli_stmt_bind_result($stmt, $id, $email, $hashed_password);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password)) {
                            session_start();

                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["email"] = $email;
                            
                            header("location: admin-dashboard");
                        } else {
                            $login_err = "Invalid email or password.";
                        }
                    }
                } else {
                    $login_err = "Invalid email or password.";
                }
            }
        } else {
            $login_err = "Invalid email or password.";
        }
    }

    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "partials/header.php"; ?>

    <style>
    /* Ensure the form group has a consistent height for positioning */
    .form-group {
            position: relative;
            margin-bottom: 1.5rem; /* Add some space for the error message */
        }

        /* Icon positioning */
        .show-hide {
            position: absolute;
            right: 15px; /* Adjust the position of the icon */
            top: 50%; /* Align the icon vertically */
            transform: translateY(-50%); /* Vertically center the icon */
            cursor: pointer;
        }

        /* Ensure padding is enough to accommodate the icon */
        .form-control {
            padding-right: 40px; /* Adjust padding to make space for the icon */
        }

        /* Error styling */
        .is-invalid {
            border-color: red;
        }

        /* Error message positioning */
        .invalid-feedback {
            display: block;
            position: absolute;
            bottom: -1.25rem; /* Adjust the distance of the error message */
            left: 0;
            color: red;
            font-size: 0.875rem;
            margin: 0;
        }

        .mb-3 {
            margin-bottom: 30px !important;
        }
</style>
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
                            <h4>Welcome back! Admin</h4>
                            <h6 class="fw-light">Sign in to continue.</h6>
                            <form class="pt-3" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                                <?php
                                if (!empty($login_err)) {
                                    echo '<div class="alert alert-danger">' . $login_err . '</div>';
                                }
                                ?>

                                <div class="form-group mb-3">
                                    <input type="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : 'custom-form-border'; ?> form-control-lg" name="email" placeholder="Email" value="<?php echo $email; ?>">
                                    <span class="invalid-feedback"><?php echo $email_err; ?></span>
                                </div>
                                <div class="form-group position-relative mb-3">
                                    <input type="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : 'custom-form-border'; ?> form-control-lg" id="password" name="password" placeholder="Password" value="<?php echo $password; ?>">
                                    <span class="invalid-feedback"><?php echo $password_err; ?></span>
                                    <span class="show-hide">
                                        <i id="toggle-password" class="fa-regular fa-eye"></i>
                                    </span>
                                </div>

                                <script>
                                    const passwordInput = document.getElementById("password");
                                    const togglePasswordIcon = document.getElementById("toggle-password");

                                    togglePasswordIcon.addEventListener("click", function () {
                                        // Toggle the type of the password field
                                        if (passwordInput.type === "password") {
                                            passwordInput.type = "text";
                                            togglePasswordIcon.classList.remove("fa-eye");
                                            togglePasswordIcon.classList.add("fa-eye-slash");
                                        } else {
                                            passwordInput.type = "password";
                                            togglePasswordIcon.classList.remove("fa-eye-slash");
                                            togglePasswordIcon.classList.add("fa-eye");
                                        }
                                    });
                                </script>
                                <div class="mt-3">
                                    <button type="submit" name="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn mb-4" href="#">SIGN IN</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "partials/scripts.php"; ?>
</body>

</html>