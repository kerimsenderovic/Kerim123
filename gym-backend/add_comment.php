<?php
require_once __DIR__ .'/rest/services/CommentService.class.php';

$comment_service = new CommentService();
$comment_service->add_comment([]); 
?>