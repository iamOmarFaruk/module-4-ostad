<?php
// Include our VehicleManager class
require_once '../../app/classes/VehicleManager.php';

// Create instance of VehicleManager
$vehicleManager = new VehicleManager();

// Check if form is submitted
if ($_POST) {
    // Get form data with basic validation
    $data = [
        'name' => htmlspecialchars(trim($_POST['name']), ENT_QUOTES, 'UTF-8'),
        'type' => htmlspecialchars(trim($_POST['type']), ENT_QUOTES, 'UTF-8'),
        'price' => (int)$_POST['price'], // Convert to integer for price
        'image' => htmlspecialchars(trim($_POST['image']), ENT_QUOTES, 'UTF-8')
    ];

    // Add vehicle using our manager
    if ($vehicleManager->addVehicle($data)) {
        // Redirect to index page after successful addition
        header('Location: ../index.php');
        exit();
    }
}

include './header.php';
?>

<div class="container my-4">
    <h1>Add Vehicle</h1>
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