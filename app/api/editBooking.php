<?php

require_once '..' . DIRECTORY_SEPARATOR . 'bootstrap.php';
$database = new Database($config);
$pdo = $database->getConnection();

if (isset( $_POST['ToDate'],  $_POST['FromDate'], $_POST['BookingID'], $_POST['RoomtypeID'])) {
    
    $reference = $_POST['Reference'];
    
    header("Content-Type: application/json");
    
    if (!ctype_alnum($reference) && strlen($reference) == 5) {
        echo json_encode(array(
            'error' => 'Referansen er ikke gyldig.'
        ));
        exit();
    }
    
    $stmt = $pdo->prepare("
        SELECT
            bookings.From,
            bookings.To,
            hotels.HotelName,
            roomtypes.RoomtypeName
        FROM bookings
        INNER JOIN orders ON (
            bookings.OrderID = orders.OrderID
            AND
            orders.Reference = ?
        )
        INNER JOIN hotelroomtypes ON (
            bookings.HRID = hotelroomtypes.HRID
        )
        INNER JOIN hotels ON (
            hotelroomtypes.HotelID = hotels.HotelID
        )
        INNER JOIN roomtypes ON (
            hotelroomtypes.RoomtypeID = roomtypes.RoomtypeID
        )
    ");
    $stmt->execute(array($reference));
    
    if ($stmt->rowCount() > 0) {
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        echo json_encode($data);
    } else {
        echo json_encode(array('error' => 'Denne referansen inneholder ingen bookinger.', 'errorCode' => 1));
    }
    
    
}