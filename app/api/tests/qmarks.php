<?php

require_once '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'bootstrap.php';
$database = new Database($config);
$pdo = $database->getConnection();
$Checkin = new CheckinBookingFn($pdo);

echo $Checkin->generateQuestionMarks(
    array(
        '0' => 'value',
        '1' => 'value',
        '2' => 'value'
    )
);