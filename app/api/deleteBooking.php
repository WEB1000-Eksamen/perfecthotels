<?php

require_once '..' . DIRECTORY_SEPARATOR . 'bootstrap.php';
$database = new Database($config);
$pdo = $database->getConnection();

if (isset($_POST['BookingID'])) {
    
    header('Content-Type: application/json');
    
    $test = false;
    
    if (!ctype_digit($_POST['BookingID']) && $test) {
        echo json_encode(array('error' => 'Ugyldig bookingidentifikasjon'));
        exit();
    }
    
    $sql = "DELETE FROM bookings WHERE bookings.BookingID = ?";
    
    $stmt = $pdo->prepare($sql);
    
    $stmt->execute(array($_POST['BookingID']));
    
    echo json_encode(array('success' => 'Bookingen ble fjernet.'));
}