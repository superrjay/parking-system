<?php
// Include the database connection
include 'db_connection.php';

// Fetch Counts for Navbar
$sqlFetchCounts = "SELECT guests, slots, members, reserved FROM counts WHERE id = 1";
$resultCounts = $conn->query($sqlFetchCounts);
if ($resultCounts->num_rows > 0) {
    $rowCounts = $resultCounts->fetch_assoc();
    $guests = $rowCounts['guests'];
    $slots = $rowCounts['slots'];
    $members = $rowCounts['members'];
    $reserved = $rowCounts['reserved'];
} else {
    // Default values if no row is found
    $guests = 0;
    $slots = 0;
    $members = 0;
    $reserved = 0;
}

// Fetch Records for Section
$ratePerMinute = 5; // Define your rate per minute
$sqlRecords = "SELECT * FROM records";
$resultRecords = $conn->query($sqlRecords);

// Add the error handling check here for the records query
if ($resultRecords === false) {
    die("Error fetching records: " . $conn->error);
}

?>

<!-- Main Section (Records Table) -->
<section class="container mt-4">
    <div class="row">
        <!-- Optionally include the left sidebar -->
        <?php include 'components/sidebarLeft.php'; ?>

        <!-- Center Column (Record List) -->
        <div class="col-lg-8">
             <!-- Navbar Section (Statistics) -->
                <div class="row mb-3">
                    <nav class="navbar-custom">  
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="statistics card-body">
                                        <h5>Guest</h5>
                                        <p><?php echo $guests; ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="card">
                                    <div class="statistics card-body">
                                        <h5>Member</h5>
                                        <p><?php echo $members; ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="card">
                                    <div class="statistics card-body">
                                        <h5>Slot</h5>
                                        <p><?php echo $slots; ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="card">
                                    <div class="statistics card-body">
                                        <h5>Reserved</h5>
                                        <p><?php echo $reserved; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
                
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <table class="table mt-3">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Card No.</th>
                                        <th>Name</th>
                                        <th>Plate Number</th>
                                        <th>Contact</th>
                                        <th>Duration (Minutes)</th>
                                        <th>Status</th>
                                        <th>Charge</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($resultRecords->num_rows > 0) {
                                        $counter = 1;
                                        while ($rowRecords = $resultRecords->fetch_assoc()) {
                                            $duration = $rowRecords['duration'] ?? 0;
                                            $charge = $duration * $ratePerMinute;

                                            echo "<tr>";
                                            echo "<td>" . $counter++ . "</td>";
                                            echo "<td>" . $rowRecords['card_number'] . "</td>";
                                            echo "<td>" . $rowRecords['name'] . "</td>";
                                            echo "<td>" . $rowRecords['plate_number'] . "</td>";
                                            echo "<td>" . $rowRecords['contact'] . "</td>";
                                            echo "<td>" . ($duration > 0 ? $duration . " minutes" : "0 minutes") . "</td>";
                                            echo "<td><span class='badge " . ($rowRecords['status'] == 'Active' ? 'bg-success' : ($rowRecords['status'] == 'Overstay' ? 'bg-danger' : 'bg-warning')) . "'>" . $rowRecords['status'] . "</span></td>";
                                            echo "<td>₱" . number_format($charge, 2) . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='9'>No records found</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Optionally include the right sidebar -->
        <?php include 'components/sidebarRight.php'; ?>
    </div>
</section>
