<?php

require_once '..' . DIRECTORY_SEPARATOR . 'bootstrap.php';
$database = new Database($config);
$pdo = $database->getConnection();

if (isset($_GET['HotelID'], $_GET['RoomtypeID'])) {
    
    $hotelid = $_GET['HotelID'];
    $roomtypeid = $_GET['RoomtypeID'];
    
    $sql = "SELECT DISTINCT
                 hotels.HotelID
                ,hotels.HotelName
                ,hotels.Address
                ,hotels.Description
                ,countries.CountryName
                ,roomtypes.RoomtypeName
                ,roomtypes.RoomtypeID
                ,roomtypes.Price
                ,images.URL as ImageURL

            FROM hotels
            INNER JOIN hotelroomtypes ON (
                hotelroomtypes.HotelID = hotels.HotelID
            )
            INNER JOIN roomtypes ON (
                roomtypes.RoomtypeID = hotelroomtypes.RoomtypeID
                AND
                roomtypes.RoomtypeID = ?
            )
            LEFT OUTER JOIN images ON ( 
                hotelroomtypes.ImageID = images.ImageID 
            )
            INNER JOIN countries ON (
                hotels.CountryID = countries.CountryID
                AND
                hotels.HotelID = ?
            )
    ";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array($roomtypeid, $hotelid));
    
    header("Content-Type: application/json");
    
    if ($stmt->rowCount() > 0 && ctype_digit($hotelid)) {
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode($data);
    } else {
        echo json_encode(array('error' => 'No hotels on this ID was found', 'errorCode' => 1));
    }
    
}