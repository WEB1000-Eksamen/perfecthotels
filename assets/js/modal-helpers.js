function getModalInfo (hotelid, roomtypeid, success, error) {
    $.ajax({
        url: 'app/api/getHotelInfo.php',
        method: 'GET',
        dataType: 'json',
        data: {
            HotelID: hotelid,
            RoomtypeID: roomtypeid
        }
    }).done(function (response) {
        if (response.error) {
            error({error: response.error, errorCode: response.errorCode});
            return;
        }
        success(response);
        return;
    });
}

function orderRoom (hotelid, roomtypeid, email, fromdate, todate, success, error) {
    $.ajax({
        url: 'app/api/postBooking.php',
        method: 'POST',
        dataType: 'json',
        data: {
            HotelID: hotelid,
            RoomtypeID: roomtypeid,
            Email: email,
            FromDate: fromdate,
            ToDate: todate
        }
    }).done(function (response) {
        if (response.error) {
            error({error: response.error});
            return;
        }
        success(response);
        return;
    });
}