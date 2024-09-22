<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve POST values with default fallbacks
    $cardNumber = $_POST['cardNumber'] ?? '';
    $name = $_POST['name'] ?? '';
    $plateNumber = $_POST['plateNumber'] ?? '';
    $contactNumber = $_POST['contactNumber'] ?? '';
    $vehicleType = $_POST['vehicleType'] ?? 'Unknown';
    $duration = (int)($_POST['duration'] ?? 0);  // Ensure duration is an integer
    $ratePerMinute = 5;
    $charge = $duration * $ratePerMinute;  // Calculate charge
    $status = 'Active';

    // Validate required fields
    if (empty($cardNumber) || empty($name) || empty($plateNumber) || empty($contactNumber)) {
        echo "All fields are required!";
        exit();
    }

    // Prepare and bind the insert query
    $sql = "INSERT INTO records (card_number, name, plate_number, contact, duration, vehicle_type, status, charge) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("ssssissd", $cardNumber, $name, $plateNumber, $contactNumber, $duration, $vehicleType, $status, $charge);
    
    // Execute statement
    if ($stmt->execute()) {
        // Successfully inserted the record, now update the counts table
        $sqlUpdateCounts = "UPDATE counts SET guests = guests + 1, slots = slots - 1 WHERE id = 1";
        $stmtUpdate = $conn->prepare($sqlUpdateCounts);

        if (!$stmtUpdate) {
            die("Error preparing counts update statement: " . $conn->error);
        }

        // Execute update statement
        if ($stmtUpdate->execute()) {
            echo "Record and counts updated successfully.";
        } else {
            echo "Error updating counts: " . $stmtUpdate->error;
        }

        $stmtUpdate->close();

        // Redirect to index.php on successful insertion and update
        header("Location: index.php");
        exit();
    } else {
        // Capture detailed error if record insertion fails
        echo "Error adding record: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
