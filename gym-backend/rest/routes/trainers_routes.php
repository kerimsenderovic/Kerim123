<?php 
require_once __DIR__ . '/../services/TrainerService.class.php';
Flight::set('trainer_service', new TrainerService());

/**
 * @OA\Get(
 *      path="/trainer",
 *      tags={"trainers"},
 *      summary="Get all trainers",
 *      @OA\Response(
 *           response=200,
 *           description="Array of all trainers"
 *      )
 * )
 */
Flight::route('GET /trainer', function(){
    $trainers = Flight::get('trainer_service')->getTrainers();

    // Set response header to indicate JSON content
    //header('Content-Type: application/json');

    // Send JSON response
    Flight::json($trainers);
});
?>