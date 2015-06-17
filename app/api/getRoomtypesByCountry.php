<?php
require_once '..' . DIRECTORY_SEPARATOR . 'bootstrap.php';
$database = new Database($config);
$pdo = $database->getConnection();

if (isset($_GET['CountryID'])) {
    
    $countryid = $_GET['CountryID'];
    
    header("Content-Type: application/json");
    
    if (!ctype_digit($countryid)) {
        echo json_encode(array('error' => 'Ugyldig identikasjon på land.'));
    }
    
    $stmt = $pdo->prepare("
        SELECT DISTINCT
            roomtypes.RoomtypeID,
            roomtypes.RoomtypeName,
            roomtypes.Beds
        FROM roomtypes
        INNER JOIN hotelroomtypes ON (
            roomtypes.RoomtypeID = hotelroomtypes.RoomtypeID
        )
        INNER JOIN hotels ON (
            hotelroomtypes.HotelID = hotels.HotelID
        )
        INNER JOIN countries ON (
            hotels.CountryID = countries.CountryID
            AND
            countries.CountryID = ?
        )
        ORDER BY roomtypes.Beds
    ");
    
    $stmt->execute(array($countryid));
    
    if ($stmt->rowCount() > 0) {
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        echo json_encode($data);
    } else {
        echo json_encode(array('error' => 'Ingen romtyper er registrert enda.'));
    }
}