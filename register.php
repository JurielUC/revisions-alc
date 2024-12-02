<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "partials/header.php"; ?>
</head>

<body>
    <?php

    require "connectDB.php";

    $firstname = $lastname = $gender = $dob = $age = $number = $address = $email = $password = $confirm_password = "";
    $firstname_err = $lastname_err = $gender_err = $dob_err = $age_err = $number_err = $address_err = $email_err = $password_err = $confirm_password_err = "";

    if (isset($_POST['submit'])) {

        if (empty(trim($_POST["email"]))) {
            $email_err = "Please enter an email.";
        } else {
            $sql = "SELECT user_id FROM users WHERE email = ?";

            if ($stmt = mysqli_prepare($link, $sql)) {
                mysqli_stmt_bind_param($stmt, "s", $param_email);

                $param_email = trim($_POST["email"]);

                if (mysqli_stmt_execute($stmt)) {
                    mysqli_stmt_store_result($stmt);

                    if (mysqli_stmt_num_rows($stmt) == 1) {
                        $email_err = "This email is already taken.";
                    } else {
                        $email = trim($_POST["email"]);
                    }
                } else {
                    echo "<script>swal({
                    title: 'Oops!',
                    text: 'Something went wrong. Please try again later.',
                    icon: 'warning',
                    button: 'Done!',
                });</script>";
                }

                mysqli_stmt_close($stmt);
            }
        }

        if (empty(trim($_POST["firstname"]))) {
            $firstname_err = "Please enter firstname.";
        } else {
            $firstname = trim($_POST["firstname"]);
        }

        if (empty(trim($_POST["lastname"]))) {
            $lastname_err = "Please enter lastname.";
        } else {
            $lastname = trim($_POST["lastname"]);
        }

        // Validate Date of Birth
        if (empty(trim($_POST["dob"]))) {
            $dob_err = "Please enter your date of birth.";
        } else {
            $dob = trim($_POST["dob"]);
        }

        // Validate Age
        if (empty(trim($_POST["age"]))) {
            $age_err = "Please enter your age.";
        } elseif (!is_numeric(trim($_POST["age"])) || trim($_POST["age"]) <= 0) {
            $age_err = "Age must be a positive number.";
        } else {
            $age = trim($_POST["age"]);
        }

        // Validate Phone Number
        if (empty(trim($_POST["number"]))) {
            $number_err = "Please enter your phone number.";
        } elseif (!preg_match('/^\d{10,15}$/', trim($_POST["number"]))) {
            $number_err = "Phone number must be between 10 to 15 digits.";
        } else {
            $number = trim($_POST["number"]);
        }

        // Validate Address
        if (empty(trim($_POST["address"]))) {
            $address_err = "Please enter your address.";
        } elseif (strlen(trim($_POST["address"])) < 5) {
            $address_err = "Address must be at least 5 characters long.";
        } else {
            $address = trim($_POST["address"]);
        }

        if (empty($_POST["gender"])) {
            $gender_err = "Please select your gender.";
        } else {
            $gender = trim($_POST["gender"]);
        }

        if (empty(trim($_POST["password"]))) {
            $password_err = "Please enter a password.";
        } elseif (strlen(trim($_POST["password"])) < 8) {
            $password_err = "Password must have at least 8 characters.";
        } elseif (!preg_match('/[A-Z]/', trim($_POST["password"]))) {
            $password_err = "Password must contain at least one uppercase letter.";
        } elseif (!preg_match('/[a-z]/', trim($_POST["password"]))) {
            $password_err = "Password must contain at least one lowercase letter.";
        } elseif (!preg_match('/[0-9]/', trim($_POST["password"]))) {
            $password_err = "Password must contain at least one number.";
        } elseif (!preg_match('/[\W_]/', trim($_POST["password"]))) {
            $password_err = "Password must contain at least one special character (e.g., @, #, $, etc.).";
        } else {
            $password = trim($_POST["password"]);
        }

        if (empty(trim($_POST["confirm_password"]))) {
            $confirm_password_err = "Please confirm your password.";
        } else {
            $confirm_password = trim($_POST["confirm_password"]);
            if ($password != $confirm_password) {
                $confirm_password_err = "Passwords do not match.";
            }
        }


        if (empty($firstanme_err) && empty($lastname_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)) {

            $sql = "INSERT INTO users (first_name, last_name, birthday, age, gender, contact_number, address, email, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

            if ($stmt = mysqli_prepare($link, $sql)) {
                mysqli_stmt_bind_param($stmt, "sssssssss", $param_firstname, $param_lastname, $param_birthday, $param_age, $param_gender, $param_contact_number, $param_address, $param_email, $param_password);

                $param_firstname = $firstname;
                $param_lastname = $lastname;
                $param_birthday = $dob;
                $param_age = $age;
                $param_contact_number = $number;
                $param_gender = $gender;
                $param_address = $address;
                $param_email = $email;
                $param_password = password_hash($password, PASSWORD_DEFAULT);

                if (mysqli_stmt_execute($stmt)) {
                    $firstname = $lastname = $gender = $dob = $age = $number = $address = $email = $password = $confirm_password = "";
                    $firstname_err = $lastname_err = $gender_err = $dob_err = $age_err = $number_err = $address_err = $email_err = $password_err = $confirm_password_err = "";
                    echo "<script>swal({
                        title: 'Success!',
                        text: 'Account Created Successfully!',
                        icon: 'success',
                        closeOnClickOutside: false,
                        button: false
                    });</script>";
                    echo '<meta http-equiv="Refresh" content="3; url=login">';
                } else {
                    echo "<script>swal({
                        title: 'Oops!',
                        text: 'Something went wrong. Please try again later.',
                        icon: 'warning',
                        button: 'Done!',
                    });</script>";
                }

                mysqli_stmt_close($stmt);
            }
        }

        mysqli_close($link);
    }

    ?>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <div class="brand-logo">
                                <img src="assets/img/logo.png" alt="logo">
                            </div>
                            <h4>Hello! let's get started</h4>
                            <h6 class="fw-light">Please fill up the necessary credentials.</h6>
                            <form class="pt-3" method="post">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="firstname">Firstname</label>
                                        <input type="text"
                                            class="form-control <?php echo (!empty($firstname_err)) ? 'is-invalid' : 'custom-form-border'; ?> form-control-lg"
                                            name="firstname"
                                            id="firstname"
                                            placeholder="Firstname"
                                            value="<?php echo htmlspecialchars($firstname); ?>"
                                            style="text-transform: capitalize;">
                                        <span class="invalid-feedback"><?php echo $firstname_err; ?></span>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="lastname">Lastname</label>
                                        <input type="text"
                                            class="form-control <?php echo (!empty($lastname_err)) ? 'is-invalid' : 'custom-form-border'; ?> form-control-lg"
                                            name="lastname"
                                            id="lastname"
                                            placeholder="Lastname"
                                            value="<?php echo htmlspecialchars($lastname); ?>"
                                            style="text-transform: capitalize;">
                                        <span class="invalid-feedback"><?php echo $lastname_err; ?></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="dob">Date of Birth</label>
                                <input type="date" 
                                    class="form-control <?php echo (!empty($dob_err)) ? 'is-invalid' : 'custom-form-border'; ?> form-control-lg" 
                                    name="dob" 
                                    id="dob"
                                    placeholder="Date of Birth"
                                    value="<?php echo htmlspecialchars($dob); ?>">
                                <span class="invalid-feedback"><?php echo $dob_err; ?></span>
                            </div>

                            <div class="form-group">
                                <label for="age">Age</label>
                                <input type="number" 
                                    class="form-control <?php echo (!empty($age_err)) ? 'is-invalid' : 'custom-form-border'; ?> form-control-lg" 
                                    name="age" 
                                    id="age"
                                    placeholder="Age"
                                    value="<?php echo htmlspecialchars($age); ?>">
                                <span class="invalid-feedback"><?php echo $age_err; ?></span>
                            </div>

                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select name="gender" 
                                        id="gender"
                                        class="form-select <?php echo (!empty($gender_err)) ? 'is-invalid' : 'custom-form-border'; ?> form-control-lg text-dark">
                                    <option value="" disabled <?php echo empty($gender) ? 'selected' : ''; ?>>Gender</option>
                                    <option value="Male" <?php echo ($gender === "Male") ? 'selected' : ''; ?>>Male</option>
                                    <option value="Female" <?php echo ($gender === "Female") ? 'selected' : ''; ?>>Female</option>
                                </select>
                                <span class="invalid-feedback"><?php echo $gender_err; ?></span>
                            </div>

                            <div class="form-group">
                                <label for="number">Phone Number</label>
                                <input type="number" 
                                    class="form-control <?php echo (!empty($number_err)) ? 'is-invalid' : 'custom-form-border'; ?> form-control-lg" 
                                    name="number" 
                                    id="number"
                                    maxlength="11"
                                    placeholder="Phone Number"
                                    value="<?php echo htmlspecialchars($number); ?>">
                                <span class="invalid-feedback"><?php echo $number_err; ?></span>
                            </div>

                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea name="address" 
                                        id="address"
                                        class="form-control <?php echo (!empty($address_err)) ? 'is-invalid' : 'custom-form-border'; ?> form-control-lg" 
                                        placeholder="Address"><?php echo htmlspecialchars($address); ?></textarea>
                                <span class="invalid-feedback"><?php echo $address_err; ?></span>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : 'custom-form-border'; ?> form-control-lg" 
                                    name="email" 
                                    id="email"
                                    placeholder="Email" 
                                    value="<?php echo $email; ?>">
                                <span class="invalid-feedback"><?php echo $email_err; ?></span>
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : 'custom-form-border'; ?> form-control-lg" 
                                    id="password" 
                                    name="password" 
                                    placeholder="Password" 
                                    value="<?php echo $password; ?>">
                                <span class="invalid-feedback"><?php echo $password_err; ?></span>
                            </div>

                            <div class="form-group">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : 'custom-form-border'; ?> form-control-lg" 
                                    id="confirm_password" 
                                    name="confirm_password" 
                                    placeholder="Repeat Password" 
                                    value="<?php echo $confirm_password; ?>">
                                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                            </div>
                                <div class="my-2 d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input type="checkbox" class="form-check-input" id="check">
                                            Show Password
                                        </label>
                                    </div>
                                </div>
                                <script>
                                    const passwordInput = document.getElementById("password");
                                    const confirmPasswordInput = document.getElementById("confirm_password");
                                    const showPasswordCheckbox = document.getElementById("check");

                                    showPasswordCheckbox.addEventListener("change", function() {
                                        if (showPasswordCheckbox.checked) {
                                            passwordInput.type = "text";
                                            confirmPasswordInput.type = "text";
                                        } else {
                                            passwordInput.type = "password";
                                            confirmPasswordInput.type = "password";
                                        }
                                    });
                                </script>
                                <div class="mt-3">
                                    <button type="submit" name="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn mb-4">SIGN UP</button>
                                </div>
                                <div class="text-center mt-4 fw-light">
                                    Already have an account? <a href="login" class="text-primary">Sign In</a>
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

<script>
    document.querySelector('[name="number"]').addEventListener('input', function (e) {
        e.target.value = e.target.value.replace(/\D/g, '').substring(0, 11);
    });
</script>

</html>