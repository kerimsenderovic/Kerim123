<?php
require_once __DIR__ . '/rest/services/CommentService.class.php';

// Create an instance of CommentService
$comment_service = new CommentService();

// Use the CommentService to fetch all comments
$comments = $comment_service->getComments(); // Adjusted method call

// Set the response header to indicate JSON content
header('Content-Type: application/json');

// Encode the comment data as JSON and echo it
echo json_encode($comments);
?>