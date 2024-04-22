<?php
require_once __DIR__ . '/BaseDao.class.php';

class TrainingDao extends BaseDao {
    public function __construct() {
        parent::__construct('training');
    }

    // Fetch only firstName and lastName from the trainings table
    public function get_trainings() {
        return $this->query('SELECT name, comment FROM training', []); // Provide an empty array as the second argument
    }
}
?>