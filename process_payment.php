<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $plateNumber = $_POST['plateNumber'];
    $charge = $_POST['charge'];

    // Remove record from the database
    $sql = "DELETE FROM records WHERE plate_number = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $plateNumber);
    
    if ($stmt->execute()) {
        echo "<script>alert('Payment processed successfully'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Error processing payment'); window.location.href='index.php';</script>";
    }
    
    $stmt->close();
    $conn->close();
}
?>
