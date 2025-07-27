<?php
// Include our VehicleManager class
require_once '../app/classes/VehicleManager.php';

// Create instance of VehicleManager
$vehicleManager = new VehicleManager();

// Get all vehicles from JSON file
$vehicles = $vehicleManager->getVehicles();

include './views/header.php';
?>

<div class="container my-4">
    <h1>Vehicle Listing</h1>
    <a href="./views/add.php" class="btn btn-success mb-4">Add Vehicle</a>
    <div class="row">
        <!-- Loop through all vehicles -->
        <?php foreach ($vehicles as $vehicle): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="<?php echo htmlspecialchars($vehicle['image'], ENT_QUOTES, 'UTF-8'); ?>" class="card-img-top" style="height: 200px; object-fit: cover;" alt="<?php echo htmlspecialchars($vehicle['name'], ENT_QUOTES, 'UTF-8'); ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($vehicle['name'], ENT_QUOTES, 'UTF-8'); ?></h5>
                        <p class="card-text">Type: <?php echo htmlspecialchars($vehicle['type'], ENT_QUOTES, 'UTF-8'); ?></p>
                        <p class="card-text">Price: $<?php echo number_format((int)$vehicle['price']); ?></p>
                        <a href="./views/edit.php?id=<?php echo (int)$vehicle['id']; ?>" class="btn btn-primary">Edit</a>
                        <a href="./views/delete.php?id=<?php echo (int)$vehicle['id']; ?>" class="btn btn-danger">Delete</a>
                        <a href="./views/views.php?id=<?php echo (int)$vehicle['id']; ?>" class="btn btn-info text-white">View</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <!-- End loop -->

        <?php if (empty($vehicles)): ?>
            <div class="col-12">
                <p class="text-center">No vehicles found. <a href="./views/add.php">Add the first vehicle</a></p>
            </div>
        <?php endif; ?>
    </div>
</div>

</body>

</html>