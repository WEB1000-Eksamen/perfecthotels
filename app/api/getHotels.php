<?php

require_once '..' . DIRECTORY_SEPARATOR . 'bootstrap.php';
$database = new Database($config);
$pdo = $database->getConnection();

if (isset($_GET['country'], $_GET['fromDate'], $_GET['toDate'], $_GET['roomtype'])) {
    
    $country = $_GET['country'];
    $fromdate = $_GET['fromDate'];
    $todate = $_GET['toDate'];
    $roomtype = $_GET['roomtype'];
    
    $fromdate = date('Y-m-d', strtotime($fromdate));
    $todate = date('Y-m-d', strtotime($todate));
    
    $sql = 'SELECT 
             hotels.HotelName
            ,hotels.Address
            ,hotels.Description
            ,images.URL
            ,roomtypes.Price
            ,roomtypes.RoomtypeName
            ,COUNT(hotelroomtypes.HRID) AS AvailableRooms

        FROM hotelroomtypes
        INNER JOIN hotels ON (
            hotelroomtypes.HotelID = hotels.HotelID
            AND
            hotels.CountryID = ?
        )
        INNER JOIN rooms ON (
            hotelroomtypes.RoomID = rooms.RoomID
        )
        INNER JOIN roomtypes ON (
            hotelroomtypes.RoomtypeID = roomtypes.RoomtypeID
            AND
            roomtypes.RoomtypeID = ?
        )
        INNER JOIN bookings ON (
            hotelroomtypes.HRID NOT IN (
                SELECT HRID FROM bookings
                WHERE bookings.From BETWEEN ? and ?
                OR bookings.To BETWEEN ? and ?
            )
        )
        INNER JOIN images ON (
            hotels.ImageID = images.ImageID
        )
        GROUP BY 
            hotels.HotelName,
            roomtypes.RoomtypeName
        HAVING COUNT(hotelroomtypes.HRID) > 0
        ORDER BY hotels.HotelName ASC
    ';
    

    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        $country,
        $roomtype,
        $fromdate,
        $todate,
        $fromdate,
        $todate
    ));
    
    header('Content-Type: application/json');
    
    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
    } else {
        $data = array('error' => 'No hotels found', 'errorCode' => 1);
    }
    
    echo json_encode($data);
    

} else {
    echo json_encode(array('error' => 'Not enough parameters', 'errorCode' => 2));
}