<?php
require_once __DIR__ . '/../dao/TrainingDao.class.php';

class TrainingService {
    private $training_dao;

    public function __construct() {
        $this->training_dao = new TrainingDao();
    }

    // Fetch all trainings from the database using TrainingDao
    public function get_trainings() {
        return $this->training_dao->get_trainings();
    }
}
?>