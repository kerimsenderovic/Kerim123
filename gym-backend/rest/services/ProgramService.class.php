<?php
require_once __DIR__ . '/../dao/ProgramDao.class.php'; // Import ProgramDao class

class ProgramService {
    private $programDao;

    public function __construct() {
        $this->programDao = new ProgramDao(); // Instantiate ProgramDao
    }

    // Fetch all programs from the database using ProgramDao
    public function getPrograms() {
        return $this->programDao->getPrograms();
    }

    // Add a new program to the database
    public function addProgram($programData) {
        // You can add validation or business logic here if needed
        return $this->programDao->addProgram($programData);
    }

    // Add other methods for updating, deleting programs, etc.
}
?>