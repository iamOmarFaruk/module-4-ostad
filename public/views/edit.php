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
    // Get form data with basic validation
    $data = [
        'name' => htmlspecialchars(trim($_POST['name']), ENT_QUOTES, 'UTF-8'),
        'type' => htmlspecialchars(trim($_POST['type']), ENT_QUOTES, 'UTF-8'),
        'price' => (int)$_POST['price'], // Convert to integer for price
        'image' => htmlspecialchars(trim($_POST['image']), ENT_QUOTES, 'UTF-8')
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
                <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($vehicle['name'], ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Vehicle Type</label>
                <input type="text" name="type" class="form-control" value="<?php echo htmlspecialchars($vehicle['type'], ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Price</label>
                <input type="number" name="price" class="form-control" value="<?php echo (int)$vehicle['price']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Image URL</label>
                <input type="text" name="image" class="form-control" value="<?php echo htmlspecialchars($vehicle['image'], ENT_QUOTES, 'UTF-8'); ?>" required>
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