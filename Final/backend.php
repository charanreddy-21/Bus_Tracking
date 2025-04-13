<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

// Get incoming JSON
$data = json_decode(file_get_contents("php://input"), true);

// Validate all required fields
if ($data && isset($data['start'], $data['end'], $data['busId'], $data['latitude'], $data['longitude'], $data['timestamp'])) {
    $file = 'data.json';

    // Load existing data
    $rides = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

    // Overwrite existing data for same busId
    $updated = false;
    foreach ($rides as &$ride) {
        if ($ride['busId'] === $data['busId']) {
            $ride = $data;
            $updated = true;
            break;
        }
    }
    unset($ride);

    if (!$updated) {
        $rides[] = $data;
    }

    // Save updated list
    file_put_contents($file, json_encode($rides, JSON_PRETTY_PRINT));

    echo json_encode(["status" => "success", "message" => "✅ Ride data saved."]);
} else {
    echo json_encode(["status" => "error", "message" => "❌ Invalid data format."]);
}
?>
