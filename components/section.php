<?php
include 'db_connection.php'; // Include your database connection file

// Fetch records from the database
$sql = "SELECT * FROM records ORDER BY in_time DESC";
$result = $conn->query($sql);
?>

<section class="container mt-4">
    <div class="row">
        <?php include 'components/sidebarLeft.php'; ?>

        <!-- Center Column (Current Record) -->
        <div class="col-lg-8">
            <?php include 'components/navbar.php'; ?>

            <!-- Second Row (Table with Records) -->
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <table class="table mt-3">
                                <thead>
                                    <tr>
                                        <th>Plate Number</th>
                                        <th>In Time</th>
                                        <th>Status</th>
                                        <th>Charge</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($result->num_rows > 0) {
                                        // Output data for each row
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row['plate_number'] . "</td>";
                                            echo "<td>" . date('m/d/Y - h:iA', strtotime($row['in_time'])) . "</td>";
                                            echo "<td><span class='badge " . ($row['status'] == 'Active' ? 'bg-success' : ($row['status'] == 'Overstay' ? 'bg-danger' : 'bg-warning')) . "'>" . $row['status'] . "</span></td>";
                                            echo "<td>₱" . number_format($row['charge'], 2) . "</td>";
                                            echo "<td><button class='btn btn-primary btn-sm'>View Details</button></td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='5'>No records found</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column (User Info and Buttons) -->
        <?php include 'components/sidebarRight.php'; ?>
    </div>
</section>