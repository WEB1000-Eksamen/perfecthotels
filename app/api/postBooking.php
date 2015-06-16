<?php

// connect to database
require_once '..' . DIRECTORY_SEPARATOR . 'bootstrap.php';
$database = new Database($config);
$pdo = $database->getConnection();

// get default post variables, hotelid, roomtypeid, datefrom, dateto and email

if (isset( $_POST['HotelID'], $_POST['RoomtypeID'], $_POST['Email'], $_POST['FromDate'], $_POST['ToDate'] )) {
    
    $HotelID    = $_POST['HotelID'];
    $RoomtypeID = $_POST['RoomtypeID'];
    $FromDate   = $_POST['FromDate'];
    $ToDate     = $_POST['ToDate'];
    $Email      = strtolower($_POST['Email']);
    
    $FromDate = date('Y-m-d', strtotime($FromDate));
    $ToDate = date('Y-m-d', strtotime($ToDate));
    
    $errorCodes = array(
        'InvalidHotel' => 1,
        'InvalidRoomtype' => 2,
        'InvalidEmail' => 3,
        'InvalidDate' => 4
    );
    
    $errors = array();
    
    header('Content-Type: application/json');
    
    if (!ctype_digit($HotelID)) {
        $errors[$errorCodes['InvalidHotel']]['error'] = 'Hotellet er ikke gyldig';
    }
    if (!ctype_digit($RoomtypeID)) {
        $errors[$errorCodes['InvalidRoomtype']]['error'] = 'Romtypen er ikke gyldig';
    }
    if  (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        $errors[$errorCodes['InvalidEmail']]['error'] = 'Eposten er ikke gyldig';
    }
    if (!($FromDate && $ToDate)) {
        $errors[$errorCodes['InvalidDate']]['error'] = 'Datoene er ikke gyldige';
    }
    
    if (sizeof($errors) > 0) {
        echo json_encode($errors);
        exit();
    }
    
    $Hash = Hash::make($Email);
    
    // return the Reference
    $bookingHelpers = new PostBookingFn($pdo);
    $response = $bookingHelpers->insertOrderBooking($HotelID, $RoomtypeID, $FromDate, $ToDate, $Email, $Hash);
    
    echo json_encode($response);
}



















