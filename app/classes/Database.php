<?php
class Database {
    
    private $dbConnection;
    
    public function __construct ($config) {
        
        $this->dbConnection = new PDO(
            $config["database"]["provider"]
            . ':host=' .
            $config["database"]["host"]
            . ';dbname=' .
            $config["database"]["dbname"],
            $config["database"]["username"],
            $config["database"]["password"]
        );
        
    }
    
    public function getConnection () {
        return $this->dbConnection;
    }
}