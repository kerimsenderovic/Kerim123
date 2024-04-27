<?php
require_once __DIR__ . '/BaseDao.class.php';

class ProgramDao extends BaseDao {
    public function __construct() {
        parent::__construct('program');
    }

    // Fetch all programs from the program table
    public function getPrograms() {
        $query = "SELECT name, price, comment FROM program"; // Exclude the id field from the query
        return $this->query($query, []);
    }

    // Add other methods for inserting, updating, deleting programs, etc.
}
?>