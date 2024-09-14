<?php
include 'db_connection.php';

if (isset($_GET['plateNumber'])) {
    $plateNumber = $_GET['plateNumber'];
    $sql = "SELECT * FROM records WHERE plate_number = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $plateNumber);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $record = $result->fetch_assoc();
        echo json_encode(['success' => true, 'record' => $record]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Record not found']);
    }
    $stmt->close();
    $conn->close();
}
?>
