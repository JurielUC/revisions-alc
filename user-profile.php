<?php
session_start();

require_once "connectDB.php";

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    $sql = "SELECT * FROM users WHERE user_id = '" . $_SESSION['id'] . "'";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);

    // Pre-fill the form with existing data
    $firstname = $row['first_name'];
    $lastname = $row['last_name'];
    $birthday = $row['birthday']; // Changed from 'dob' to 'birthday'
    $age = $row['age'];
    $gender = $row['gender'];
    $number = $row['contact_number'];
    $address = $row['address'];
    $email = $row['email'];

    // Error variables
    $firstname_err = $lastname_err = $birthday_err = $age_err = $gender_err = $number_err = $address_err = "";

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Sanitize and validate input
        if (empty(trim($_POST['firstname']))) {
            $firstname_err = "Please enter your first name.";
        } else {
            $firstname = trim($_POST['firstname']);
        }

        if (empty(trim($_POST['lastname']))) {
            $lastname_err = "Please enter your last name.";
        } else {
            $lastname = trim($_POST['lastname']);
        }

        if (empty(trim($_POST['dob']))) {
            $birthday_err = "Please select your date of birth.";
        } else {
            $birthday = trim($_POST['dob']); // Maps to the 'birthday' column in the DB
        }

        if (empty(trim($_POST['age']))) {
            $age_err = "Please enter your age.";
        } else {
            $age = trim($_POST['age']);
        }

        if (empty(trim($_POST['gender']))) {
            $gender_err = "Please select your gender.";
        } else {
            $gender = trim($_POST['gender']);
        }

        if (empty(trim($_POST['number']))) {
            $number_err = "Please enter your phone number.";
        } elseif (!preg_match('/^[0-9]{10,15}$/', trim($_POST['number']))) {
            $number_err = "Please enter a valid phone number.";
        } else {
            $number = trim($_POST['number']);
        }

        if (empty(trim($_POST['address']))) {
            $address_err = "Please enter your address.";
        } else {
            $address = trim($_POST['address']);
        }

        // If no errors, update the database
        if (empty($firstname_err) && empty($lastname_err) && empty($birthday_err) && empty($age_err) && empty($gender_err) && empty($number_err) && empty($address_err)) {
            $sql_update = "UPDATE users SET first_name = ?, last_name = ?, birthday = ?, age = ?, gender = ?, contact_number = ?, address = ? WHERE user_id = ?";
            
            if ($stmt = mysqli_prepare($link, $sql_update)) {
                mysqli_stmt_bind_param($stmt, "sssssssi", $firstname, $lastname, $birthday, $age, $gender, $number, $address, $_SESSION['id']);
                
                if (mysqli_stmt_execute($stmt)) {
                    echo "<script>
                        window.onload = function() {
                            swal({
                                title: 'Success!',
                                text: 'Profile updated successfully.',
                                icon: 'success',
                                button: 'OK'
                            }).then(() => {
                                window.location.href = 'user-profile';
                            });
                        };
                    </script>";
                } else {
                    echo "<script>
                        window.onload = function() {
                            swal({
                                title: 'Error!',
                                text: 'Could not update the profile. Please try again later.',
                                icon: 'error',
                                button: 'OK'
                            });
                        };
                    </script>";
                }              

                mysqli_stmt_close($stmt);
            }
        }
    }
} else {
    header("location: login");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "partials/header.php"; ?>
</head>

<body>
    <div class="container-scroller">
        <?php include "partials/user-heading.php"; ?>

        <div class="container-fluid page-body-wrapper">

            <?php include "partials/user-navbar.php"; ?>

            <div class="main-panel">
                
                <div class="content-wrapper">
                    <h2>My Profile</h2>
                    <form class="pt-3" method="post">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <input type="text"
                                        class="form-control <?php echo (!empty($firstname_err)) ? 'is-invalid' : ''; ?> form-control-lg"
                                        name="firstname"
                                        placeholder="Firstname"
                                        value="<?php echo htmlspecialchars($firstname); ?>"
                                        style="text-transform: capitalize;">
                                    <span class="invalid-feedback"><?php echo $firstname_err; ?></span>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <input type="text"
                                        class="form-control <?php echo (!empty($lastname_err)) ? 'is-invalid' : ''; ?> form-control-lg"
                                        name="lastname"
                                        placeholder="Lastname"
                                        value="<?php echo htmlspecialchars($lastname); ?>"
                                        style="text-transform: capitalize;">
                                    <span class="invalid-feedback"><?php echo $lastname_err; ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="date" 
                                class="form-control <?php echo (!empty($birthday_err)) ? 'is-invalid' : ''; ?> form-control-lg" 
                                name="dob" 
                                placeholder="Date of Birth"
                                value="<?php echo htmlspecialchars($birthday); ?>">
                            <span class="invalid-feedback"><?php echo $birthday_err; ?></span>
                        </div>
                        <div class="form-group">
                            <input type="number" 
                                class="form-control <?php echo (!empty($age_err)) ? 'is-invalid' : ''; ?> form-control-lg" 
                                name="age" 
                                placeholder="Age"
                                value="<?php echo htmlspecialchars($age); ?>">
                            <span class="invalid-feedback"><?php echo $age_err; ?></span>
                        </div>
                        <div class="form-group">
                            <select name="gender" 
                                    class="form-select <?php echo (!empty($gender_err)) ? 'is-invalid' : ''; ?> form-control-lg">
                                <option value="" disabled <?php echo empty($gender) ? 'selected' : ''; ?>>Gender</option>
                                <option value="Male" <?php echo ($gender === "Male") ? 'selected' : ''; ?>>Male</option>
                                <option value="Female" <?php echo ($gender === "Female") ? 'selected' : ''; ?>>Female</option>
                            </select>
                            <span class="invalid-feedback"><?php echo $gender_err; ?></span>
                        </div>
                        <div class="form-group">
                            <input type="text" 
                                class="form-control <?php echo (!empty($number_err)) ? 'is-invalid' : ''; ?> form-control-lg" 
                                name="number" 
                                placeholder="Phone Number"
                                value="<?php echo htmlspecialchars($number); ?>">
                            <span class="invalid-feedback"><?php echo $number_err; ?></span>
                        </div>
                        <div class="form-group">
                            <textarea name="address" 
                                    class="form-control <?php echo (!empty($address_err)) ? 'is-invalid' : ''; ?> form-control-lg" 
                                    placeholder="Address"><?php echo htmlspecialchars($address); ?></textarea>
                            <span class="invalid-feedback"><?php echo $address_err; ?></span>
                        </div>
                        <div class="form-group">
                            <input disabled type="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?> form-control-lg" name="email" placeholder="Email" value="<?php echo $email; ?>">
                            <span class="invalid-feedback"><?php echo $email_err; ?></span>
                        </div>
                        <div class="mt-3">
                            <button type="submit" name="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn mb-4">UPDATE PROFILE</button>
                        </div>
                    </form>
                </div>
                <?php include "partials/footer.php"; ?>
            </div>

        </div>
    </div>
    <?php include "partials/scripts.php"; ?>
</body>

</html>