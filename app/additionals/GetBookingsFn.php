<?php

class GetBookingsFn {
    
    private $database;
    
    public function __construct (PDO $pdo) {
        $this->database = $pdo;
    }
    
    public function referenceIsValid ($Reference) {
        if (strlen($Reference) != 6) {
            return false;
        }
        if (!ctype_alnum($Reference)) {
            return false;
        }
        
        return true;
    }
    
    public function getBookings ($Reference) {
        return $this->getBookingsByReference($Reference);
    }
    
    private function getBookingsByReference ($Reference) {
        $data = array();
        $stmt = $this->database->prepare("
            SELECT
                 bookings.BookingID
                ,bookings.From
                ,bookings.To
                ,hotels.HotelName
                ,roomtypes.RoomtypeName
                ,roomtypes.RoomtypeID
                ,bookings.Active
                ,hotels.HotelID
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
            ORDER BY
                bookings.From ASC
        ");
        $stmt->execute(array($Reference));
        
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            
            foreach ($data as $idx => $booking) {
                if ($booking['HotelID']) {
                    $availableRoomtypes = $this->getRoomtypesByHotel($booking['HotelID']);
                    if ($availableRoomtypes) {
                        $data[$idx]['AvailableRoomtypes'] = $availableRoomtypes;
                    }
                }
            }
            
            return $data;
        }
        
        return array('error' => 'Ingen bookings ble funnet på denne referansen.');
    }
    
    private function getRoomtypesByHotel ($HotelID) {
        $data = array();
        
        $stmt = $this->database->prepare("
            SELECT
                 roomtypes.RoomtypeName
                ,roomtypes.RoomtypeID
            FROM roomtypes
            INNER JOIN hotelroomtypes ON (
                hotelroomtypes.HotelID = ?
                AND
                hotelroomtypes.RoomtypeID = roomtypes.RoomtypeID
            )
            INNER JOIN hotels ON (
                hotels.HotelID = hotelroomtypes.HotelID
            )
            GROUP BY
                roomtypes.RoomtypeID
        ");

        $stmt->execute(array($HotelID));
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            return $data;
        }
        
        return false;
    }
    
}
















