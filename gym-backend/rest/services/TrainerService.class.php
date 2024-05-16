<?php
require_once __DIR__ . '/../dao/TrainerDao.class.php';

class TrainerService {
    private $trainer_dao;

    public function __construct() {
        $this->trainer_dao = new TrainerDao();
    }
    public function add_trainer($trainer){
        return $this->trainer_dao->add_trainer($trainer);
    }
    
    public function get_trainers() {
        return $this->trainer_dao->get_trainers();
    }
}
?>