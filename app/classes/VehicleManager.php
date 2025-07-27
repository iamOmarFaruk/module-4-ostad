<?php

require_once 'VehicleBase.php';
require_once 'VehicleActions.php';
require_once 'FileHandler.php';

class VehicleManager extends VehicleBase implements VehicleActions
{
    use FileHandler;

    public function addVehicle($data)
    {
        // Get all existing vehicles
        $vehicles = $this->readFile();

        // Generate new ID (find highest ID and add 1)
        $newId = 1;
        if (!empty($vehicles)) {
            $ids = array_column($vehicles, 'id');
            $newId = max($ids) + 1;
        }

        // Create new vehicle with generated ID
        $newVehicle = [
            'id' => $newId,
            'name' => $data['name'],
            'type' => $data['type'],
            'price' => (int)$data['price'],
            'image' => $data['image']
        ];

        // Add new vehicle to array
        $vehicles[] = $newVehicle;

        // Save back to file
        return $this->writeFile($vehicles);
    }

    public function editVehicle($id, $data)
    {
        // Get all vehicles
        $vehicles = $this->readFile();

        // Find and update the vehicle with matching ID
        foreach ($vehicles as $key => $vehicle) {
            if ($vehicle['id'] == $id) {
                $vehicles[$key] = [
                    'id' => $id,
                    'name' => $data['name'],
                    'type' => $data['type'],
                    'price' => (int)$data['price'],
                    'image' => $data['image']
                ];
                break;
            }
        }

        // Save updated data back to file
        return $this->writeFile($vehicles);
    }

    public function deleteVehicle($id)
    {
        // Get all vehicles
        $vehicles = $this->readFile();

        // Filter out the vehicle with matching ID
        $vehicles = array_filter($vehicles, function ($vehicle) use ($id) {
            return $vehicle['id'] != $id;
        });

        // Reset array keys and save
        $vehicles = array_values($vehicles);
        return $this->writeFile($vehicles);
    }

    public function viewVehicle($id)
    {
        // Get all vehicles
        $vehicles = $this->readFile();

        // Find and return vehicle with matching ID
        foreach ($vehicles as $vehicle) {
            if ($vehicle['id'] == $id) {
                return $vehicle;
            }
        }

        // Return null if not found
        return null;
    }

    public function getVehicles()
    {
        // Simply return all vehicles from file
        return $this->readFile();
    }

    // Implement abstract method from VehicleBase
    public function getDetails()
    {
        // Return vehicle details as a formatted string
        return "Name: " . $this->name . ", Type: " . $this->type . ", Price: $" . $this->price;
    }
}
