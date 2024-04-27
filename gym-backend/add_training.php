<?php

require_once __DIR__ . '/rest/services/TrainingService.class.php';

$training_service = new TrainingService();
$training_service->add_training([]); 