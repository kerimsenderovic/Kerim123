<?php
require_once __DIR__ . '/../dao/CommentDao.class.php';

class CommentService {
    private $comment_dao;

    public function __construct() {
        $this->comment_dao = new CommentDao();
    }

    // Fetch all comments from the database using CommentDao
    public function getComments() {
        return $this->comment_dao->get_comments(); // Assuming this method exists in CommentDao
    }
}
?>

