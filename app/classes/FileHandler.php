<?php

trait FileHandler
{
    private $filePath = "../data/vehicles.json";  // Path to our JSON file

    public function readFile()
    {
        // Check if file exists first
        if (!file_exists($this->filePath)) {
            return [];
        }

        // Read the file content
        $jsonData = file_get_contents($this->filePath);

        // Convert JSON to PHP array
        $vehicles = json_decode($jsonData, true);

        // Return empty array if JSON is invalid
        return $vehicles ? $vehicles : [];
    }

    public function writeFile($data)
    {
        // Convert PHP array to JSON format
        $jsonData = json_encode($data, JSON_PRETTY_PRINT);

        // Write to file
        file_put_contents($this->filePath, $jsonData);

        return true;
    }
}