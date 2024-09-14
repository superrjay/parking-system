<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $plateNumber = $_POST['plateNumber'];
    $inTime = $_POST['inTime'];
    $status = $_POST['status'];
    $charge = $_POST['charge'];

    // Insert the new record
    $sql = "INSERT INTO records (plate_number, in_time, status, charge) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $plateNumber, $inTime, $status, $charge);
    $stmt->execute();

    $stmt->close();
    $conn->close();

    header("Location: index.php"); // Redirect to a page or back to the form
    exit();
}
?>
