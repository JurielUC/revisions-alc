<?php
require_once "connectDB.php";

$serviceFilter = isset($_GET['service']) ? $_GET['service'] : 'All';

$totals = [
    "items" => [],
    "quantities" => [],
    "quantities_used" => [],
];

if ($serviceFilter AND $serviceFilter !== "All") {
    // Fetch data for a specific service
    $sql = "SELECT item, SUM(quantity) AS total_quantity, SUM(quantity_used) AS total_quantity_used 
            FROM inventory 
            WHERE service = ?
            GROUP BY item";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("s", $serviceFilter);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    // Fetch combined data for all services
    $sql = "SELECT item, SUM(quantity) AS total_quantity, SUM(quantity_used) AS total_quantity_used 
            FROM inventory 
            GROUP BY item";
    $stmt = $link->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
}

// Process the result
while ($row = $result->fetch_assoc()) {
    $totals['items'][] = $row['item'];
    $totals['quantities'][] = (int)$row['total_quantity'];
    $totals['quantities_used'][] = (int)$row['total_quantity_used'];
}
;
header('Content-Type: application/json');
echo json_encode($totals);
?>