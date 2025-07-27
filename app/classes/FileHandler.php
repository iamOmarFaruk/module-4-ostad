<?php

trait FileHandler
{
    private $filePath;  // Path to our JSON file

    private function getFilePath()
    {
        if (!$this->filePath) {
            // Set absolute path to the JSON file
            $this->filePath = __DIR__ . "/../../data/vehicles.json";
        }
        return $this->filePath;
    }

    public function readFile()
    {
        $filePath = $this->getFilePath();

        // Check if file exists first
        if (!file_exists($filePath)) {
            return [];
        }

        // Read the file content
        $jsonData = file_get_contents($filePath);

        // Convert JSON to PHP array
        $vehicles = json_decode($jsonData, true);

        // Return empty array if JSON is invalid
        return $vehicles ? $vehicles : [];
    }

    public function writeFile($data)
    {
        $filePath = $this->getFilePath();

        // Convert PHP array to JSON format
        $jsonData = json_encode($data, JSON_PRETTY_PRINT);

        // Write to file and check if successful
        $result = file_put_contents($filePath, $jsonData);

        // Return true if write was successful
        return $result !== false;
    }
}
