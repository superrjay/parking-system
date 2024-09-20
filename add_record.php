<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cardNumber = $_POST['cardNumber'] ?? '';
    $name = $_POST['name'] ?? '';
    $plateNumber = $_POST['plateNumber'] ?? '';
    $contactNumber = $_POST['contactNumber'] ?? '';
    $vehicleType = $_POST['vehicleType'] ?? 'Unknown';
    $duration = $_POST['duration'] ?? 0;
    $ratePerMinute = 5;
    $charge = $duration * $ratePerMinute;
    $status = 'Active';
    
    // Insert new record into the database
    $sql = "INSERT INTO records (card_number, name, plate_number, contact, duration, vehicle_type, status, charge) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssissd", $cardNumber, $name, $plateNumber, $contactNumber, $duration, $vehicleType, $status, $charge);
    
    if ($stmt->execute()) {
        echo "Record added successfully.";
    } else {
        echo "Error adding record: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();

    header("Location: index.php");
    exit();
}
?>
