<?php
session_start();

require_once "connectDB.php";

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    $sql = "SELECT * FROM admins WHERE admin_id = '" . $_SESSION['id'] . "'";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);

    $active = "inventory";
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

            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="title">
                                            <h4 class="card-title">Inventory</h4>
                                            <p class="card-description">
                                                Inventory list.
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
                                        <table id="inventoryTable" class="table table-hover">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>Item ID</th>
                                                    <th>Item</th>
                                                    <th>Quantity</th>
                                                    <th>Quantity Used</th>
                                                    <th>Remaining Stocks</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $serviceFilter = isset($_GET['service']) ? trim($_GET['service']) : '';
                                                $sql1 = "SELECT * FROM inventory";
                                                
                                                if ($serviceFilter !== '') {
                                                    $serviceFilter = mysqli_real_escape_string($link, $serviceFilter); // Sanitize input
                                                    $sql1 .= " WHERE service = '$serviceFilter'";
                                                }

                                                $sql1 .= " ORDER BY RAND()";

                                                $r = mysqli_query($link, $sql1);

                                                function formatID($id) {
                                                    return "INV".str_pad($id, 3, "0", STR_PAD_LEFT);
                                                }

                                                if ($r->num_rows > 0) {
                                                    while ($row1 = mysqli_fetch_assoc($r)) {
                                                ?>
                                                        <tr class="text-center">
                                                            <td><?php echo formatID($row1['inventory_id']); ?></td>
                                                            <td><?php echo $row1['item']; ?></td>
                                                            <td><?php echo $row1['quantity']; ?></td>
                                                            <td><?php echo $row1['quantity_used']; ?></td>
                                                            <td><?php $remaining_stocks = $row1['quantity'] - $row1['quantity_used'];
                                                                echo $remaining_stocks; ?></td>
                                                            <td>
                                                                <?php
                                                                $quantity = $row1['quantity'];
                                                                $quantity_used = $row1['quantity_used'];

                                                                $available_quantity = $quantity - $quantity_used;

                                                                $low_stock_threshold = $quantity * 0.30;

                                                                if ($available_quantity == 0) {
                                                                    echo '<label class="badge badge-danger">Out of Stock</label>';
                                                                } elseif ($available_quantity <= $low_stock_threshold) {
                                                                    echo '<label class="badge badge-warning">Low Stock</label>';
                                                                } else {
                                                                    echo '<label class="badge badge-success">In Stock</label>';
                                                                }
                                                                ?>

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
                        <div class="col-md-12 mt-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="title">
                                            <h4 class="card-title">Reorder Alert</h4>
                                            <p class="card-description"></p>
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <table id="inventoryTable2" class="table table-hover">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>Item</th>
                                                    <th>Remaining Stock</th>
                                                    <th>Needed Stocks</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql1 = "SELECT * FROM inventory";
                                                $r = mysqli_query($link, $sql1);

                                                if ($r->num_rows > 0) {
                                                    while ($row1 = mysqli_fetch_assoc($r)) {
                                                        $quantity = $row1['quantity'];
                                                        $quantity_used = $row1['quantity_used'];
                                                        $remaining_stocks = $quantity - $quantity_used;

                                                        $low_stock_threshold = $quantity * 0.30;

                                                        if ($remaining_stocks == 0 || $remaining_stocks <= $low_stock_threshold) {
                                                ?>
                                                            <tr class="text-center">
                                                                <td><?php echo $row1['item']; ?></td>
                                                                <td><?php echo $remaining_stocks; ?></td>

                                                                <td><?php
                                                                    $needed_stocks = $quantity - $remaining_stocks;
                                                                    echo $needed_stocks;
                                                                    ?></td>

                                                                <td>
                                                                    <?php
                                                                    if ($remaining_stocks == 0) {
                                                                        echo '<label class="badge badge-danger">Out of Stock</label>';
                                                                    } elseif ($remaining_stocks <= $low_stock_threshold) {
                                                                        echo '<label class="badge badge-warning">Low Stock</label>';
                                                                    }
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                <?php
                                                        }
                                                    }
                                                } else {
                                                    echo '<tr><td colspan="5" class="text-center">No data available</td></tr>';
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mt-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h2 class="card-title"><strong>Stock and Used Items</strong></h2>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <form method="GET" action="">
                                                    <div class="form-group">
                                                        <label for="serviceFilter2" style="text-wrap: nowrap;">Filter by Service</label>
                                                        <select name="service" id="serviceFilter2" class="form-select" style="width: 220px; font-size: 12px;">
                                                        </select>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <canvas id="myComboBarlinechart" class="mt-4"></canvas>
                                    <p id="interpretationGraph"></p>
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
        #inventoryTable thead .sorting:before,
        #inventoryTable thead .sorting:after,
        #inventoryTable thead .sorting_asc:before,
        #inventoryTable thead .sorting_asc:after,
        #inventoryTable thead .sorting_desc:before,
        #inventoryTable thead .sorting_desc:after {
            display: none;
        }

        #inventoryTable2 thead .sorting:before,
        #inventoryTable2 thead .sorting:after,
        #inventoryTable2 thead .sorting_asc:before,
        #inventoryTable2 thead .sorting_asc:after,
        #inventoryTable2 thead .sorting_desc:before,
        #inventoryTable2 thead .sorting_desc:after {
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
            $('#inventoryTable').DataTable({
                "paging": true,
                "ordering": false,
                "info": true,
                "searching": true,
                "lengthMenu": [10, 25, 50],
                "pageLength": 10
            });
            $('#inventoryTable2').DataTable({
                "paging": true,
                "ordering": true,
                "info": true,
                "searching": true,
                "lengthMenu": [10, 25, 50],
                "pageLength": 10
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const serviceFilter = document.getElementById("serviceFilter2");
            const ctx = document.getElementById("myComboBarlinechart").getContext("2d");
            let chartInstance;

            fetch("fetch-all-services.php")
                .then((response) => {
                    if (!response.ok) throw new Error("Failed to fetch services.");
                    return response.json();
                })
                .then((services) => {
                    services.forEach((service) => {
                        const option = document.createElement("option");
                        option.value = service;
                        option.textContent = service;
                        serviceFilter.appendChild(option);
                    });

                    // Set default to "All" and trigger initial chart update
                    serviceFilter.value = "All";
                    updateChart("All");
                })
                .catch((error) => console.error("Error fetching services:", error));

             // Function to update the chart
    function updateChart(service) {
        fetch(`fetch-stock-used-items.php?service=${service}`)
            .then((response) => {
                if (!response.ok) throw new Error(`Failed to fetch chart data: ${response.status}`);
                return response.json();
            })
            .then((data) => {
                const { items, quantities, quantities_used } = data;

                if (chartInstance) {
                    chartInstance.destroy();
                }

                chartInstance = new Chart(ctx, {
                    type: "bar",
                    data: {
                        labels: items,
                        datasets: [
                            {
                                label: "Quantity Available",
                                backgroundColor: "rgba(166, 125, 85, 0.7)",
                                data: quantities,
                            },
                            {
                                label: "Quantity Used",
                                backgroundColor: "rgba(204, 214, 121, 0.7)",
                                data: quantities_used,
                            },
                        ],
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: "Quantity Available and Used",
                                },
                            },
                            x: {
                                title: {
                                    display: true,
                                    text: "Items",
                                },
                            },
                        },
                    },
                });

                // Update the interpretation text based on the selected service
                if (service === "All") {
                    interpretationGraph.innerHTML = generateDetailedInterpretationForAll(quantities, quantities_used, items);
                } else {
                    interpretationGraph.innerHTML = generateDetailedInterpretationForService(service, items, quantities, quantities_used);
                }
            })
            .catch((error) => console.error("Error fetching chart data:", error));
        }

        // Listen for changes in the service dropdown
        serviceFilter.addEventListener("change", (event) => {
            const selectedService = event.target.value;
            if (selectedService) {
                updateChart(selectedService);
            } else if (chartInstance) {
                chartInstance.destroy();
            }
        });

        });

        // Generate detailed interpretation for all services
    // Generate detailed interpretation for all services (HTML format)
    function generateDetailedInterpretationForAll(quantities, quantities_used, items) {
        let interpretation = "<p><strong>Overall Analysis:</strong> This chart compares the available and used quantities across all services.</p>";

        let totalAvailable = quantities.reduce((sum, quantity) => sum + quantity, 0);
        let totalUsed = quantities_used.reduce((sum, used) => sum + used, 0);
        let overallAvailability = (totalAvailable - totalUsed) / totalAvailable * 100;

        interpretation += `<p><strong>Total Available:</strong> ${totalAvailable} items</p>`;
        interpretation += `<p><strong>Total Used:</strong> ${totalUsed} items</p>`;
        interpretation += `<p><strong>Overall Availability Rate:</strong> ${overallAvailability.toFixed(2)}%</p>`;

        interpretation += "<p><strong>Item-level Insights:</strong></p><ul>";

        items.forEach((item, index) => {
            const available = quantities[index];
            const used = quantities_used[index];
            const usageRate = (used / available) * 100;

            if (usageRate > 75) {
                interpretation += `<li><strong>${item}</strong> has a high usage rate of <strong>${usageRate.toFixed(2)}%</strong>. Consider replenishing stock.</li>`;
            } else if (usageRate < 25) {
                interpretation += `<li><strong>${item}</strong> is under-utilized with a usage rate of <strong>${usageRate.toFixed(2)}%</strong>. Consider reducing stock levels.</li>`;
            } else {
                interpretation += `<li><strong>${item}</strong> has a balanced usage rate of <strong>${usageRate.toFixed(2)}%</strong>.</li>`;
            }
        });

        interpretation += "</ul>";

        return interpretation;
    }

    // Generate detailed interpretation for a specific service (HTML format)
    function generateDetailedInterpretationForService(service, items, quantities, quantities_used) {
        let interpretation = `<p><strong>Analysis for "${service}" Service:</strong> This chart compares the available and used quantities for the selected service.</p>`;

        let totalAvailable = quantities.reduce((sum, quantity) => sum + quantity, 0);
        let totalUsed = quantities_used.reduce((sum, used) => sum + used, 0);
        let availabilityRate = (totalAvailable - totalUsed) / totalAvailable * 100;

        interpretation += `<p><strong>Total Available for "${service}":</strong> ${totalAvailable} items</p>`;
        interpretation += `<p><strong>Total Used for "${service}":</strong> ${totalUsed} items</p>`;
        interpretation += `<p><strong>Availability Rate for "${service}":</strong> ${availabilityRate.toFixed(2)}%</p>`;

        interpretation += "<p><strong>Item-level Insights:</strong></p><ul>";

        items.forEach((item, index) => {
            const available = quantities[index];
            const used = quantities_used[index];
            const usageRate = (used / available) * 100;

            if (usageRate > 75) {
                interpretation += `<li><strong>${item}</strong> has a high usage rate of <strong>${usageRate.toFixed(2)}%</strong>. Consider replenishing stock.</li>`;
            } else if (usageRate < 25) {
                interpretation += `<li><strong>${item}</strong> is under-utilized with a usage rate of <strong>${usageRate.toFixed(2)}%</strong>. Consider reducing stock levels.</li>`;
            } else {
                interpretation += `<li><strong>${item}</strong> has a balanced usage rate of <strong>${usageRate.toFixed(2)}%</strong>.</li>`;
            }
        });

        interpretation += "</ul>";

        return interpretation;
    }
        </script>

    <!-- <script>
        fetch('fetch-stock-used-items.php')
            .then(response => response.json())
            .then(data => {
                const items = data.items;
                const quantities = data.quantities;
                const quantitiesUsed = data.quantities_used;
                const completedAppointments = data.appointments;

                const ctx = document.getElementById('myComboBarlinechart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: items,
                        datasets: [
                            {
                                label: 'Quantity Available',
                                type: 'bar',
                                backgroundColor: 'rgba(166, 125, 85, 0.7)',
                                data: quantities
                            },
                            {
                                label: 'Quantity Used',
                                type: 'bar',
                                backgroundColor: 'rgba(204, 214, 121, 0.7)',
                                data: quantitiesUsed
                            },
                            {
                                label: 'Appointment',
                                type: 'line',
                                fill: false,
                                borderColor: 'rgba(0, 0, 0, 1)',
                                data: completedAppointments
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Quantity and Appointments'
                                }
                            },
                            x: {
                                title: {
                                    display: true,
                                    text: 'Item'
                                }
                            }
                        }
                    }
                });
            })
            .catch(error => console.error('Error fetching data:', error));
    </script> -->

    

</body>

</html>