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
        <p>Are you sure you want to delete <strong><?php echo htmlspecialchars($vehicle['name'], ENT_QUOTES, 'UTF-8'); ?></strong>?</p>
        <div class="card mb-3" style="max-width: 400px;">
            <img src="<?php echo htmlspecialchars($vehicle['image'], ENT_QUOTES, 'UTF-8'); ?>" class="card-img-top" style="height: 200px; object-fit: cover;" alt="<?php echo htmlspecialchars($vehicle['name'], ENT_QUOTES, 'UTF-8'); ?>">
            <div class="card-body">
                <h5 class="card-title"><?php echo htmlspecialchars($vehicle['name'], ENT_QUOTES, 'UTF-8'); ?></h5>
                <p class="card-text">Type: <?php echo htmlspecialchars($vehicle['type'], ENT_QUOTES, 'UTF-8'); ?></p>
                <p class="card-text">Price: $<?php echo number_format((int)$vehicle['price']); ?></p>
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