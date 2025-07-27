<?php

interface VehicleActions
{
    // Method to add a new vehicle
    public function addVehicle($data);

    // Method to edit existing vehicle by ID
    public function editVehicle($id, $data);

    // Method to delete vehicle by ID
    public function deleteVehicle($id);

    // Method to get single vehicle by ID
    public function viewVehicle($id);

    // Method to get all vehicles
    public function getVehicles();
}
