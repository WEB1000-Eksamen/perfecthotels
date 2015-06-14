<?php
class EditBookingsFn {
    
    private $database;

    public function __construct (PDO $pdo) {
        $this->database = $pdo;
    }

    public function editExistingBooking ($FromDate, $ToDate, $BookingID) {
        $FromDate = date('Y-m-d', strtotime($FromDate));
        $ToDate = date('Y-m-d', strtotime($ToDate));
        
        if (!$FromDate && !$ToDate && !$BookingID) {
            return array('error' => 'Vennligst sjekk at alle feltene er riktig utfylt.');
        }
        
        $sql = "
            UPDATE bookings
            SET From = ?,
                To = ?
            WHERE bookings.BookingID = ?
        ";
        
        $stmt = $this->database->prepare($sql);
        $stmt->execute(array(
            $FromDate,
            $ToDate,
            $BookingID
        ));
        
        if (!$stmt) {
            return array('error' => 'Det skjedde en feil. Vennligst prøv på nytt.');
        }
        
        return array('success' => 'Bookingen din ble oppdatert.');
    }
}