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

function deleteBookingByID (bookingid, success, error) {
    $.ajax({
        url: 'app/api/deleteBooking.php',
        method: 'POST',
        data: {
            BookingID: bookingid
        }
    }).done(function (result) {
        if (result.success) {
            success(result);
            return;
        }
        if (result.error) {
            error(result);
            return;
        }
        
        error({error: 'Vi kunne ikke fjerne bookingen, vennligst prøv på nytt.'});
        
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
        
        var bookingsBtn = editBookingsModalContainer.find('.btn-delete-booking');
        
        bookingsBtn.on('click', function () {
            var bookingID = $(this).data('bookingId'),
                bookingButton = $(this),
                confString = 'Er du sikker på at du vil slette bookingen?',
                conf = confirm(confString);
            
            if (conf) {
                deleteBookingByID(bookingID, function (success) {
                    
                    var numberOfBookingsEl = editBookingsModalContainer.find('.edit-bookings-modal-step2-number-of-bookings'),
                        numberOfBookings = parseInt(numberOfBookingsEl.text());
                    
                    numberOfBookings = numberOfBookings - 1;
                    
                    bookingButton.closest('tr').addClass('bg-delete-error');
                    bookingButton.closest('tr').fadeOut('slow');
                    
                    numberOfBookingsEl.text(numberOfBookings--);
                    
                    console.log(numberOfBookings);
                    
                }, function (error) {
                    alert(error.error);
                    bookingButton.closest('tr').addClass('bg-delete-error');
                    setTimeout(function () {
                        bookingButton.closest('tr').removeClass('bg-delete-error');
                    }, 500);
                });
            }
        });
        
        
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
            //roomtypeSelect  = $('<select></select>').addClass('form-control'),
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
            buttonEditCell  = $('<td></td>'),
            buttonDeleteCell = $('<td></td>');
        
        /*for (var j = 0; j < booking.AvailableRoomtypes.length; j++) {
            var roomtype = booking.AvailableRoomtypes[j],
                option = $('<option></option>')
                            .attr({ 'value': parseInt(roomtype.RoomtypeID) })
                            .text(roomtype.RoomtypeName);
            if (booking.RoomtypeID == roomtype.RoomtypeID) {
                option.attr('selected', 'selected');
            }
            
            roomtypeSelect.append(option);
        }*/
        
        roomtypeCell.append(
            booking.RoomtypeName
            //roomtypeSelect
        );
        fromCell.append(fromDateInput);
        toCell.append(toDateInput);
        buttonEditCell.append('<button data-booking-id="' + booking.BookingID + '" class="btn btn-primary btn-sm btn-update-booking">Endre</button>');
        buttonDeleteCell.append('<button data-booking-id="' + booking.BookingID + '" class="btn btn-danger btn-sm btn-delete-booking">Slett</button>');
        tableRow.append(hotelNameCell);
        tableRow.append(roomtypeCell);
        tableRow.append(fromCell);
        tableRow.append(toCell);
        tableRow.append(checkedInCell);
        tableRow.append(buttonEditCell);
        tableRow.append(buttonDeleteCell);
        
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