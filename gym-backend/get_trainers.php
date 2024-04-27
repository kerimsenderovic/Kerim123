<?php
require_once __DIR__ . '/rest/services/TrainerService.class.php';

// Create an instance of TrainerService
$trainer_service = new TrainerService();

// Use the TrainerService to fetch all trainers
$trainers = $trainer_service->get_trainers();

// Set the response header to indicate JSON content
header('Content-Type: application/json');

// Encode the trainer data as JSON and echo it
echo json_encode($trainers);
?>