<?php
// Include our VehicleManager class
require_once '../../app/classes/VehicleManager.php';

// Create instance of VehicleManager
$vehicleManager = new VehicleManager();

$vehicle = null;

// Get vehicle ID from URL
$vehicleId = isset($_GET['id']) ? $_GET['id'] : null;

if ($vehicleId) {
    // Get vehicle data for editing
    $vehicle = $vehicleManager->viewVehicle($vehicleId);
}

// Check if form is submitted
if ($_POST && $vehicleId) {
    // Get form data
    $data = [
        'name' => $_POST['name'],
        'type' => $_POST['type'],
        'price' => $_POST['price'],
        'image' => $_POST['image']
    ];

    // Update vehicle using our manager
    if ($vehicleManager->editVehicle($vehicleId, $data)) {
        // Redirect to index page after successful update
        header('Location: ../index.php');
        exit();
    }
}

include './header.php';
?>

<div class="container my-4">
    <h1>Edit Vehicle</h1>

    <?php if ($vehicle): ?>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Vehicle Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $vehicle['name']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Vehicle Type</label>
                <input type="text" name="type" class="form-control" value="<?php echo $vehicle['type']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Price</label>
                <input type="number" name="price" class="form-control" value="<?php echo $vehicle['price']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Image URL</label>
                <input type="text" name="image" class="form-control" value="<?php echo $vehicle['image']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Vehicle</button>
            <a href="../index.php" class="btn btn-secondary">Cancel</a>
        </form>
    <?php else: ?>
        <p class="alert alert-warning">Vehicle not found!</p>
        <a href="../index.php" class="btn btn-secondary">Back to List</a>
    <?php endif; ?>
</div>

</body>

</html>