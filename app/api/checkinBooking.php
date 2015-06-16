<?php

require_once '..' . DIRECTORY_SEPARATOR . 'bootstrap.php';
$database = new Database($config);
$pdo = $database->getConnection();
$Checkin = new CheckinBookingFn($pdo);

if (isset($_POST['BookingIDs'], $_POST['Reference'])) {
    
    $bookingids = $_POST['BookingIDs'];
    $reference = $_POST['Reference'];
    
    header("Content-Type: application/json");
    
    if (!$Checkin->referenceIsValid($reference)) {
        echo json_encode(array('error' => 'Referansen er ugyldig.'));
        exit();
    }
    
    if (!is_array($bookingids)) {
        echo json_encode(array('error' => 'Det skjedde en feil med innsjekking.'));
    }
    
    echo json_encode($Checkin->processCheckin($bookingids, $reference));
}