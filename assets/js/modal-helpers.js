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

function formatMoney(n) {
    return n.toFixed(0).replace(/./g, function(c, i, a) {
        return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? " " + c : c;
    });
}