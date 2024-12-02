<?php
session_start();

require_once "connectDB.php";

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    $sql = "SELECT * FROM users WHERE user_id = '" . $_SESSION['id'] . "'";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);

    $active = "appointment";
} else {
    header("location: login");
    exit;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "partials/header.php"; ?>
    <link href="css/multi-step-form.css" rel="stylesheet">
</head>

<body>
    <div class="container-scroller">
        <?php include "partials/user-heading.php"; ?>

        <div class="container-fluid page-body-wrapper">

            <?php include "partials/user-navbar.php"; ?>

            <?php

            $user_id = $row['user_id'];
            $service = $date = $time = $datetime = $subservice = "";
            $service_err = $date_err = $time_err = $datetime_err = $subservice_err = "";
            $status = 0;
            $user_active = 0;
            $staff_active = 0;

            if (isset($_POST["submit"])) {
                if (empty(trim($_POST["service"]))) {
                    $service_err = "Please select a service.";
                } else {
                    $service = mysqli_real_escape_string($link, $_POST["service"]);

                    if ($service == "Laboratory") {
                        if (empty(trim($_POST["subservice"]))) {
                            $subservice_err = "Please select a subservice.";
                        } else {
                            $subservice = mysqli_real_escape_string($link, $_POST["subservice"]);
                        }
                    }
                }

                if (empty(trim($_POST["date"]))) {
                    $date_err = "Please select an appointment date.";
                } elseif (empty(trim($_POST["time"]))) {
                    $time_err = "Please select an appointment time.";
                } else {
                    $date = mysqli_real_escape_string($link, $_POST["date"]);
                    $time = mysqli_real_escape_string($link, $_POST["time"]);
                    $datetime = $date . ' ' . $time;

                    // $check_query = "SELECT * FROM appointments WHERE datetime = ?";
                    // if ($stmt = mysqli_prepare($link, $check_query)) {
                    //     mysqli_stmt_bind_param($stmt, "s", $datetime);
                    //     mysqli_stmt_execute($stmt);
                    //     mysqli_stmt_store_result($stmt);

                    //     if (mysqli_stmt_num_rows($stmt) > 0) {
                    //         $datetime_err = "This date and time is already booked.";
                    //     }
                    //     mysqli_stmt_close($stmt);
                    // } else {
                    //     echo "Error: Could not prepare the database query.";
                    // }
                }

                if (empty($service_err) && empty($subservice_err) && empty($datetime_err)) {

                    $sql = "INSERT INTO appointments (user_id, service, subservice, datetime, status, user_active, staff_active) VALUES (?, ?, ?, ?, ?, ?, ?)";

                    if ($stmt = mysqli_prepare($link, $sql)) {
                        mysqli_stmt_bind_param($stmt, "isssiii", $param_user_id, $param_service, $param_subservice, $param_datetime, $param_status, $param_user_active, $param_staff_active);

                        $param_user_id = $user_id;
                        $param_service = $service;
                        $param_subservice = $subservice;
                        $param_datetime = $datetime;
                        $param_status = $status;
                        $param_user_active = $user_active;
                        $param_staff_active = $staff_active;

                        if (mysqli_stmt_execute($stmt)) {

                            $formattedDate = date("l, F j Y - h:i A", strtotime($datetime));

                            echo "<script>swal({
                                    title: 'Success!',
                                    text: 'Appointment Successful! Your Appointment Scheduled on $formattedDate',
                                    icon: 'success',
                                    closeOnClickOutside: false,
                                    button: false
                                });</script>";

            ?>
                            <meta http-equiv="Refresh" content="1; url=user-appointment">
            <?php

                        } else {
                            echo "<script>swal({
                                title: 'Oops!',
                                text: 'Something went wrong. Please try again later.',
                                icon: 'warning',
                                button: 'Ok',
                            });</script>";
                        }

                        mysqli_stmt_close($stmt);
                    }
                } elseif (!empty($datetime_err)) {
                    echo "<script>swal({
                        title: 'Oops!',
                        text: '$datetime_err Unable to continue.',
                        icon: 'warning',
                        button: 'Ok',
                    });</script>";
                } else {
                    echo "<script>swal({
                        title: 'Invalid!',
                        text: 'Oops! looks like some credentials are not yet filled! Unable to continue.',
                        icon: 'warning',
                        button: 'Ok',
                    });</script>";
                }
            }

            ?>

            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                        <div class="title" style="margin-left: 30px;">
                            <h2><strong>Appointment</strong></h2>
                            <p>Accuracy Laboratory Corporation</p>
                            <p><i class="text-danger"><b>Note: To schedule an appointment, please select a date to view the available time slots. Strictly no cancellation of appointments.</b></i></p>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mx-0">
                                <form id="msform" method="post" enctype="multipart/form-data">
                                    <ul id="progressbar" style="margin-left: -16px;">
                                        <li class="active" id="guide"><strong>GUIDE</strong></li>
                                        <li id="services"><strong>SERVICES</strong></li>
                                        <li id="datetime"><strong>DATE & TIME</strong></li>
                                        <li id="confirmation"><strong>CONFIRMATION</strong></li>
                                    </ul>

                                    <fieldset>
                                        <input type="button" name="next" class="next btn btn-primary"
                                            value="Next" />
                                        <div class="form-card">
                                            <div class="card">
                                                <div class="card-header">Guide</div>
                                                <div class="card-body">
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-md-6 text-center">
                                                                <i class="fa fa-list"
                                                                    style="font-size: 60px; color: #a4c14b;"></i>
                                                                <h3><strong>SERVICES</strong></h3>
                                                                <p>Browse through the list of available services and pick the one you're interested in.</p>
                                                            </div>
                                                            <div class="col-md-6 text-center">
                                                                <i class="fa fa-calendar"
                                                                    style="font-size: 60px; color: #a4c14b;"></i>
                                                                <h3><strong>DATE & TIME</strong></h3>
                                                                <p>Choose a convenient date and time from the available slots and confirm your booking.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <input type="button" name="previous" class="previous btn btn-secondary" value="Previous" />
                                        <input type="button" name="next" class="next btn btn-primary" value="Next" id="nextBtn" disabled />
                                        <div class="form-card">
                                            <div class="card">
                                                <div class="card-header">Services</div>
                                                <div class="card-body">
                                                    <div class="row mb-4">
                                                        <div class="col-md-12">
                                                            <div class="">
                                                                <label class="form-label" for="service">Please select service</label>
                                                                <select name="service" id="service" class="form-control select 
                                                                <?php echo (!empty($service_err)) ? 'is-invalid' : ''; ?> form-control-user" required>
                                                                    <option value="">Please select a service type:</option>
                                                                    <optgroup label="Services:">
                                                                        <option value="Laboratory" <?php if ($service === 'Laboratory') echo 'selected'; ?>>Laboratory</option>
                                                                        <option value="X-RAY" <?php if ($service === 'X-RAY') echo 'selected'; ?>>X-Ray</option>
                                                                        <option value="2D Echo" <?php if ($service === '2D Echo') echo 'selected'; ?>>2D Echo</option>
                                                                        <option value="Ultrasound" <?php if ($service === 'Ultrasound') echo 'selected'; ?>>Ultrasound</option>
                                                                        <option value="ECG" <?php if ($service === 'ECG') echo 'selected'; ?>>ECG</option>
                                                                    </optgroup>
                                                                </select>
                                                                <span class="invalid-feedback"><?php echo $service_err; ?></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-4" id="subservice-container" style="display: none;">
                                                        <div class="col-md-12">
                                                            <div class="">
                                                                <label class="form-label" for="subservice">Please select a sub-service</label>
                                                                <select name="subservice" id="subservice" class="form-control select 
                                                                <?php echo (!empty($subservice_err)) ? 'is-invalid' : ''; ?> form-control-user">
                                                                    <option value="">Select a sub-service</option>
                                                                    <optgroup label="Laboratory Services:">
                                                                        <option value="Chem 6">Chem 6</option>
                                                                        <option value="Chem 7">Chem 7</option>
                                                                        <option value="Chem 8">Chem 8</option>
                                                                        <option value="Chem 9">Chem 9</option>
                                                                        <option value="Chem 10">Chem 10</option>
                                                                        <option value="Chem 13">Chem 13</option>
                                                                        <option value="Urinalysis">Urinalysis</option>
                                                                        <option value="Fecalysis">Fecalysis</option>
                                                                        <option value="Complete Blood Count">Complete Blood Count</option>
                                                                    </optgroup>
                                                                </select>
                                                                <span class="invalid-feedback"><?php echo $subservice_err; ?></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <script>
                                            function checkSelection() {
                                                var service = document.getElementById('service').value;
                                                var subservice = document.getElementById('subservice').value;
                                                var nextButton = document.getElementById('nextBtn');

                                                if (service && (service !== 'Laboratory' || (service === 'Laboratory' && subservice))) {
                                                    nextButton.disabled = false;
                                                } else {
                                                    nextButton.disabled = true;
                                                }
                                            }

                                            document.getElementById('service').addEventListener('change', function() {
                                                var selectedService = this.value;
                                                var subserviceContainer = document.getElementById('subservice-container');

                                                if (selectedService === 'Laboratory') {
                                                    subserviceContainer.style.display = 'block';
                                                } else {
                                                    subserviceContainer.style.display = 'none';
                                                }

                                                checkSelection();
                                            });

                                            document.getElementById('subservice').addEventListener('change', checkSelection);
                                        </script>
                                    </fieldset>


                                    <fieldset>
                                        <input type="button" name="previous" class="previous btn btn-secondary" value="Previous" />
                                        <input type="button" name="next" class="next btn btn-primary" id="nextButton" value="Next" disabled />
                                        <div class="form-card">
                                            <div class="card">
                                                <div class="card-header">Schedule</div>
                                                <div class="card-body">
                                                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
                                                    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
                                                    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.js"></script>

                                                    <style>
                                                        .cell {
                                                            border: 1px solid #a4c14b;
                                                            margin: 2px;
                                                            cursor: pointer;
                                                        }

                                                        .cell:hover {
                                                            border: 1px solid #3D5AFE;
                                                        }

                                                        .cell.select {
                                                            background-color: #3D5AFE;
                                                            color: #a4c14b;
                                                        }

                                                        .time-slot.active {
                                                            background-color: #a4c14b;
                                                            cursor: pointer;
                                                        }

                                                        .time-slot {
                                                            cursor: pointer;
                                                        }
                                                    </style>

                                                    <div class="time-schedule text-center">
                                                        <div class="row mb-2">
                                                            <div class="col">
                                                                <div class="row justify-content-center mx-0">
                                                                    <div class="col-lg-10">
                                                                        <div class="card border-0">
                                                                            <div class="card-header card-headerstyle">
                                                                                <div class="mx-0 mb-0 row justify-content-sm-center justify-content-start px-1">
                                                                                    <label class="form-label" for="date">Please Select Date</label>
                                                                                    <input type="date" name="date" id="date" class="form-control form-control-user" required />
                                                                                    <input type="hidden" name="time" id="time" class="form-control form-control-user" required />
                                                                                </div>
                                                                            </div>

                                                                            <script>
                                                                                const today = new Date().toISOString().split('T')[0];
                                                                                const dateInput = document.getElementById('date');
                                                                                dateInput.min = today;

                                                                                // Function to check if both date and time are selected
                                                                                function checkFormCompletion() {
                                                                                    const selectedDate = dateInput.value;
                                                                                    const selectedTime = document.getElementById('time').value;
                                                                                    const nextButton = document.getElementById('nextButton');

                                                                                    if (selectedDate && selectedTime) {
                                                                                        nextButton.disabled = false;
                                                                                    } else {
                                                                                        nextButton.disabled = true;
                                                                                    }
                                                                                }

                                                                                // Event listener for date change
                                                                                dateInput.addEventListener('change', function() {
                                                                                    const selectedDate = this.value;
                                                                                    const service = document.getElementById('service').value;

                                                                                    if (selectedDate) {
                                                                                        $.ajax({
                                                                                            url: 'fetch_available_slots.php',
                                                                                            type: 'POST',
                                                                                            data: { date: selectedDate, service: service },
                                                                                            success: function(response) {
                                                                                                $('#time_slots').html(response);
                                                                                            },
                                                                                            error: function(xhr, status, error) {
                                                                                                console.error('Error fetching available times:', error);
                                                                                            }
                                                                                        });
                                                                                    } else {
                                                                                        $.ajax({
                                                                                            url: 'fetch_available_slots.php',
                                                                                            type: 'POST',
                                                                                            data: { date: '' },
                                                                                            success: function(response) {
                                                                                                $('#time_slots').html(response);
                                                                                            },
                                                                                            error: function(xhr, status, error) {
                                                                                                console.error('Error fetching available times:', error);
                                                                                            }
                                                                                        });
                                                                                    }

                                                                                    // Check if both date and time are selected
                                                                                    checkFormCompletion();
                                                                                });

                                                                                $.ajax({
                                                                                    url: 'fetch_available_slots.php',
                                                                                    type: 'POST',
                                                                                    data: { date: '' },
                                                                                    success: function(response) {
                                                                                        $('#time_slots').html(response);
                                                                                    },
                                                                                    error: function(xhr, status, error) {
                                                                                        console.error('Error fetching available times:', error);
                                                                                    }
                                                                                });

                                                                                // Event listener for time slot selection
                                                                                $(document).on('click', '.time-slot', function() {
                                                                                    $('.time-slot').removeClass('active');
                                                                                    $(this).addClass('active');

                                                                                    const selectedTime12h = $(this).val();
                                                                                    const selectedTime24h = convertTo24HourFormat(selectedTime12h);
                                                                                    $('#time').val(selectedTime24h);

                                                                                    // Check if both date and time are selected
                                                                                    checkFormCompletion();
                                                                                    updateConfirmationDetails();
                                                                                });

                                                                                // Convert 12-hour time to 24-hour time
                                                                                function convertTo24HourFormat(time12h) {
                                                                                    const time = time12h.trim().toUpperCase();
                                                                                    const isPM = time.includes('PM');
                                                                                    let [hours, minutes] = time.replace(/(AM|PM)/gi, '').trim().split(':');
                                                                                    hours = parseInt(hours, 10);
                                                                                    minutes = parseInt(minutes, 10);
                                                                                    if (isPM && hours < 12) hours += 12;
                                                                                    else if (!isPM && hours === 12) hours = 0;
                                                                                    return ('0' + hours).slice(-2) + ':' + ('0' + minutes).slice(-2) + ':00';
                                                                                }
                                                                            </script>

                                                                            <div class="card-body">
                                                                                <div class="row text-center mx-0" id="time_slots">
                                                                                    <!-- Time slots will be populated dynamically via JavaScript -->
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <input type="button" name="previous" class="previous btn btn-secondary"
                                            value="No, Review Information" />
                                        <input class="btn btn-primary" type="submit" name="submit"
                                            value="Yes, Reserve Now" />
                                        <div class="form-card">
                                            <div class="card">
                                                <div class="card-header">Confirmation</div>
                                                <div class="card-body">
                                                    <h3><strong>Confirm Your Information</strong></h3>
                                                    <p>Please review your information for accuracy before proceeding to ensure all details are correct. Are you confident the information provided is accurate?</p>

                                                    <div id="confirmationDetails" class="mt-3">
                                                        <p><strong>Service:</strong> <span id="confirmService">N/A</span></p>
                                                        <p><strong>Sub Service:</strong> <span id="confirmSubService">N/A</span></p>
                                                        <p><strong>Date:</strong> <span id="confirmDate">N/A</span></p>
                                                        <p><strong>Time:</strong> <span id="confirmTime">N/A</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <script>
                                            // Function to update confirmation details
                                            function updateConfirmationDetails() {
                                                const service = document.getElementById('service').value;
                                                const subservice = document.getElementById('subservice').value;
                                                const date = document.getElementById('date').value;
                                                const time = document.getElementById('time').value;

                                                // Convert the date to English format (e.g., December 7, 2024)
                                                const formattedDate = formatDate(date);

                                                // Convert the time to 12-hour format (e.g., 2:30 PM)
                                                const formattedTime = formatTime(time);

                                                // Update confirmation section
                                                document.getElementById('confirmService').textContent = service || 'N/A';
                                                document.getElementById('confirmSubService').textContent = subservice || 'N/A';
                                                document.getElementById('confirmDate').textContent = formattedDate || 'N/A';
                                                document.getElementById('confirmTime').textContent = formattedTime || 'N/A';
                                            }

                                            // Function to format the date into a human-readable English format
                                            function formatDate(date) {
                                                if (!date) return 'N/A';

                                                const options = { year: 'numeric', month: 'long', day: 'numeric' };
                                                const dateObj = new Date(date); // Convert the date string into a Date object
                                                return dateObj.toLocaleDateString('en-US', options); // Format as Month Day, Year (e.g., December 7, 2024)
                                            }

                                            // Function to convert 24-hour time format to 12-hour format (e.g., 14:30 to 2:30 PM)
                                            function formatTime(time) {
                                                if (!time) return 'N/A';

                                                const [hour, minute] = time.split(':'); // Split the time into hours and minutes
                                                let hour12 = parseInt(hour, 10); // Convert hour to an integer
                                                const ampm = hour12 >= 12 ? 'PM' : 'AM'; // Determine AM or PM

                                                // Convert hour to 12-hour format
                                                hour12 = hour12 % 12;
                                                hour12 = hour12 ? hour12 : 12; // Hour 0 should be 12 for 12 AM

                                                return `${hour12}:${minute} ${ampm}`; // Return formatted time (e.g., 2:30 PM)
                                            }

                                            // Attach event listeners to update details dynamically
                                            document.getElementById('date').addEventListener('change', updateConfirmationDetails);
                                            document.getElementById('time').addEventListener('change', updateConfirmationDetails);

                                            // Update service and subservice (if they change dynamically)
                                            document.getElementById('service').addEventListener('change', updateConfirmationDetails);
                                            document.getElementById('subservice').addEventListener('change', updateConfirmationDetails);

                                            // Call updateConfirmationDetails on page load (optional, in case values are pre-filled)
                                            updateConfirmationDetails();
                                        </script>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include "partials/footer.php"; ?>
            </div>

        </div>
    </div>
    <script src="js/multi-step-form.js"></script>
    <?php include "partials/scripts.php"; ?>
    <script>
        document.querySelectorAll('.next').forEach(button => {
            button.addEventListener('click', function (event) {
                let currentFieldset = this.closest('fieldset');
                let isValid = true;

                currentFieldset.querySelectorAll('input, select').forEach(input => {
                    if (input.hasAttribute('required') && !input.value.trim()) {
                        input.classList.add('is-invalid');
                        isValid = false;
                    } else {
                        input.classList.remove('is-invalid');
                    }
                });

                if (!isValid) {
                    event.preventDefault();
                }
            });
        });
    </script>
</body>

</html>