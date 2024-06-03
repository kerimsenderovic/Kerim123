<?php

require_once __DIR__ . '/../dao/TrainingDao.class.php';

class TrainingService {
    private $training_dao;

    public function __construct() {
        $this->training_dao = new TrainingDao();
    }

    public function getTraining() {
        
        return $this->training_dao->get_trainings();
    }
}
?>