<?php
// Include our VehicleManager class
require_once '../../app/classes/VehicleManager.php';

// Create instance of VehicleManager
$vehicleManager = new VehicleManager();

$message = '';

// Check if form is submitted
if ($_POST) {
    // Get form data
    $data = [
        'name' => $_POST['name'],
        'type' => $_POST['type'],
        'price' => $_POST['price'],
        'image' => $_POST['image']
    ];

    // Add vehicle using our manager
    if ($vehicleManager->addVehicle($data)) {
        $message = '<div class="alert alert-success">Vehicle added successfully!</div>';
        // Redirect after 2 seconds
        echo '<script>setTimeout(function(){ window.location.href = "../index.php"; }, 2000);</script>';
    } else {
        $message = '<div class="alert alert-danger">Error adding vehicle!</div>';
    }
}

include './header.php';
?>

<div class="container my-4">
    <h1>Add Vehicle</h1>
    <?php echo $message; ?>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Vehicle Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Vehicle Type</label>
            <input type="text" name="type" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Price</label>
            <input type="number" name="price" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Image URL</label>
            <input type="text" name="image" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Vehicle</button>
        <a href="../index.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

</body>

</html>