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

function orderRoom (email, fromdate, todate, success, error) {
    $.ajax({
        url: 'app/api/postOrder.php',
        method: 'POST',
        dataType: 'json',
        data: {
            Email: email,
            FromDate: fromdate,
            ToDate: todate
        }
    }).done(function (response) {
        if (response.error) {
            error({error: response.error});
            return;
        }
        success();
        return;
    });
}