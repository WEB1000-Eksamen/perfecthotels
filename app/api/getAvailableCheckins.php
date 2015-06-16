<?php

require_once '..' . DIRECTORY_SEPARATOR . 'bootstrap.php';
$database = new Database($config);
$pdo = $database->getConnection();
$Checkin = new CheckinBookingFn($pdo);

if (isset($_GET['Reference'])) {
    
    $reference = $_GET['Reference'];
    
    header("Content-Type: application/json");
    
    if (!$Checkin->referenceIsValid($reference)) {
        echo json_encode(array('error' => 'Referansen er ugyldig'));
        
        exit();
    }
    
    
    echo json_encode($Checkin->getAvailableCheckins($reference));
}