<?php
// Include our VehicleManager class
require_once '../../app/classes/VehicleManager.php';

// Create instance of VehicleManager
$vehicleManager = new VehicleManager();

$vehicle = null;

// Get vehicle ID from URL
$vehicleId = isset($_GET['id']) ? $_GET['id'] : null;

if ($vehicleId) {
    // Get vehicle data for display
    $vehicle = $vehicleManager->viewVehicle($vehicleId);
}

// Check if delete is confirmed
if (isset($_POST['confirm']) && $_POST['confirm'] === 'yes' && $vehicleId) {
    // Delete vehicle using our manager
    if ($vehicleManager->deleteVehicle($vehicleId)) {
        // Redirect to index page after successful deletion
        header('Location: ../index.php');
        exit();
    }
}

include './header.php';
?>

<div class="container my-4">
    <h1>Delete Vehicle</h1>

    <?php if ($vehicle): ?>
        <p>Are you sure you want to delete <strong><?php echo $vehicle['name']; ?></strong>?</p>
        <div class="card mb-3" style="max-width: 400px;">
            <img src="<?php echo $vehicle['image']; ?>" class="card-img-top" style="height: 200px; object-fit: cover;" alt="<?php echo $vehicle['name']; ?>">
            <div class="card-body">
                <h5 class="card-title"><?php echo $vehicle['name']; ?></h5>
                <p class="card-text">Type: <?php echo $vehicle['type']; ?></p>
                <p class="card-text">Price: $<?php echo number_format($vehicle['price']); ?></p>
            </div>
        </div>
        <form method="POST">
            <button type="submit" name="confirm" value="yes" class="btn btn-danger">Yes, Delete</button>
            <a href="../index.php" class="btn btn-secondary">Cancel</a>
        </form>
    <?php else: ?>
        <p class="alert alert-warning">Vehicle not found!</p>
        <a href="../index.php" class="btn btn-secondary">Back to List</a>
    <?php endif; ?>
</div>

</body>

</html>