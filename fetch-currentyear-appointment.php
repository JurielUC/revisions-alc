<?php
require_once "connectDB.php";

// Get the year from the query string, or use the current year as a fallback
$selectedYear = isset($_GET['year']) ? (int)$_GET['year'] : date("Y");  // Get the selected year, default to current year if not set

// Get the service from the query string (if any)
$selectedService = isset($_GET['service']) ? $_GET['service'] : '';  // Get the selected service, default to empty if not set

$months = [];
$counts = [];

// Initialize months and counts arrays
for ($i = 1; $i <= 12; $i++) {
    $months[] = date("M", mktime(0, 0, 0, $i, 1));  // Get abbreviated month name (Jan, Feb, ...)
    $counts[] = 0;  // Initialize count for each month
}

// Base SQL query
$sql = "SELECT MONTH(datetime) as month, COUNT(*) as count FROM appointments 
        WHERE YEAR(datetime) = $selectedYear";

// If a service is selected, add the filter for the service
if ($selectedService) {
    $sql .= " AND service = '$selectedService'";
}

$sql .= " GROUP BY MONTH(datetime)";

// Execute the query
$result = mysqli_query($link, $sql);

// Loop through the result and fill the counts array
while ($row = mysqli_fetch_assoc($result)) {
    $monthIndex = $row['month'] - 1;  // Convert 1-12 to 0-11 index for the months array
    $counts[$monthIndex] = (int)$row['count'];  // Assign count to the correct month
}

// Prepare the response data
$response = [
    'months' => $months,
    'counts' => $counts,
];

// Set the response header and output the JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
