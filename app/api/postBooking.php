<?php

// connect to database
require_once '..' . DIRECTORY_SEPARATOR . 'bootstrap.php';
$database = new Database($config);
$pdo = $database->getConnection();

// get default post variables, hotelid, roomtypeid, datefrom, dateto and email

if (isset( $_POST['HotelID'], $_POST['RoomtypeID'], $_POST['Email'], $_POST['FromDate'], $_POST['ToDate'] )) {
    
    $HotelID    = $_POST['HotelID'];
    $RoomtypeID = $_POST['RoomtypeID'];
    $Email      = $_POST['Email'];
    $FromDate   = $_POST['FromDate'];
    $ToDate     = $_POST['ToDate'];
    
    $Hash       = Hash::make($Email);
    
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
    
    // check if order with same HRID is made before on same date
    
    $sql = "
        SELECT OrderID, Email, Reference
        FROM orders
        WHERE -- Email = ? OR
        Reference = ?
    ";
    
    $stmt = $pdo->prepare($sql);
    unset($sql);
    $stmt->execute(array($Email, $Hash));
    
    $newOrder = array(
        "Email" => $Email,
        "Reference" => $Hash,
        "OrderID" => null
    );
    
    if ($stmt->rowCount() > 0) {
        foreach ($stmt->fetch(PDO::FETCH_ASSOC) as $column => $value) {
            $newOrder[$column] = $value; 
        }
    }
    
    echo json_encode($newOrder);

    // if it is, quit execution and return error
    // if not
        // hash the email,
        // check if email hash already exists,
            // if it does, get order ID
            // if it doesn't, insert email and hash and get the order ID
        // store order ID for booking values in variable,
        // select a random HRID based on the hotel and roomtype
        // which isn't already booked for the date

}



















