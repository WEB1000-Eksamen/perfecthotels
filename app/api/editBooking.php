<?php

require_once '..' . DIRECTORY_SEPARATOR . 'bootstrap.php';
$database = new Database($config);
$pdo = $database->getConnection();
$booking = new EditBookingsFn($pdo);

if (isset( $_POST['ToDate'],  $_POST['FromDate'], $_POST['BookingID'], $_POST['HRID'] )) {
    
    $todate = $_POST['ToDate'];
    $fromdate = $_POST['FromDate'];
    $bookingid = $_POST['BookingID'];
    $hrid = $_POST['HRID'];
    
    header("Content-Type: application/json");
    
    if (!ctype_digit($bookingid)) {
        echo json_encode(array(
            'error' => 'BookingIDen er ugyldig.'
        ));
        exit();
    }
    
    
    echo json_encode($booking->editExistingBooking($fromdate, $todate, $bookingid, $hrid));
} else {
    header("Content-Type: application/json");
    
    echo json_encode(array('error' => 'Alle feltene er ikke utfylt.'));
}