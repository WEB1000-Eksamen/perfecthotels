function getBookingsFromReference (reference, success) {
    $.ajax({
        url: 'app/api/getBookings.php',
        method: 'GET',
        data: {
            Reference: reference
        }
    }).done(function (data) {
        if (data.error) {
            success(data);
            return;
        }
        success({NumberOfBookings: data.length, Bookings: data});
        return;
    });
}

function initBookingDatepickers (fromDateElement, toDateElement, options) {
    
    var today = moment(),
        tomorrow = moment(today).add(1, 'days'),
        fromDateFn = function () {
            fromDateElement.datepicker('show');
        },
        toDateFn = function () {
            toDateElement.datepicker('show');
        },
        fromDateOptions = $.extend(true, {
            minDate: today.toDate(),
            onClose: function (selectedDate) {
                if (selectedDate) {
                    console.log(selectedDate);
                    var minDateForRange = moment(selectedDate).add(1, 'days');
                    toDateElement.datepicker("option", "minDate", minDateForRange.toDate());
                    
                    console.log(minDateForRange.toDate());
                }
            }
        }, options),
        toDateOptions = $.extend(true, {
            minDate: tomorrow.toDate()
        }, options);
    
    fromDateElement.datepicker(fromDateOptions);
    toDateElement.datepicker(toDateOptions);
    
    fromDateElement.on({
        click: fromDateFn,
        focus: fromDateFn
    });
    
    toDateElement.on({
        click: toDateFn,
        focus: toDateFn
    });
}

function fillBookingAPIResults (data, tableContainerElement, tableBodyElement, countSpanElement, errorContainerElement) {
    
    if (data.error) {
        var errorElement = $('<p></p>');
        
        errorElement.text(data.error).addClass('bg-danger');
        errorContainerElement.append(errorElement.html());
        
        tableContainerElement.hide();
        errorContainerElement.show();
        return;
    }
    
    for (var i = 0; i < data.Bookings.length; i++) {
        
        console.log(data.Bookings.length);
        
        var booking = data.Bookings[i],
            tableRow = $('<tr></tr>').data({ booking: parseInt(booking.BookingID) }),
            hotelNameCell = $('<td></td>').text(booking.HotelName),
            roomtypeCell = $('<td></td>'),
            roomtypeSelect = $('<select></select>').addClass('form-control'),
            fromCell = $('<td></td>'),
            toCell = $('<td></td>'),
            fromDateInput = $('<input>')
                .attr({
                    id: 'fromDateBooking' + i,
                    type: 'text'
                })
                .prop('readonly', true)
                .val(moment(booking.From).locale('nb').format('DD MMM YYYY'))
                .addClass('form-control'),
            toDateInput = $('<input>')
                .attr({
                    id: 'toDateBooking' + i,
                    type: 'text'
                })
                .prop('readonly', true)
                .val(moment(booking.To).locale('nb').format('DD MMM YYYY'))
                .addClass('form-control'),
            checkedInCell = $('<td></td>')
                .text(
                    (parseInt(booking.Active) === 1) ? 'Ja' : 'Nei'
                ),
            buttonCell = $('<td></td>');
        
        for (var j = 0; j < booking.AvailableRoomtypes.length; j++) {
            var roomtype = booking.AvailableRoomtypes[j],
                option = $('<option></option>')
                            .attr({ 'value': parseInt(roomtype.RoomtypeID) })
                            .text(roomtype.RoomtypeName);
            if (booking.RoomtypeID == roomtype.RoomtypeID) {
                option.attr('selected', 'selected');
            }
            
            roomtypeSelect.append(option);
        }
        
        roomtypeCell.append(roomtypeSelect);
        fromCell.append(fromDateInput);
        toCell.append(toDateInput);
        buttonCell.append('<button data-booking-id="' + booking.BookingID + '" class="btn btn-primary">Endre</button>');
        tableRow.append(hotelNameCell);
        tableRow.append(roomtypeCell);
        tableRow.append(fromCell);
        tableRow.append(toCell);
        tableRow.append(checkedInCell);
        tableRow.append(buttonCell);
        
        tableBodyElement.append(tableRow);
        
        
        initBookingDatepickers(
            fromDateInput,
            toDateInput,
            {
                showOn: "focus",
                numberOfMonths: 1,
                dateFormat: 'dd M yy'
            }
        );
        
    }
    
    countSpanElement.text(data.NumberOfBookings);
    tableContainerElement.show();
    
    
}





















