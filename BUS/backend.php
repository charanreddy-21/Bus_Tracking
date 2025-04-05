<?php
header('Content-Type: application/json'); // Ensure JSON response
$jsonFile = "bus_location.json"; // Path to JSON file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Decode incoming JSON
    $data = json_decode(file_get_contents('php://input'), true);
    
    // Validate data
    if (isset($data['lat']) && isset($data['lon'])) {
        file_put_contents($jsonFile, json_encode($data)); // Save data
        echo json_encode(["status" => "success", "message" => "Location updated"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Invalid data"]);
    }
} else {
    // Read the data from JSON file
    if (file_exists($jsonFile)) {
        echo file_get_contents($jsonFile);
    } else {
        echo json_encode(['lat' => 0, 'lon' => 0]); // Default location
    }
}
?>