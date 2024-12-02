<?php
session_start();

require_once "connectDB.php";

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    $sql = "SELECT * FROM admins WHERE admin_id = '" . $_SESSION['id'] . "'";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);

    $active = "patientrecords";
} else {
    header("location: admin-login");
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
        <?php include "partials/admin-heading.php"; ?>

        <div class="container-fluid page-body-wrapper">

            <?php include "partials/admin-navbar.php"; ?>

            <style>
                .card-description {
                    font-size: 38px !important;
                    font-weight: 800 !important;
                    color: black !important;
                }

                .card-total-patient {
                    background-color: #f8d7da;
                    /* Light red */
                    color: #721c24;
                }

                .card-laboratory {
                    background-color: #d4edda;
                    /* Light green */
                    color: #155724;
                }

                .card-xray {
                    background-color: #cce5ff;
                    /* Light blue */
                    color: #004085;
                }

                .card-echo {
                    background-color: #fff3cd;
                    /* Light yellow */
                    color: #856404;
                }

                .card-ultrasound {
                    background-color: #e2e3e5;
                    /* Light gray */
                    color: #383d41;
                }

                .card-ecg {
                    background-color: #d1ecf1;
                    /* Light cyan */
                    color: #0c5460;
                }
            </style>

            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row" id="appointmentCounts">
                        <div class="col-md-4">
                            <div class="card card-total-patient">
                                <div class="card-body">
                                    <h2 class="card-title"><strong>Total Patient Records</strong></h2>
                                    <p class="card-description" id="totalCount">#</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-laboratory">
                                <div class="card-body">
                                    <h2 class="card-title"><strong>Laboratory</strong></h2>
                                    <p class="card-description" id="laboratoryCount">#</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-xray">
                                <div class="card-body">
                                    <h2 class="card-title"><strong>X-ray</strong></h2>
                                    <p class="card-description" id="xrayCount">#</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mt-4">
                            <div class="card card-echo">
                                <div class="card-body">
                                    <h2 class="card-title"><strong>2D Echo</strong></h2>
                                    <p class="card-description" id="echoCount">#</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mt-4">
                            <div class="card card-ultrasound">
                                <div class="card-body">
                                    <h2 class="card-title"><strong>Ultrasound</strong></h2>
                                    <p class="card-description" id="ultrasoundCount">#</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mt-4">
                            <div class="card card-ecg">
                                <div class="card-body">
                                    <h2 class="card-title"><strong>ECG</strong></h2>
                                    <p class="card-description" id="ecgCount">#</p>
                                </div>
                            </div>
                        </div>


                        <script>
                            async function fetchServiceCounts() {
                                try {
                                    const response = await fetch('fetch-service-counts.php');
                                    const data = await response.json();

                                    document.getElementById('totalCount').innerText = data.total;
                                    document.getElementById('laboratoryCount').innerText = data.laboratory;
                                    document.getElementById('xrayCount').innerText = data.xray;
                                    document.getElementById('echoCount').innerText = data['2d_echo']; 
                                    document.getElementById('ultrasoundCount').innerText = data.ultrasound;
                                    document.getElementById('ecgCount').innerText = data.ecg;
                                } catch (error) {
                                    console.error("Error fetching service counts:", error);
                                }
                            }

                            window.onload = fetchServiceCounts;
                        </script>


                        <div class="col-md-12 mt-4">
                            <div class="card">
                                <div class="card-body">
                                    <div style="display:flex; justify-content: space-between">
                                        <div>
                                            <h4 class="card-title">Patient Records</h4>
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
                                                    <th>Result ID</th>
                                                    <th>Patient Name</th>
                                                    <th>Mobile Number</th>
                                                    <th>Email</th>
                                                    <th>Record Date Created</th>
                                                    <th>Service</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $serviceFilter = isset($_GET['service']) ? trim($_GET['service']) : '';
                                                $sql1 = "SELECT * FROM patient_records";
                                                
                                                if ($serviceFilter !== '') {
                                                    $serviceFilter = mysqli_real_escape_string($link, $serviceFilter);
                                                    $sql1 .= " WHERE service = '$serviceFilter'";
                                                }

                                                $r = mysqli_query($link, $sql1);

                                                if ($r->num_rows > 0) {
                                                    while ($row1 = mysqli_fetch_assoc($r)) {
                                                        $user_id = $row1['user_id'];
                                                        $sql3 = "SELECT * FROM users WHERE user_id = $user_id";
                                                        $result3 = mysqli_query($link, $sql3);
                                                        $row3 = mysqli_fetch_assoc($result3);

                                                        $fbs = $row1['fbs'];
                                                        $cholesterol = $row1['cholesterol'];
                                                        $triglycerides = $row1['triglycerides'];
                                                        $uric_acid = $row1['uric_acid'];
                                                        $creatinine = $row1['creatinine'];
                                                        $sgpt_alt = $row1['sgpt_alt'];
                                                        $sgot_ast = $row1['sgot_ast'];
                                                        $hdl = $row1['hdl'];
                                                        $ldl = $row1['ldl'];
                                                        $bun = $row1['bun'];
                                                        $service = $row1['service'];
                                                        $sub_service = $row1['subservice'];

                                                        $na = $row1['na'];
                                                        $k = $row1['k'];
                                                        $cl = $row1['cl'];

                                                        $color = $row1['color'];
                                                        $ph_reaction = $row1['ph_reaction'];
                                                        $specific_gravity = $row1['specific_gravity'];
                                                        $albumin = $row1['albumin'];
                                                        $sugar = $row1['sugar'];
                                                        $consistency = $row1['consistency'];

                                                        $result_impression = $row1['result_impression'];

                                                        $transparency = $row1['transparency'];

                                                        $wbc = $row1['wbc'];
                                                        $rbc = $row1['rbc'];
                                                        $hematocrit = $row1['hematocrit'];
                                                        $hemoglobin = $row1['hemoglobin'];

                                                        $granulocytes = $row1['granulocytes'];
                                                        $lymphocytes = $row1['lymphocytes'];
                                                        $mid = $row1['mid'];
                                                        $platelet = $row1['platelet'];
                                                ?>
                                                        <tr class="text-center">
                                                            <td>
                                                                <?php 
                                                                    echo strlen($row1['patient_record_id']) > 1 
                                                                        ? "PR0" . $row1['patient_record_id'] 
                                                                        : "PR00" . $row1['patient_record_id'];
                                                                ?>
                                                            </td>
                                                            <td><?php echo $row3['first_name']; ?> <?php echo $row3['last_name']; ?></td>
                                                            <td><?php if ($row3['contact_number'] == "") {
                                                                    echo 'N/A';
                                                                } else {
                                                                    echo $row3['contact_number'];
                                                                } ?>
                                                            </td>
                                                            <td><?php echo $row3['email']; ?></td>
                                                            <td>
                                                                <?php $formattedDate = date("l, F j Y - h:i A", strtotime($row1["date_created"]));
                                                                echo $formattedDate; ?>
                                                            </td>

                                                            <td>
                                                                <?php echo $service; ?>
                                                                <?php 
                                                                    if ($service === 'Laboratory') {
                                                                        echo "<br /><span style='font-size: 12px;'>{$sub_service}</span>";
                                                                    }
                                                                ?>
                                                            </td>

                                                            <td>
                                                                <div class="d-inline">
                                                                    <a class="ml-1 action-icon" href="#" data-toggle="modal"
                                                                        type="button" data-target="#view-records-<?php echo $row1['patient_record_id'] ?>">
                                                                        <i class="ti-eye"></i> View
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                <?php

                                                        include 'view-records.php';
                                                    }
                                                }

                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
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
                "searching": true,
                "lengthMenu": [10, 25, 50],
                "pageLength": 10
            });
        });
    </script>
</body>

</html>