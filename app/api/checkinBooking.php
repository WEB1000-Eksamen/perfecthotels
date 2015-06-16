<?php

require_once '..' . DIRECTORY_SEPARATOR . 'bootstrap.php';
$database = new Database($config);
$pdo = $database->getConnection();
$Checkin = new CheckinBookingFn($pdo);

if (isset($_POST['BookingID'], $_POST['Reference'])) {
    
    $bookingid = $_POST['BookingID'];
    $reference = $_POST['Reference'];
    
    header("Content-Type: application/json");
    
    if (!$Checkin->referenceIsValid($bookingid)) {
        echo json_encode(array('error' => 'BookingIDen er ugyldig'));
        exit();
    }
    
    
    echo json_encode($Checkin->processCheckin($bookingid, $reference));
}