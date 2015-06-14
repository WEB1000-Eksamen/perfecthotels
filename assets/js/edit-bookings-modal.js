function getBookingsFromReference (reference, success, error) {
    $.ajax({
        url: 'app/api/getBookings.php',
        method: 'GET',
        data: {
            Reference: reference
        }
    }).done(function (data) {
        if (data.error) {
            error(data);
            return;
        }
        success({NumberOfBookings: data.length, Bookings: data});
    });
}