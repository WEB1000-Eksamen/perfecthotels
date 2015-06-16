<?php
class CheckinBookingFn {
    private $database;
    
    public function __construct (PDO $pdo) {
        $this->database = $pdo;
    }
    
    public function getAvailableCheckins ($Reference) {
        $checkinsToday = $this->checkUserHasCheckinDate($Reference);
        $hasBookings = $this->userHasBookings($Reference);
        
        if (!$checkinsToday) {
            if ($hasBookings) {
                return array('error' => 'Du må vente til første dag i bookingen din med å sjekke inn.');
            }
            return array('error' => 'Ingen bookings ble funnet på referansen du oppga.');
        }
        
        return $checkinsToday;
    }
    
    public function referenceIsValid ($Reference) {
        if (strlen($Reference) < 6 || strlen($Reference) > 6) {
            return false;
        }
        if (!ctype_alnum($Reference)) {
            return false;
        }
        return true;
    }
    
    public function processCheckin ($BookingID, $Reference) {
        $checkinsToday = $this->checkUserHasCheckinDate($Reference);
        $hasBookings = $this->userHasBookings($Reference);
        
        if (!$checkinsToday) {
            if ($hasBookings) {
                return array('error' => 'Du må vente til første dag i bookingen din med å sjekke inn.');
            }
            return array('error' => 'Ingen bookings ble funnet på referansen du oppga.');
        }
        
        $sql = "";
        
        if (is_array($BookingID)) {
            for ($i = 0; $i < sizeof($BookingID); $i++) {
                $sql .= "
                    UPDATE bookings
                    SET Active = true
                    WHERE bookings.BookingID = ?
                ";
            }
            $stmt = $this->database->prepare($sql);
            $stmt->execute($BookingID);
        } else {
            $sql = "
                UPDATE bookings
                SET Active = true
                WHERE bookings.BookingID = ?
            ";
            
            $stmt = $this->database->prepare($sql);
            $stmt->execute(array(
                $BookingID
            ));
        }
    }
    
    private function userHasBookings ($Reference) {
        $sql = "
            SELECT bookings.BookingID
            FROM bookings
            INNER JOIN orders ON (
                orders.OrderID = bookings.OrderID
                AND
                orders.Reference = ?
            )
        ";
        
        $stmt = $this->database->prepare($sql);
        $stmt->execute(array(
            $Reference
        ));
        
        if ($stmt->rowCount() > 1) {
            return true;
        }
        return false;
    }
    
    private function checkUserHasCheckinDate ($Reference) {
        $Today = date('Y-m-d');
        
        $sql = "
            SELECT
                bookings.BookingID,
                hotels.HotelName,
                roomtypes.RoomtypeName
            FROM bookings
            INNER JOIN hotelroomtypes ON (
                hotelroomtypes.HRID = bookings.HRID
            )
            INNER JOIN hotels ON (
                hotelroomtypes.HotelID = hotels.HotelID
            )
            INNER JOIN roomtypes ON (
                hotelroomtypes.RoomtypeID = roomtypes.RoomtypeID
            )
            INNER JOIN orders ON (
                orders.Reference = ?
                AND
                orders.OrderID = bookings.OrderID
            )
            WHERE bookings.From = ?
            AND bookings.Active = false
        ";
        
        $stmt = $this->database->prepare($sql);
        $stmt->execute(array(
            $Reference,
            $Today
        ));
        
        if ($stmt->rowCount() > 0) {
            $data = array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            return $data;
        }
        
        return false;
    }
}