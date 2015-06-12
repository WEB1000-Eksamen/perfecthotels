<?php

// connect to database
require_once '..' . DIRECTORY_SEPARATOR . 'bootstrap.php';
$database = new Database($config);
$pdo = $database->getConnection();

// get default post variables, hotelid, roomtypeid, datefrom, dateto and email

if (isset( $_POST['HotelID'], $_POST['RoomtypeID'], $_POST['Email'], $_POST['FromDate'], $_POST['ToDate'] )) {}

// check if order with same HRID is made before on same date

// if it is, quit execution and return error
// if not
    // hash the email,
    // check if email hash already exists,
        // if it does, get order ID
        // if it doesn't, insert email and hash and get the order ID
    // store order ID for booking values in variable,
    // select a random HRID based on the hotel and roomtype
    // which isn't already booked for the date