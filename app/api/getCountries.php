<?php

require_once '..' . DIRECTORY_SEPARATOR . 'bootstrap.php';
$database = new Database($config);
$pdo = $database->getConnection();

if ($config["debug"]) {
    
    $stmt = $pdo->prepare("SELECT CountryID, CountryName FROM countries");
    $stmt->execute();
    
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
    
    header("Content-Type: application/json");
    echo json_encode($data);
    
}