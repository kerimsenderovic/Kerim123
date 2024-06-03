<?php 
require_once __DIR__ . '/../services/CommentService.class.php';
Flight::set('comment_service', new CommentService());

    /**
     * @OA\Get(
     *      path="/comment",
     *      tags={"comments"},
     *      summary="Get all comments",
     *      security={
     *          {"ApiKey": {}}   
     *      },
     *      @OA\Response(
     *           response=200,
     *           description="Array of all comments in the database"
     *      )
     * )
     */

Flight::route('GET /comment', function(){
    $comments = Flight::get('comment_service')->getComments();

    Flight::json($comments, 200);
});
?>