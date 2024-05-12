<?php
require_once __DIR__ . '/BaseDao.class.php';

class TrainerDao extends BaseDao {
    public function __construct() {
        parent::__construct('trainers');
    }
    public function add_trainer($trainer){
        return $this->insert('trainers', $trainer);
    }
    // Fetch only firstName and lastName from the trainers table
    public function get_trainers() {
        return $this->query('SELECT firstName, lastName FROM trainers', []); // Provide an empty array as the second argument
    }
}
?>