<?php
include 'db_connection.php';

$totalParkingSpaces = 500;

$sqlRegular = "SELECT COUNT(*) AS count FROM records WHERE status = 'Regular'";
$sqlVIP = "SELECT COUNT(*) AS count FROM records WHERE status = 'VIP'";
$sqlAvailable = "SELECT COUNT(*) AS count FROM records WHERE status IN ('Regular', 'VIP')";

$resultRegular = $conn->query($sqlRegular);
$resultVIP = $conn->query($sqlVIP);
$resultAvailable = $conn->query($sqlAvailable);

$regularCount = $resultRegular->fetch_assoc()['count'];
$vipCount = $resultVIP->fetch_assoc()['count'];
$parkedCount = $resultAvailable->fetch_assoc()['count'];
$availableCount = $totalParkingSpaces - $parkedCount;

echo json_encode([
    'Regular' => $regularCount,
    'VIP' => $vipCount,
    'Available' => $availableCount,
    'Booked' => $parkedCount
]);

$conn->close();
?>
