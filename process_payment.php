<?php
include 'db_connection.php';

date_default_timezone_set('Asia/Manila');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cardNumber = $_POST['cardNumber'];
    $charge = $_POST['charge'];
    $sql = "DELETE FROM records WHERE card_number = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $cardNumber);
    
    if ($stmt->execute()) {
        echo "<script>alert('Payment processed successfully'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Error processing payment'); window.location.href='index.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
