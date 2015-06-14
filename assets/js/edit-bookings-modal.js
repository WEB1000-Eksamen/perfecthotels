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

function goStepTwo (editBookingsModalContainer, editBookingModal, userInput) {
    editBookingsModalContainer.addClass('edit');
    editBookingModal.find('.edit-bookings-modal-go-back').show();

    getBookingsFromReference(userInput.val(), function (data) {        
        editBookingsModalContainer.find('.step2 .ajax-loader-container').hide();
        fillBookingAPIResults(
            data,
            $('.edit-bookings-modal-step2-table-container'),
            $('.edit-bookings-modal-step2-table'),
            $('.edit-bookings-modal-step2-number-of-bookings'),
            $('.edit-bookings-modal-step2-error')
        );
    });
}

function initBookingDatepickers (fromDateElement, toDateElement, options) {
    
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
    
    var tableRows,
        dateFields = [];
    
    for (var i = 0; i < data.Bookings.length; i++) {
        var booking = data.Bookings[i],
            tableRow        = $('<tr></tr>').data({ booking: parseInt(booking.BookingID) }),
            hotelNameCell   = $('<td></td>').text(booking.HotelName),
            roomtypeCell    = $('<td></td>'),
            roomtypeSelect  = $('<select></select>').addClass('form-control'),
            fromCell        = $('<td></td>'),
            toCell          = $('<td></td>'),
            fromDateInput = $('<input>')
                .attr({
                    id: 'fromDateBooking' + i,
                    type: 'text',
                    value: moment(booking.From).locale('nb').format('DD MMM YYYY')
                })
                .prop('readonly', true)
                .addClass('form-control'),
            toDateInput = $('<input>')
                .attr({
                    id: 'toDateBooking' + i,
                    type: 'text',
                    value: moment(booking.To).locale('nb').format('DD MMM YYYY')
                })
                .prop('readonly', true)
                .addClass('form-control'),
            checkedInCell = $('<td></td>')
                .text(
                    (parseInt(booking.Active) === 1) ? 'Ja' : 'Nei'
                ),
            buttonCell      = $('<td></td>');
        
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
        
        tableRows = tableRows + '<tr>' + tableRow.html() + '</tr>';
        
        dateFields.push({ fromDate: fromDateInput, toDate: toDateInput });
    }
    
    
    tableBodyElement.html(tableRows);
    countSpanElement.text(data.NumberOfBookings);
    tableContainerElement.show();
    
    for (var i = 0; i < dateFields.length; i++) {
        var today = moment(),
            tomorrow = moment(today).add(1, 'days')
        
        tableBodyElement.find('#fromDateBooking' + i).datepicker({
            showOn: "focus",
            numberOfMonths: 1,
            dateFormat: 'dd M yy',
            minDate: today.toDate(),
            onClose: function (selectedDate) {
                if (selectedDate) {
                    var minDateForRange = moment(selectedDate).add(1, 'days'),
                        datePickerPartial = $(this).attr('id').substring(4);
                    tableBodyElement.find('#to' + datePickerPartial).datepicker("option", "minDate", minDateForRange.toDate());
                }
            }
        });
        tableBodyElement.find('#toDateBooking' + i).datepicker({
            showOn: "focus",
            numberOfMonths: 1,
            dateFormat: 'dd M yy',
            minDate: tomorrow.toDate()
        });

        tableBodyElement.find('#fromDateBooking' + i).on('click', function () {
            $(this).datepicker('show');
        });
        tableBodyElement.find('#fromDateBooking' + i).on('focus', function () {
            $(this).datepicker('show');
        });
        tableBodyElement.find('#toDateBooking' + i).on('click', function () {
            $(this).datepicker('show');
        });
        tableBodyElement.find('#toDateBooking' + i).on('focus', function () {
            $(this).datepicker('show');
        });
    }
}





















