<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

//read the incoming JSON data and convert it into an array
$data = json_decode(file_get_contents("php://input"), true);

// Check if all the required fields are there
if($data && isset($data['start'], $data['end'], $data['busId'], $data['latitude'], $data['longitude'], $data['timestamp'])){
    
// Path to the file where we'll store the data
$file = 'data.json';

// Check if the file exists already, if yes, load it, otherwise use an empty array
$rides = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

// Flag to track if we updated an existing entry
$updated = false;

// Go through each ride and see if there's one with the same busId
foreach($rides as &$ride){
if($ride['busId'] === $data['busId']){
// If found, update that ride with the new data
$ride = $data;
$updated = true;
break;
}
}
unset($ride); // just cleaning up the reference

// If we didn’t find any matching busId, just add this one as new one
if(!$updated){
$rides[] = $data;
}

// Save everything back to the file in a readable format
file_put_contents($file, json_encode($rides, JSON_PRETTY_PRINT));

// Send a success message back
echo json_encode(["status" => "success", "message" => "Ride data saved."]);
}else{
// If the input data wasn’t valid, send an error message
echo json_encode(["status" => "error", "message" => "Invalid data format."]);
}
?>