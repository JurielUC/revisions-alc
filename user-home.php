<?php
session_start();

require_once "connectDB.php";

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    $sql = "SELECT * FROM users WHERE user_id = '" . $_SESSION['id'] . "'";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);
    $user_id = $row['user_id'];

    $active = "home";
} else {
    header("location: login");
    exit;
}

if (isset($_GET['cancel_appointment_id'])) {
    $appointment_id = mysqli_real_escape_string($link, $_GET['cancel_appointment_id']);
    $cancel_query = "UPDATE appointments SET status = 3 WHERE appointment_id = '$appointment_id' AND user_id = '$user_id' AND status = 0";
    mysqli_query($link, $cancel_query);
    header("location: user-home");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "partials/header.php"; ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
</head>

<body>
    <div class="container-scroller">
        <?php include "partials/user-heading.php"; ?>

        <div class="container-fluid page-body-wrapper">

            <?php include "partials/user-navbar.php"; ?>

            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="title">
                                    <h4 class="card-title">Appointments</h4>
                                    <p class="card-description">
                                        My appointments list
                                    </p>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <form method="GET" action="">
                                            <div class="form-group">
                                                <label for="serviceFilter" style="text-wrap: nowrap;">Filter by Service</label>
                                                <select name="service" id="serviceFilter" class="form-select" style="width: 220px; font-size: 12px;" onchange="this.form.submit()">
                                                    <option value="">All</option>
                                                    <option value="Laboratory" <?php if (isset($_GET['service']) && $_GET['service'] == "Laboratory") echo 'selected'; ?>>Laboratory</option>
                                                    <option value="X-RAY" <?php if (isset($_GET['service']) &&  $_GET['service'] == "X-RAY") echo 'selected'; ?>>X-Ray</option>
                                                    <option value="2D Echo" <?php if (isset($_GET['service']) && $_GET['service'] == "2D Echo") echo 'selected'; ?>>2D Echo</option>
                                                    <option value="Ultrasound" <?php if (isset($_GET['service']) && $_GET['service'] == "Ultrasound") echo 'selected'; ?>>Ultrasound</option>
                                                    <option value="ECG" <?php if (isset($_GET['service']) && $_GET['service'] == "ECG") echo 'selected'; ?>>ECG</option>
                                                </select>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="appointmentTable" class="table table-hover">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Appointment ID</th>
                                            <th>Patient Name</th>
                                            <th>Mobile Number</th>
                                            <th>Service</th>
                                            <th>Appointment Date</th>
                                            <th>Status</th>
                                            <th>Action</th> <!-- Added action column for view details -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $serviceFilter = isset($_GET['service']) ? trim($_GET['service']) : '';
                                        $user_id = mysqli_real_escape_string($link, $user_id); // Sanitize user_id

                                        $sql1 = "SELECT * FROM appointments WHERE user_id='$user_id'";

                                        if (!empty($serviceFilter)) {
                                            $serviceFilter = mysqli_real_escape_string($link, $serviceFilter); // Sanitize serviceFilter
                                            $sql1 .= " AND service = '$serviceFilter'";
                                        }

                                        $r = mysqli_query($link, $sql1);

                                        if ($r->num_rows > 0) {
                                            while ($row1 = mysqli_fetch_assoc($r)) {
                                        ?>
                                                <tr class="text-center">
                                                    <td>
                                                        <?php 
                                                            echo strlen($row1['appointment_id']) > 1 
                                                                ? "AP0" . $row1['appointment_id'] 
                                                                : "AP00" . $row1['appointment_id'];
                                                        ?>
                                                    </td>
                                                    <td><?php echo $row['first_name']; ?> <?php echo $row['last_name']; ?></td>
                                                    <td><?php if ($row['contact_number'] == "") {
                                                            echo 'N/A';
                                                        } else {
                                                            echo $row['contact_number'];
                                                        } ?>
                                                    </td>
                                                    <td><?php echo $row1['service']; ?></td>
                                                    <td>
                                                        <?php $formattedDate = date("l, F j Y - h:i A", strtotime($row1["datetime"]));
                                                        echo $formattedDate; ?>
                                                    </td>

                                                    <td>
                                                        <?php if ($row1['status'] == 0) {
                                                            echo '<label class="badge badge-warning">Pending</label>';
                                                        } elseif ($row1['status'] == 1) {
                                                            echo '<label class="badge badge-success">Approved</label>';
                                                        } elseif ($row1['status'] == 2) {
                                                            echo '<label class="badge badge-danger">Rejected</label>';
                                                        } elseif ($row1['status'] == 3) {
                                                            echo '<label class="badge badge-dark">Cancelled</label>';
                                                        } ?>
                                                    </td>

                                                    <td>
                                                        <!-- View Details Button -->
                                                        <button class="btn btn-info" data-toggle="modal" data-target="#appointmentModal<?php echo $row1['appointment_id']; ?>">View</button>
                                                        <?php
                                                            if ($row1['status'] == 0) { // Only allow cancellation if status is Pending (0)
                                                                echo '<a href="#" class="btn btn-danger" data-toggle="modal" data-target="#cancelConfirmationModal" onclick="setCancelLink(' . $row1['appointment_id'] . ')">Cancel</a>';
                                                            }                                                            
                                                        ?>
                                                    </td>
                                                </tr>

                                                <!-- Modal for Appointment Details -->
                                                <div class="modal fade" id="appointmentModal<?php echo $row1['appointment_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">
                                                                    Appointment Details
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body py-2">
                                                                <strong>Patient Name:</strong> <?php echo $row['first_name']; ?> <?php echo $row['last_name']; ?><br>
                                                                <strong>Mobile Number:</strong> <?php echo $row['contact_number'] ?: 'N/A'; ?><br>
                                                                <strong>Service:</strong> <?php echo $row1['service']; ?><br>
                                                                <strong>Appointment Date:</strong> <?php echo date("l, F j Y - h:i A", strtotime($row1["datetime"])); ?><br>
                                                                <strong>Status:</strong> 
                                                                <?php 
                                                                    if ($row1['status'] == 0) echo 'Pending';
                                                                    elseif ($row1['status'] == 1) echo 'Approved';
                                                                    elseif ($row1['status'] == 2) echo 'Rejected';
                                                                    elseif ($row1['status'] == 3) echo 'Cancelled';
                                                                ?>
                                                                <!-- <br><br>
                                                                <strong>Confirmation Details:</strong><br>
                                                                <ul>
                                                                    <li><strong>Doctor Assigned:</strong> <?php echo $row1['doctor_name']; ?></li>
                                                                    <li><strong>Notes:</strong> <?php echo $row1['notes']; ?></li>
                                                                </ul> -->
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include "partials/footer.php"; ?>
            </div>

        </div>
    </div>
    <?php include "partials/scripts.php"; ?>

    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <style>
        #appointmentTable thead .sorting:before,
        #appointmentTable thead .sorting:after,
        #appointmentTable thead .sorting_asc:before,
        #appointmentTable thead .sorting_asc:after,
        #appointmentTable thead .sorting_desc:before,
        #appointmentTable thead .sorting_desc:after {
            display: none;
        }

        div.dataTables_length {
            display: flex;
            align-items: center;
        }

        div.dataTables_length label {
            margin-right: 10px;
            display: flex;
            align-items: center;
        }

        div.dataTables_length select {
            margin-left: 5px;
        }
    </style>
    <script>
        $(document).ready(function() {
            $('#appointmentTable').DataTable({
                "paging": true,
                "ordering": true,
                "info": true,
                "searching": true
            });
        });
    </script>

    <div class="modal fade" id="cancelConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="cancelConfirmationLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cancelConfirmationLabel">Cancel Appointment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body py-2">
                    Are you sure you want to cancel this appointment? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a id="confirmCancelButton" href="#" class="btn btn-danger">Confirm</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function setCancelLink(appointmentId) {
            const cancelLink = `user-home?cancel_appointment_id=${appointmentId}`;
            document.getElementById('confirmCancelButton').setAttribute('href', cancelLink);
        }
    </script>
</body>

</html>
