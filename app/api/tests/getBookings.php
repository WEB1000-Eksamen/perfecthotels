<?php

require_once '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'bootstrap.php';
$database = new Database($config);
$pdo = $database->getConnection();
$Bookings = new GetBookingsFn($pdo);

if (isset($_GET['Reference'])) {
    
    $reference = $_GET['Reference'];
    
    header("Content-Type: application/json");
    
    if (!$Bookings->referenceIsValid($reference)) {
        echo json_encode(array('error' => 'Referansen er ikke gyldig'));
        
        exit();
    }
    
    echo json_encode($Bookings->getBookings($reference));
    
}