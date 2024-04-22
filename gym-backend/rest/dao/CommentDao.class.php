<?php
require_once __DIR__ . '/BaseDao.class.php';

class CommentDao extends BaseDao {
    public function __construct() {
        parent::__construct('comments');
    }

    // Fetch all comments from the comment table
    public function get_comments() {
        $query = "SELECT name, comment, rating FROM comments";
        return $this->query($query, []);
    }

    // Add other methods for inserting, updating, deleting comments, etc.
}
?>