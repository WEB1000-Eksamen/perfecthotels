<?php

require_once '..\bootstrap.php';
$database = new Database($config);
$pdo = $database->getConnection();

if ($config["debug"]) {
    
    $stmt = $pdo->prepare("SELECT RoomtypeID, RoomtypeName, Beds FROM roomtypes");
    $stmt->execute();
    
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
    
    header("Content-Type: application/json");
    echo json_encode($data);
    
}