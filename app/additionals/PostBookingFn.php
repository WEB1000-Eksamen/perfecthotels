<?php

class PostBookingFns {
    
    private $database;

    public function __construct (PDO $pdo) {
        $this->database = $pdo;
    }
    
    /**
     * @param $HotelID int
     * @param $RoomtypeID int
     * @param $FromDate string
     * @param $ToDate string
     *
     * @return int
     */
    private function getAvailableHRID ($HotelID, $RoomtypeID, $FromDate, $ToDate) {
        $sql = "
            SELECT
                hotelroomtypes.HRID
            FROM hotelroomtypes
            INNER JOIN bookings ON (
                hotelroomtypes.HRID NOT IN (
                    SELECT HRID FROM bookings
                    WHERE
                    bookings.`From` BETWEEN ? AND ?
                    OR
                    bookings.`To` BETWEEN ? AND ?
                )
                AND
                hotelroomtypes.HotelID = ?
                AND
                hotelroomtypes.RoomtypeID = ?
            )
            LIMIT 1
        ";
        
        $stmt = $this->database->prepare($sql);
        $stmt->execute(array(
            $FromDate,
            $ToDate,
            $FromDate,
            $ToDate,
            $HotelID,
            $RoomtypeID
        ));
        
        $HRID = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($stmt->rowCount() > 0) {
            return intval($HRID['HRID'], 10);
        }
        return false;
    }
    
    private function getOrderID ($Email, $Hash) {
        $sql = "
            SELECT orders.OrderID
            FROM orders
            WHERE orders.Email = ?
            OR orders.Reference = ?
        ";
        
        $stmt = $this->database->prepare($sql);
        $stmt->execute(array(
            $Email,
            $Hash
        ));
        
        if ($stmt->rowCount() > 0) {
            $orderID = $stmt->fetch(PDO::FETCH_ASSOC);
            return intval($orderID['OrderID'], 10);
        }
        
        $sql = "
            INSERT INTO orders
            (Email, Reference)
            VALUES
            (?, ?)
        ";
        
        $stmt = $this->database->prepare($sql);
        $stmt->execute(array(
            $Email,
            $Hash
        ));
        
        return intval($this->database->lastInsertId(), 10);
    }
    
    public function insertOrderBooking ($HotelID, $RoomtypeID, $FromDate, $ToDate, $Email, $Hash) {
        
        $HRID = $this->getAvailableHRID($HotelID, $RoomtypeID, $FromDate, $ToDate);
        
        if (!$HRID) {
            return array('error' => 'Beklager, det siste rommet ble nettopp booket!', 'errorCode' => 1);
        }
        
        $OrderID = $this->getOrderID($Email, $Hash);
        
        $sql = "
            INSERT INTO bookings
            (`From`, `To`, HRID, OrderID)
            VALUES
            (?, ?, ?, ?)
        ";
        
        $stmt = $this->database->prepare($sql);
        $stmt->execute(array(
            $FromDate,
            $ToDate,
            $HRID,
            $OrderID
        ));
        
        if ($stmt->rowCount() > 0) {
            return array('Reference' => $Hash);
        }
        
        return array('error' => 'Det skjedde en feil med bookingen, vennligst prøv igjen.', 'errorCode' => $stmt->errorCode());
        
    }

}