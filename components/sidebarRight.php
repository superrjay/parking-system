<div class="col-lg-2">
         
<div class="sidebar-right">
        <div class="img">
            <div class="image-wrapper">
                <img src="./img/sp.jpg" alt="User Image">
            </div>
            <div class="text-wrapper">
                <h5>Ms. Crystal</h5>
                <p>Cashier</p>
            </div>
        </div>


        <div class="container">
        <div class="list-group">
            <button id="paymentButton" class="btn btn-custom btn-outline-primary" data-bs-toggle="modal" data-bs-target="#paymentModal">Payment (F6)</button>

            <!-- Payment Modal -->
            <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="paymentModalLabel">Process Payment</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="paymentForm" method="POST" action="process_payment.php">
                                <div class="mb-3">
                                    <label for="searchPlateNumber" class="form-label">Search Plate Number</label>
                                    <input type="text" class="form-control" id="searchPlateNumber" name="searchPlateNumber" required>
                                    <button type="button" class="btn btn-primary mt-2" id="searchButton">Search</button>
                                </div>
                                <div id="recordDetails" style="display: none;">
                                    <div class="mb-3">
                                        <label for="plateNumber" class="form-label">Plate Number</label>
                                        <input type="text" class="form-control" id="plateNumber" name="plateNumber" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="charge" class="form-label">Charge</label>
                                        <input type="text" class="form-control" id="charge" name="charge" readonly>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Process Payment</button>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <button id="addButton" class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#addRecordModal">Add (F7)</button>
            <!-- Add Record Modal -->
            <div class="modal fade" id="addRecordModal" tabindex="-1" aria-labelledby="addRecordModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addRecordModalLabel">Add New Parking Record</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="addRecordForm" method="POST" action="add_record.php">
                                <div class="mb-3">
                                    <label for="plateNumber" class="form-label">Plate Number</label>
                                    <input type="text" class="form-control" id="plateNumber" name="plateNumber" required>
                                </div>
                                <div class="mb-3">
                                    <label for="inTime" class="form-label">In Time</label>
                                    <input type="datetime-local" class="form-control" id="inTime" name="inTime" required>
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select" id="status" name="status" required>
                                        <option value="Active">Active</option>
                                        <option value="Overstay">Overstay</option>
                                        <option value="Left">Left</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="charge" class="form-label">Charge</label>
                                    <input type="number" class="form-control" id="charge" name="charge" required>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" form="addRecordForm">Save Record</button>
                        </div>
                    </div>
                </div>
            </div>

            <button id="voidButton" class="btn btn-custom">Void (F8)</button>
            <button id="rewardCardButton" class="btn btn-custom">Reward Card (F9)</button>
            <button id="concernButton" class="btn btn-custom">Concern (F10)</button>
        </div>
        </div>
    </div>
</div>
        <script>
        // JavaScript for search functionality
        document.getElementById('searchButton').addEventListener('click', function() {
            var plateNumber = document.getElementById('searchPlateNumber').value;

            // Fetch record from server
            fetch('search_record.php?plateNumber=' + encodeURIComponent(plateNumber))
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Populate fields
                        document.getElementById('plateNumber').value = data.record.plate_number;
                        document.getElementById('charge').value = data.record.charge;
                        document.getElementById('recordDetails').style.display = 'block';
                    } else {
                        alert(data.message); // Show error message if any
                        document.getElementById('recordDetails').style.display = 'none';
                    }
                })
                .catch(error => console.error('Error:', error));
        });

        // Keyboard shortcuts for button clicks
        document.addEventListener('keydown', function(event) {
            switch (event.key) {
                case 'F6':
                    event.preventDefault();
                    document.getElementById('paymentButton').click();
                    break;
                case 'F7':
                    event.preventDefault();
                    document.getElementById('addButton').click();
                    break;
                case 'F8':
                    event.preventDefault();
                    document.getElementById('voidButton').click();
                    break;
                case 'F9':
                    event.preventDefault();
                    document.getElementById('rewardCardButton').click();
                    break;
                case 'F10':
                    event.preventDefault();
                    document.getElementById('concernButton').click();
                    break;
                default:
                    break;
            }
        });
    </script>