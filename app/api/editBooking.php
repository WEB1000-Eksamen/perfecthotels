<?php

require_once '..' . DIRECTORY_SEPARATOR . 'bootstrap.php';
$database = new Database($config);
$pdo = $database->getConnection();
$booking = new EditBookingsFn($pdo);

if (isset( $_POST['ToDate'],  $_POST['FromDate'], $_POST['BookingID'])) {
    
    $todate = $_POST['ToDate'];
    $fromdate = $_POST['FromDate'];
    $bookingid = $_POST['BookingID'];
    
    header("Content-Type: application/json");
    
    if (!ctype_digit($bookingid)) {
        echo json_encode(array(
            'error' => 'BookingIDen er ugyldig.'
        ));
        exit();
    }
    
    
    echo json_encode($booking->editExistingBooking($fromdate, $todate, $bookingid));
}