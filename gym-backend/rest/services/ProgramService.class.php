<?php
require_once __DIR__ . '/../dao/ProgramDao.class.php';

class ProgramService {
    private $programDao;

    public function __construct() {
        $this->programDao = new ProgramDao(); 
    }

   
    public function getPrograms() {
        return $this->programDao->getPrograms();
    }

    
    public function addProgram($programData) {
       
        return $this->programDao->addProgram($programData);
    }

    
}
?>