-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 07. Jun, 2015 18:12 
-- Server-versjon: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `web-is-gr11w`
--

--
-- Dataark for tabell `bookings`
--

INSERT INTO `bookings` (`BookingID`, `From`, `To`, `HRID`, `OrderID`) VALUES
(1, '2015-06-07', '2015-06-09', 1, 1);

--
-- Dataark for tabell `countries`
--

INSERT INTO `countries` (`CountryID`, `CountryName`) VALUES
(1, 'Norge'),
(2, 'Sverige'),
(3, 'Danmark');

--
-- Dataark for tabell `hotelroomtypes`
--

INSERT INTO `hotelroomtypes` (`HRID`, `HotelID`, `RoomtypeID`, `RoomID`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 2),
(3, 1, 1, 3),
(4, 1, 2, 4),
(5, 2, 1, 1),
(6, 2, 1, 2),
(7, 3, 2, 1),
(8, 3, 2, 2),
(9, 3, 2, 3),
(10, 3, 2, 4),
(11, 3, 2, 5);

--
-- Dataark for tabell `hotels`
--

INSERT INTO `hotels` (`HotelID`, `HotelName`, `Address`, `Description`, `CountryID`, `ImageID`) VALUES
(1, 'The Overlook Hotel', '333 Wonder View Avenue, Estes Park, Colorado', 'The Stanley Hotel is a 140-room Colonial Revival hotel in Estes Park, Colorado. Located within sight of the Rocky Mountain National Park, the Stanley offers panoramic views of the Rockies. It was built by Freelan Oscar Stanley of Stanley Steamer fame and opened on July 4, 1909.', 1, 1),
(2, 'The Stanley Hotel', 'Raveien 227 A, 3184 Borre', 'Vi har badebasseng og sånne ting. Kort vei til alle fasiliteter, som dusj. Dusj er ikke inkludert i noen av rommene. Sug min #&$.', 2, 2),
(3, 'The Norwegian Inn', 'Norgeveien 23, 3108 Sted', 'The Norwegian Inn serves food, not only for the mind but for the soul. Enjoy yourself in one of our crappy bedrooms made of nothing but straws, just like a real viking!', 1, 1);

--
-- Dataark for tabell `hoteltags`
--

INSERT INTO `hoteltags` (`TagID`, `TagText`, `HotelID`) VALUES
(1, 'Kort vei til byen', 1),
(2, 'Lang vei til vannet', 1),
(3, 'Råttent badebasseng', 1),
(4, 'Møkkete toaletter', 1);

--
-- Dataark for tabell `images`
--

INSERT INTO `images` (`ImageID`, `URL`) VALUES
(1, 'http://i.imgur.com/Wx46Qxj.jpg'),
(2, 'http://i.imgur.com/TeNqyV7.jpg'),
(3, 'http://i.imgur.com/HgffBvE.jpg'),
(4, 'http://i.imgur.com/ttTwjyT.jpg'),
(7, 'http://i.imgur.com/p4YHFxL.jpg');

--
-- Dataark for tabell `orders`
--

INSERT INTO `orders` (`OrderID`, `Reference`, `Email`) VALUES
(1, '123ajbj', 'nichlas@agrippa.no');

--
-- Dataark for tabell `rooms`
--

INSERT INTO `rooms` (`RoomID`, `RoomNumber`) VALUES
(1, 101),
(2, 102),
(3, 103),
(4, 104),
(5, 105),
(6, 201),
(7, 202),
(8, 203),
(9, 204),
(10, 205);

--
-- Dataark for tabell `roomtypes`
--

INSERT INTO `roomtypes` (`RoomtypeID`, `RoomtypeName`, `Beds`, `Price`, `ImageID`) VALUES
(1, 'Suite', 1, 1350, 3),
(2, 'Drittrom', 10, 200, 4);

--
-- Dataark for tabell `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Password`) VALUES
(3, 'nic', '$2y$10$BJe1IkuqvQf6g4MGr56jLe3n4CLbA6GgapGeVgFVqtxsHBU.13K/G');
