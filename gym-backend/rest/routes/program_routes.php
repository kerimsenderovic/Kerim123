<?php 
require_once __DIR__ . '/../services/ProgramService.class.php';
Flight::set('program_service', new ProgramService());

/**
 * @OA\Get(
 *      path="/program",
 *      tags={"programs"},
 *      summary="Get all programs",
 *      security={
 *          {"ApiKey": {}}  
     *      },
 *      @OA\Response(
 *           response=200,
 *           description="Array of all programs"
 *      )
 * )
 */
Flight::route('GET /program', function(){
    $programs = Flight::get('program_service')->getPrograms();

    // Set response header to indicate JSON content
    header('Content-Type: application/json');

    // Send JSON response
    Flight::json($programs);
});

?>