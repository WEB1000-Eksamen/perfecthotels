<?php
class EditBookingsFn extends PostBookingFn {
    
    private $database;

    public function __construct (PDO $pdo) {
        $this->database = $pdo;
    }
    
    private function alreadyBooked ($FromDate, $ToDate, $HRID) {
        $sql = "
            SELECT
                bookings.BookingID
            FROM bookings
            WHERE
            bookings.HRID IN (
                SELECT HRID FROM bookings
                WHERE
                bookings.`From` BETWEEN ? AND ?
                OR
                bookings.`To` BETWEEN ? AND ?
            )
            AND
            bookings.HRID = ?
            LIMIT 1
        ";
        
        $stmt = $this->database->prepare($sql);
        $stmt->execute(array(
            $FromDate,
            $ToDate,
            $FromDate,
            $ToDate,
            $HRID
        ));
        
        if ($stmt->rowCount() > 0) {
            return true;
        }
        return false;
    }
    
    private function alreadyBookedByUser ($FromDate, $ToDate, $HRID, $BookingID) {
        $sql = "
            SELECT
                bookings.BookingID
            FROM bookings
            WHERE
            bookings.HRID IN (
                SELECT HRID FROM bookings
                WHERE
                bookings.`From` BETWEEN ? AND ?
                OR
                bookings.`To` BETWEEN ? AND ?
            )
            AND
            bookings.HRID = ?
            AND
            bookings.BookingID = ?
            LIMIT 1
        ";
        
        $stmt = $this->database->prepare($sql);
        $stmt->execute(array(
            $FromDate,
            $ToDate,
            $FromDate,
            $ToDate,
            $HRID,
            $BookingID
        ));
        
        if ($stmt->rowCount() > 0) {
            return true;
        }
        return false;
    }

    public function editExistingBooking ($FromDate, $ToDate, $BookingID, $HRID) {
        $FromDate = date('Y-m-d', strtotime($FromDate));
        $ToDate = date('Y-m-d', strtotime($ToDate));
        
        if (!$FromDate && !$ToDate && !$BookingID) {
            return array('error' => 'Vennligst sjekk at alle feltene er riktig utfylt.');
        }
        
        if ($this->alreadyBookedByUser($FromDate, $ToDate, $HRID, $BookingID) === true) {
            return array('error' => 'Rommet er allerede booket av deg på denne datoen.');
        }
        
        if ($this->alreadyBooked($FromDate, $ToDate, $HRID) === true) {
            return array('error' => 'Rommet er ikke ledig på denne datoen.');
        }
        
        $sql = "
            UPDATE bookings
            SET bookings.From = ?,
                bookings.To = ?
            WHERE bookings.BookingID = ?
        ";
        
        $stmt = $this->database->prepare($sql);
        $stmt->execute(array($FromDate,$ToDate,$BookingID));
        
        if (!$stmt) {
            return array('error' => 'Det skjedde en feil. Vennligst prøv på nytt.');
        }
        
        return array('success' => 'Bookingen din ble oppdatert.', 'ID' => $BookingID, 'Dates' => array($FromDate, $ToDate));
    }
}