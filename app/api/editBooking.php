<?php

require_once '..' . DIRECTORY_SEPARATOR . 'bootstrap.php';
$database = new Database($config);
$pdo = $database->getConnection();

if (isset( $_POST['ToDate'],  $_POST['FromDate'], $_POST['BookingID'])) {
    
    $todate = $_POST['ToDate'];
    fromdate = $_POST['FromDate'];
    $bookingid = $_POST['BookingID'];
    
    header("Content-Type: application/json");
    
    if (!ctype_alnum($reference) && strlen($reference) == 5) {
        echo json_encode(array(
            'error' => 'BookingIDen finnes ikke.'
        ));
        exit();
    }
    
    $stmt = $pdo->prepare("
        UPDATE bookings
        SET From = ?,
            To = ?
        WHERE BookingID = ?
        
    ");
    $stmt->execute(array($reference));
    
    if ($stmt->rowCount() > 0) {
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        echo json_encode($data);
    } else {
        echo json_encode(array('error' => 'Denne referansen inneholder ingen bookinger.', 'errorCode' => 1));
    }
    
    
}