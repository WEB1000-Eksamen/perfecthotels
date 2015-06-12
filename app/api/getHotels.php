<?php

require_once '..' . DIRECTORY_SEPARATOR . 'bootstrap.php';
$database = new Database($config);
$pdo = $database->getConnection();

if (isset($_GET['country'], $_GET['fromDate'], $_GET['toDate'], $_GET['roomtype'])) {
    
    $country = $_GET['country'];
    $fromdate = $_GET['fromDate'];
    $todate = $_GET['toDate'];
    $roomtype = $_GET['roomtype'];
    
    $prettyFromDate = date('d. M Y', strtotime($fromdate));
    $prettyToDate = date('d. M Y', strtotime($todate));
    
    $fromdate = date('Y-m-d', strtotime($fromdate));
    $todate = date('Y-m-d', strtotime($todate));
    
    $sqlC = "SELECT TagText, HotelID FROM hoteltags";
    $stmtC = $pdo->prepare($sqlC);
    $stmtC->execute();
    
    $sql = 'SELECT DISTINCT
             hotels.HotelName
            ,hotels.HotelID
            ,hotels.Address
            ,hotels.Description
            ,images.URL
            ,roomtypes.Price
            ,roomtypes.RoomtypeName
            ,roomtypes.RoomtypeID
            ,COUNT(DISTINCT hotelroomtypes.HRID) AS AvailableRooms

        FROM hotelroomtypes
        INNER JOIN hotels ON (
            hotelroomtypes.HotelID = hotels.HotelID
            AND
            hotels.CountryID = ?
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
            hotels.HotelName
        HAVING COUNT(hotelroomtypes.HRID) > 0
        ORDER BY hotels.HotelName ASC, AvailableRooms ASC
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
            $row['FromDate'] = $prettyFromDate;
            $row['ToDate'] = $prettyToDate;
            $data[] = $row;
        }
        if ($stmtC->rowCount() > 0) {
            while ($cat = $stmtC->fetch(PDO::FETCH_ASSOC)) {
                foreach($data as $idx => $hotel) {
                    
                    if ($cat['HotelID'] == $hotel['HotelID']) {
                        $data[$idx]['HotelTags'][] = $cat['TagText'];
                    }
                    
                }
            }
        }
    } else {
        $data = array('error' => 'Ingen hoteller med ledige rom ble funnet på søket ditt.', 'errorCode' => 1);
    }
    
    echo json_encode($data);
    

} else {
    echo json_encode(array('error' => 'Ikke nok parametre.', 'errorCode' => 2));
}