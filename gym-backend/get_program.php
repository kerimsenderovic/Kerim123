<?php
require_once __DIR__ . '/rest/services/ProgramService.class.php';

// Create an instance of ProgramService
$program_service = new ProgramService();

// Use the ProgramService to fetch all programs
$programs = $program_service->getPrograms(); // Adjusted method call

// Set the response header to indicate JSON content
header('Content-Type: application/json');

// Encode the program data as JSON and echo it
echo json_encode($programs);
?>