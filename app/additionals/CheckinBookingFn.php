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
                return array('error' => 'Du må vente til første dag i bookingen din for å sjekke inn.');
            }
            return array('error' => 'Ingen bookings ble funnet på referansen du oppga.');
        }
        
        return $checkinsToday;
    
    }
    
    public function referenceIsValid ($Reference) {
        if ((strlen($Reference) < 6 || strlen($Reference) > 6) && ctype_alnum($Reference)) {
            return false;
        }
        if (!ctype_alnum($Reference)) {
            return false;
        }
        return true;
    }
    
    /*
        Krever en array (BookingIDs)
    */
    
    public function processCheckin ($BookingIDs, $Reference) {
        $checkinsToday = $this->checkUserHasCheckinDate($Reference);
        $hasBookings = $this->userHasBookings($Reference);
        
        if (!$checkinsToday) {
            if ($hasBookings) {
                return array('error' => 'Du må vente til første dag i bookingen din for å sjekke inn.');
            }
            return array('error' => 'Ingen bookings ble funnet på referansen du oppga.');
        }
        
        $getBookingRoom = $this->getBookingRoom($BookingIDs);
        $sql = "";
        
        if (is_array($BookingIDs)) {
            for ($i = 0; $i < sizeof($BookingIDs); $i++) {
                $sql .= "
                    UPDATE bookings
                    SET Active = true
                    WHERE bookings.BookingID = ?
                ";
            }
            
            $stmt = $this->database->prepare($sql);
            $stmt->execute($BookingIDs);
            
            
            if ($stmt->rowCount() > 0) {
                return array('rooms' => $getBookingRoom);
            }
            
            return array('error' => 'En feil skjedde.');
        }
    }
    
    /*
        Krever en array (BookingIDs)
    */
    
    private function getBookingRoom ($BookingIDs) {
        $questionMarks = $this->generateQuestionMarks($BookingIDs);
        
        $sql = "
            SELECT
                rooms.RoomNumber
            FROM bookings
            INNER JOIN hotelroomtypes ON (
                bookings.HRID = hotelroomtypes.HRID
                AND
                bookings.BookingID IN (" . $questionMarks . ")
            )
            INNER JOIN rooms ON (
                hotelroomtypes.RoomID = rooms.RoomID
            )
        ";
        
        $data = array();
        $stmt = $this->database->prepare($sql);
        $stmt->execute($BookingIDs);
        
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            return $data;
        }
        return array('error' => 'Ingen rom ble funnet.');
    }
    
    private function generateQuestionMarks ($array) {
        $qMarks = "";
        for ($i = 0; $i < sizeof($array); $i++) {
            if ($i == sizeof($array) - 1) {
                $qMarks .= "?";
            } else {
                $qMarks .= "?, ";
            }
        }
        return $qMarks;
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
                roomtypes.RoomtypeName,
                bookings.From,
                bookings.To
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