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