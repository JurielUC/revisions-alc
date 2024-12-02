<?php
session_start();

require_once "connectDB.php";

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    $sql = "SELECT * FROM admins WHERE admin_id = '" . $_SESSION['id'] . "'";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);

    $active = "patientflow";
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

                .card-total-appointments {
                    background-color: #f0e68c;
                    color: #6b4f1d;
                }

                .card-approved-appointments {
                    background-color: #98fb98;
                    color: #2d6b2d;
                }

                .card-cancelled-appointments {
                    background-color: #ffcccb;
                    color: #a33d3d;
                }
            </style>
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row" id="appointmentCounts">
                        <div class="col-md-4">
                            <div class="card card-total-appointments">
                                <div class="card-body">
                                    <h2 class="card-title"><strong>Total Appointments</strong></h2>
                                    <p class="card-description" id="totalAppointments">#</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-approved-appointments">
                                <div class="card-body">
                                    <h2 class="card-title"><strong>Approved Appointments</strong></h2>
                                    <p class="card-description" id="approvedAppointments">#</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-cancelled-appointments">
                                <div class="card-body">
                                    <h2 class="card-title"><strong>Cancelled Appointments</strong></h2>
                                    <p class="card-description" id="cancelledAppointments">#</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mt-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h2 class="card-title"><strong>Patient Flow</strong></h2>
                                        <div class="d-flex justify-content-end">
                                            <form class="mx-2">
                                                <div class="form-group">
                                                    <label for="yearFilter" style="text-wrap: nowrap;">Select Year</label>
                                                    <select id="yearFilter" class="form-select" style="width: 100px; font-size: 12px;"  onchange="updateChart()"></select>
                                                </div>
                                            </form>
                                            <form method="GET" action="">
                                                <div class="form-group">
                                                    <label for="serviceFilter" style="text-wrap: nowrap;">Filter by Service</label>
                                                    <select id="serviceFilter" name="service" class="form-select" style="width: 220px; font-size: 12px;">
                                                        <option value="">All</option>
                                                        <option value="Laboratory" <?php if (isset($_GET['service']) && $_GET['service'] == "Laboratory") echo 'selected'; ?>>Laboratory</option>
                                                        <option value="X-Ray" <?php if (isset($_GET['service']) && $_GET['service'] == "X-Ray") echo 'selected'; ?>>X-Ray</option>
                                                        <option value="2D Echo" <?php if (isset($_GET['service']) && $_GET['service'] == "2D Echo") echo 'selected'; ?>>2D Echo</option>
                                                        <option value="Ultrasound" <?php if (isset($_GET['service']) && $_GET['service'] == "Ultrasound") echo 'selected'; ?>>Ultrasound</option>
                                                        <option value="ECG" <?php if (isset($_GET['service']) && $_GET['service'] == "ECG") echo 'selected'; ?>>ECG</option>
                                                    </select>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <canvas id="myLineChart" style="height: 400px; width: 100%;"></canvas>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-12 mt-4">
                            <div class="card">
                                <div class="card-body">
                                    <div style="display:flex; justify-content: space-between">
                                        <div>
                                            <h4 class="card-title">Appointment List</h4>
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
                                                    <th>Appointment Date</th>
                                                    <th>Service</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $serviceFilter = isset($_GET['service']) ? trim($_GET['service']) : '';
                                                $sql1 = "SELECT * FROM appointments";
                                                
                                                if ($serviceFilter !== '') {
                                                    $serviceFilter = mysqli_real_escape_string($link, $serviceFilter); // Sanitize input
                                                    $sql1 .= " WHERE service = '$serviceFilter'";
                                                }
                                                
                                                $r = mysqli_query($link, $sql1);

                                                function formatID($id) {
                                                    return str_pad($id, 3, "0", STR_PAD_LEFT);
                                                }
                                                if ($r->num_rows > 0) {
                                                    while ($row1 = mysqli_fetch_assoc($r)) {
                                                        $user_id = $row1['user_id'];
                                                        $sql3 = "SELECT * FROM users WHERE user_id = $user_id";
                                                        $result3 = mysqli_query($link, $sql3);
                                                        $row3 = mysqli_fetch_assoc($result3);
                                                ?>
                                                        <tr class="text-center">
                                                        <td>
                                                            <?php 
                                                                echo strlen($row1['appointment_id']) > 1 
                                                                    ? "AP0" . $row1['appointment_id'] 
                                                                    : "AP00" . $row1['appointment_id'];
                                                            ?>
                                                        </td>
                                                            <td><?php echo $row3['first_name']; ?> <?php echo $row3['last_name']; ?></td>
                                                            <td><?php if ($row3['contact_number'] == "") {
                                                                    echo 'N/A';
                                                                } else {
                                                                    echo $row3['contact_number'];
                                                                } ?>
                                                            </td>
                                                            <td>
                                                                <?php $formattedDate = date("l, F j Y - h:i A", strtotime($row1["datetime"]));
                                                                echo $formattedDate; ?>
                                                            </td>
                                                            <td><?php echo $row1['service']; ?></td>

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
                                                        </tr>
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
                    </div>

                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                        <script>
                            async function fetchAppointmentCounts() {
                                try {
                                    const response = await fetch('fetch-appointment-counts.php');
                                    const data = await response.json();

                                    document.getElementById('totalAppointments').innerText = data.total;
                                    document.getElementById('approvedAppointments').innerText = data.approved;
                                    document.getElementById('cancelledAppointments').innerText = data.cancelled;

                                } catch (error) {
                                    console.error("Error fetching appointment counts:", error);
                                }
                            }
                            

                            // Populate the year options dynamically
                            function populateYearOptions() {
                                const currentYear = new Date().getFullYear();
                                const yearFilter = document.getElementById('yearFilter');
                                yearFilter.innerHTML = ''; // Clear existing options
                                for (let year = currentYear; year >= 2000; year--) {
                                    const option = document.createElement('option');
                                    option.value = year;
                                    option.text = year;
                                    yearFilter.appendChild(option);
                                }
                            }

                            // Fetch the appointment data for the selected year and service
                            async function fetchAppointmentCountss(year, service) {
                                try {
                                    const response = await fetch(`fetch-currentyear-appointment.php?year=${year}&service=${service}`);
                                    const data = await response.json();
                                    console.log("Fetched data:", data);
                                    return data;
                                } catch (error) {
                                    console.error("Error fetching appointment counts:", error);
                                }
                            }

                            let myLineChart;

                            // Update the chart when the year or service filter changes
                            async function updateChart() {
                                const selectedYear = document.getElementById('yearFilter').value;
                                const selectedService = document.getElementById('serviceFilter').value;
                                const data = await fetchAppointmentCountss(selectedYear, selectedService);

                                if (data && data.months && data.counts) {
                                    const ctx = document.getElementById('myLineChart').getContext('2d');

                                    if (myLineChart) {
                                        myLineChart.destroy();
                                    }

                                    myLineChart = new Chart(ctx, {
                                        type: 'line',
                                        data: {
                                            labels: data.months, // Months data from the API response
                                            datasets: [{
                                                label: `Appointments for ${selectedYear} (${selectedService})`,
                                                data: data.counts, // Appointment counts for each month
                                                borderColor: getRandomColor(),
                                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                                borderWidth: 2,
                                                fill: true,
                                                tension: 0.1
                                            }]
                                        },
                                        options: {
                                            scales: {
                                                y: {
                                                    beginAtZero: true
                                                }
                                            },
                                            responsive: true,
                                            plugins: {
                                                legend: {
                                                    position: 'top',
                                                },
                                                title: {
                                                    display: true,
                                                    text: `Monthly Appointments for ${selectedYear} - ${selectedService}`
                                                }
                                            }
                                        }
                                    });
                                } else {
                                    console.log('No appointment data available.');
                                }
                            }

                            // Generate a random color for chart lines
                            function getRandomColor() {
                                const letters = '0123456789ABCDEF';
                                let color = '#';
                                for (let i = 0; i < 6; i++) {
                                    color += letters[Math.floor(Math.random() * 16)];
                                }
                                return color;
                            }

                            // Initialize the page by populating year options and rendering the chart
                            window.onload = () => {
                                populateYearOptions();
                                fetchAppointmentCounts();
                                updateChart();
                            };

                            // Update chart when the year or service filter changes
                            document.getElementById('yearFilter').addEventListener('change', updateChart);
                            document.getElementById('serviceFilter').addEventListener('change', updateChart);
                        </script>

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