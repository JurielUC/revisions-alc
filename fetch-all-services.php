<?php
require_once "connectDB.php";

$services = [];

$sql = "SELECT DISTINCT service FROM inventory";
$result = mysqli_query($link, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    $services[] = $row['service'];
}

array_unshift($services, "All");

header('Content-Type: application/json');
echo json_encode($services);
?>
