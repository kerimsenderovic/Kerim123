<?php 
require_once __DIR__ . '/../services/TrainingService.class.php';
Flight::set('training_service', new TrainingService());

/**
 * @OA\Get(
 *      path="/training",
 *      tags={"trainings"},
 *      summary="Get all trainings",
 *      @OA\Response(
 *           response=200,
 *           description="Array of all trainings"
 *      )
 * )
 */
Flight::route('GET /training', function(){
    $trainings = Flight::get('training_service')->getTraining();

   /*  // Set response header to indicate JSON content
    header('Content-Type: application/json');
 */
    // Send JSON response
    Flight::json($trainings);
});
?>