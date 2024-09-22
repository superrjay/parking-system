document.getElementById('searchButton').addEventListener('click', function() {
    var cardNumber = document.getElementById('searchCardNumber').value;

    // Fetch record from server
    fetch('search_record.php?cardNumber=' + encodeURIComponent(cardNumber))
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Populate fields with data from the server
                document.getElementById('cardNumber').value = data.record.card_number;
                document.getElementById('charge').value = data.record.charge;
                document.getElementById('recordDetails').style.display = 'block';
            } else {
                alert(data.message); // Show error message if no record is found
                document.getElementById('recordDetails').style.display = 'none';
            }
        })
        .catch(error => console.error('Error:', error));
});


// Keyboard shortcuts for button clicks
document.addEventListener('keydown', function(event) {
    if (event.key === 'F6') {
        event.preventDefault();
        new bootstrap.Modal(document.getElementById('paymentModal')).show();
    }
    if (event.key === 'F7') {
        event.preventDefault();
        new bootstrap.Modal(document.getElementById('addRecordModal')).show();
    }
});