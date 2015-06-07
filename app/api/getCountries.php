<?php

require_once '..' . DIRECTORY_SEPARATOR . 'bootstrap.php';
$database = new Database($config);
$pdo = $database->getConnection();

if ($config["debug"]) {
    
    $stmt = $pdo->prepare("SELECT CountryID, CountryName FROM countries WHERE CountryID IN ( SELECT CountryID FROM hotels )");
    $stmt->execute();
    
    header("Content-Type: application/json");
    
    if ($stmt->rowCount() > 0) {
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        echo json_encode($data);
    } else {
        echo json_encode(array('error' => 'No countries found', 'errorCode' => 1));
    }
    
    
}