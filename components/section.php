<?php
include 'db_connection.php';

// Define your rate per minute
$ratePerMinute = 5; //
$sql = "SELECT * FROM records";
$result = $conn->query($sql);
    if ($result === false) {
        die("Error: " . $conn->error);
    }
?>

<section class="container mt-4">
    <div class="row">
        <?php include 'components/sidebarLeft.php'; ?>

        <!-- Center Column (Current Record) -->
        <div class="col-lg-8">
            <?php include 'components/navbar.php'; ?>
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

                                    if ($result->num_rows > 0) {
                                        $counter = 1;
                                        while ($row = $result->fetch_assoc()) {
                                            $duration = $row['duration'] ?? 0;
                                            $charge = $duration * $ratePerMinute;

                                            echo "<tr>";
                                            echo "<td>" . $counter++ . "</td>";
                                            echo "<td>" . $row['card_number'] . "</td>";
                                            echo "<td>" . $row['name'] . "</td>";
                                            echo "<td>" . $row['plate_number'] . "</td>";
                                            echo "<td>" . $row['contact'] . "</td>";
                                            echo "<td>" . ($duration > 0 ? $duration . " minutes" : "0 minutes") . "</td>";
                                            echo "<td><span class='badge " . ($row['status'] == 'Active' ? 'bg-success' : ($row['status'] == 'Overstay' ? 'bg-danger' : 'bg-warning')) . "'>" . $row['status'] . "</span></td>";
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

        <?php include 'components/sidebarRight.php'; ?>
    </div>
</section>
