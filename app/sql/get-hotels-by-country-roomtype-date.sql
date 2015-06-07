SELECT 
     hotels.HotelName
    ,hotels.Address
    ,hotels.Description
    ,images.URL
    ,roomtypes.Price
    ,roomtypes.RoomtypeName
    ,COUNT(hotelroomtypes.HRID) AS AntallRom

FROM hotelroomtypes
INNER JOIN hotels ON (
    hotelroomtypes.HotelID = hotels.HotelID
    AND
    hotels.CountryID = 1
)
INNER JOIN rooms ON (
    hotelroomtypes.RoomID = rooms.RoomID
)
INNER JOIN roomtypes ON (
    hotelroomtypes.RoomtypeID = roomtypes.RoomtypeID
    AND
    roomtypes.RoomtypeID = 2
)
INNER JOIN bookings ON (
    hotelroomtypes.HRID NOT IN (
        SELECT HRID FROM bookings
        WHERE bookings.From BETWEEN '2015-06-04' and '2015-06-07'
        OR bookings.To BETWEEN '2015-06-04' and '2015-06-07'
    )
)
INNER JOIN images ON (
    hotels.ImageID = images.ImageID
)
GROUP BY 
    hotels.HotelName,
    roomtypes.RoomtypeName
HAVING COUNT(hotelroomtypes.HRID) > 0
ORDER BY hotels.HotelName ASC
