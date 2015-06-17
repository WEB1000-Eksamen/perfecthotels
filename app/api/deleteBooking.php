<?php

require_once '..' . DIRECTORY_SEPARATOR . 'bootstrap.php';
$database = new Database($config);
$pdo = $database->getConnection();

if (isset($_POST['BookingID'])) {
    
    header('Content-Type: application/json');
    
    if (!ctype_digit($_POST['BookingID'])) {
        echo json_encode(array('error' => 'Ugyldig bookingidentifikasjon'));
        exit();
    }
    
    $checkSql = "
        SELECT bookings.BookingID
        FROM bookings
        WHERE bookings.BookingID = ?
        AND Active = true
    ";
    
    $stmtC = $pdo->prepare($checkSql);
    $stmtC->execute(array($_POST['BookingID']));
    
    if ($stmtC->rowCount() > 0) {
        echo json_encode(array('error' => 'Du kan ikke slette en booking du har sjekket inn på.'));
        exit();
    }
    
    $sql = "DELETE FROM bookings WHERE bookings.BookingID = ?";
    
    $stmt = $pdo->prepare($sql);
    
    $stmt->execute(array($_POST['BookingID']));
    
    echo json_encode(array('success' => 'Bookingen ble fjernet.'));
}