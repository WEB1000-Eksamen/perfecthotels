<?php

require_once '..' . DIRECTORY_SEPARATOR . 'bootstrap.php';
$database = new Database($config);
$pdo = $database->getConnection();

if (isset($_GET['HotelID'])) {
    
    $hotelid = $_GET['HotelID'];
    
    $stmt = $pdo->prepare("
        SELECT hotels.HotelID, hotels.HotelName, hotels.Address, hotels.Description, countries.CountryName, images.URL
        FROM hotels
        INNER JOIN images ON ( hotels.ImageID = images.ImageID )
        INNER JOIN countries ON ( hotels.CountryID = countries.CountryID )
        WHERE hotels.HotelID = ?");
    $stmt->execute(array($hotelid));
    
    header("Content-Type: application/json");
    
    if ($stmt->rowCount() > 0 && ctype_digit($hotelid)) {
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode($data);
    } else {
        echo json_encode(array('error' => 'No hotels on this ID was found', 'errorCode' => 1, 'ID' => $hotelid));
    }
    
}