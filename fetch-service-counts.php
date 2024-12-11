<?php
require_once "connectDB.php";

// Initialize counts array with keys matching JavaScript variable names
$counts = [
    "total" => 0,
    "laboratory" => 0,
    "xray" => 0,
    "2d_echo" => 0,
    "ultrasound" => 0,
    "ecg" => 0,
];

// Get total count from appointments
$sql = "SELECT COUNT(*) as total FROM patient_records";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);
$counts["total"] = $row['total'];

// Mapping service names to PHP keys
$services = [
    'Laboratory' => 'laboratory',
    'X-RAY' => 'xray',
    '2D Echo' => '2d_echo',
    'Ultrasound' => 'ultrasound',
    'ECG' => 'ecg',
];

foreach ($services as $db_service => $php_key) {
    $sql = "SELECT COUNT(*) as count FROM patient_records WHERE service = '$db_service'";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);
    $counts[$php_key] = $row['count'] ?? 0; // Default to 0 if no rows found
}

header('Content-Type: application/json');
echo json_encode($counts);
?>
