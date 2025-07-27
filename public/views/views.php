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

include './header.php';
?>

<div class="container my-4">
    <h1>Vehicle Details</h1>

    <?php if ($vehicle): ?>
        <div class="row">
            <div class="col-md-6">
                <img src="<?php echo $vehicle['image']; ?>" class="img-fluid rounded" alt="<?php echo $vehicle['name']; ?>">
            </div>
            <div class="col-md-6">
                <h2><?php echo $vehicle['name']; ?></h2>
                <table class="table table-bordered">
                    <tr>
                        <th>Vehicle ID</th>
                        <td><?php echo $vehicle['id']; ?></td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td><?php echo $vehicle['name']; ?></td>
                    </tr>
                    <tr>
                        <th>Type</th>
                        <td><?php echo $vehicle['type']; ?></td>
                    </tr>
                    <tr>
                        <th>Price</th>
                        <td>$<?php echo number_format($vehicle['price']); ?></td>
                    </tr>
                </table>

                <div class="mt-3">
                    <a href="edit.php?id=<?php echo $vehicle['id']; ?>" class="btn btn-primary">Edit Vehicle</a>
                    <a href="delete.php?id=<?php echo $vehicle['id']; ?>" class="btn btn-danger">Delete Vehicle</a>
                    <a href="../index.php" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    <?php else: ?>
        <p class="alert alert-warning">Vehicle not found!</p>
        <a href="../index.php" class="btn btn-secondary">Back to List</a>
    <?php endif; ?>
</div>

</body>

</html>