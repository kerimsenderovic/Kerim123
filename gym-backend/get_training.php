<?php
require_once __DIR__ . '/rest/services/TrainingService.class.php';

// Create an instance of TrainingService
$training_service = new TrainingService();

// Use the TrainingService to fetch all training data
$trainings = $training_service->get_trainings();

// Set the response header to indicate JSON content
header('Content-Type: application/json');

// Encode the training data as JSON and echo it
echo json_encode($trainings);
?>