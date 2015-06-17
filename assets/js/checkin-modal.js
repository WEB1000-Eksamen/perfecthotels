function getAvailableCheckins (reference, success, error) {
    $.ajax({
        url: 'app/api/getAvailableCheckins.php',
        method: 'GET',
        data: {
            Reference: reference
        }
    }).done(function (result) {
        if (result.error) {
            error(result);
            return;
        }
        success(result);
        return;
    });
}

function doCheckin (bookingids, reference, success, error) {
    $.ajax({
        url: 'app/api/checkinBooking.php',
        method: 'POST',
        data: {
            BookingIDs: bookingids,
            Reference: reference
        }
    }).done(function (result) {
        if (result.error) {
            error(result);
            return;
        }
        success(result);
        return;
    });
}

function fillAvailableCheckins(data, successContainer, successTableBody, errorContainer, errorContainerText, loader) {
    loader.hide();
    if (data.error) {
        errorContainerText.text(data.error);
        errorContainer.show();
        return;
    }
    
    for (var i = 0; i < data.length; i++) {
        var booking = data[i],
            tableRow = $('<tr></tr>'),
            hotelnameCell = $('<td></td>').text(booking.HotelName),
            roomtypeCell = $('<td></td>').text(booking.RoomtypeName),
            fromCell = $('<td></td>').text(moment(booking.From).locale('nb').format('LL')),
            toCell = $('<td></td>').text(moment(booking.To).locale('nb').format('LL')),
            chooseInput = $('<input>').attr({
                type: 'checkbox',
                value: booking.BookingID
            }).css({
                height: '20px',
                width: '20px'
            }),
            chooseCell = $('<td></td>').css({'text-align': 'center'}).append(chooseInput);
        
        tableRow.append(chooseCell);
        tableRow.append(hotelnameCell);
        tableRow.append(roomtypeCell);
        tableRow.append(fromCell);
        tableRow.append(toCell);
        
        tableRow.on('click', function () {
            var inputEl = $(this).find('input');
            if (inputEl.prop('checked')) {
                inputEl.prop('checked', false);
                $(this).removeAttr('style');
                return;
            }
            inputEl.prop('checked', true);
            $(this).css('background-color', '#dff0d8');
        });
        chooseInput.on('click', function () {
            var rowEl = $(this).closest('tr');
            if ($(this).prop('checked')) {
                $(this).prop('checked', false);
                rowEl.removeAttr('style');
                return;
            }
            $(this).prop('checked', true);
            rowEl.css('background-color', '#dff0d8');
        })
        
        successTableBody.append(tableRow);
    }
    successContainer.slideDown('slow');
}

function fillRoomNumbers (data, successContainer, successTableBody, errorContainer, errorContainerText, loader) {
    loader.hide();
    if (data.error) {
        errorContainerText.text(data.error);
        errorContainer.show();
        return;
    }
    
    /*
    <th>Hotellnavn</th>
    <th>Bookingnummer</th>
    <th>Romnummer</th>
    */
    
    for (var i = 0; i < data[0].length; i++) {
        var checkin = data[0][i],
            tableRow = $('<tr></tr>'),
            hotelnameCell = $('<td></td>').text(checkin.HotelName),
            referenceCell = $('<td></td>').text(checkin.Reference),
            roomnumberCell = $('<td></td>').text(checkin.RoomNumber),
            roomtypeCell = $('<td></td>').text(checkin.RoomtypeName);
        
        tableRow.append(hotelnameCell);
        tableRow.append(referenceCell);
        tableRow.append(roomnumberCell);
        tableRow.append(roomtypeCell);
        
        successTableBody.append(tableRow);
    }
    
    successContainer.slideDown('slow');
    
}

function checkinGoStepTwo (container, mainElement, reference) {    
    var backBtn = mainElement.find('.checkin-modal-go-back'),
        checkinBtn = mainElement.find('.checkin-modal-step2-do-booking'),
        step2 = container.find('#checkin-modal-step2-container'),
        step3 = container.find('#checkin-modal-step3-container'),
        step2SuccessContainer = container.find('.checkin-modal-step2-success'),
        step3SuccessContainer = container.find('.checkin-modal-step3-success'),
        step2SuccessCounter = step2SuccessContainer.find('.checkin-modal-step2-number-of-bookings'),
        step2ErrorContainer = container.find('.checkin-modal-step2-error'),
        step3ErrorContainer = container.find('.checkin-modal-step3-error'),
        step2ErrorText = step2ErrorContainer.find('.checkin-modal-step2-error-text'),
        step3ErrorText = step3ErrorContainer.find('.checkin-modal-step3-error-text'),
        step2TableBody = step2.find('.checkin-modal-step2-table-body'),
        step3TableBody = step3.find('.checkin-modal-step3-table-body'),
        loadingStep2 = step2.find('.ajax-loader-container'),
        loadingStep3 = step3.find('.ajax-loader-container'),
        referenceValue = reference.val();
        
    reference.val('');
    mainElement.find('.modal-checkin-submit').prop('disabled', true);
    
    if (container.hasClass('checkin-success')) {
        container.removeClass('checkin-success');
    }
    container.addClass('checkin');
    
    getAvailableCheckins(referenceValue, function (success) {
        fillAvailableCheckins(success, step2SuccessContainer, step2TableBody, step2ErrorContainer, step2ErrorText, loadingStep2);
        step2SuccessCounter.text(success.length);
        checkinBtn.show();
    }, function (error) {
        fillAvailableCheckins(error, step2SuccessContainer, step2TableBody, step2ErrorContainer, step2ErrorText, loadingStep2);
    });
    
    
    backBtn.show();
    backBtn.on('click', function () {
        if (container.hasClass('checkin')) {
            container.removeClass('checkin');
            loadingStep2.show();
            step2SuccessContainer.hide();;
            step2TableBody.empty();
            step2ErrorContainer.hide();
            step2ErrorText.empty();
            backBtn.hide();
            checkinBtn.hide();
        }
    });
    
    mainElement.on('click', '.close', function () {
        // CLEANUP ALL THE THINGS
        step2TableBody.empty();
        step2SuccessContainer.hide();
        step2ErrorContainer.hide();
        step2ErrorText.empty();
        step3TableBody.empty();
        step3SuccessContainer.hide();
        step3ErrorContainer.hide();
        step3ErrorText.empty();
        loadingStep2.show();
        loadingStep3.show();
        backBtn.hide();
        checkinBtn.hide();
        if (container.hasClass('checkin')) {
            container.removeClass('checkin');
        }
        if (container.hasClass('checkin-done')) {
            container.removeClass('checkin-done');
        }
    });
    
    checkinBtn.on('click', function () {
        var bookings = step2.find('input[type="checkbox"]:checked'),
            bookingIds = [];
        
        if (bookings.length < 1) {
            return false;
        }
        
        for (var i = 0; i < bookings.length; i++) {
            var bookingId = $(bookings[i]).val();
            bookingIds.push(bookingId);
        }
        
        checkinGoStepThree(container, mainElement, bookingIds, referenceValue);
        
    });
}

function checkinGoStepThree (container, mainElement, bookingIds, reference) {
    var backBtn = mainElement.find('.checkin-modal-go-back'),
        bookingBtn = mainElement.find('.checkin-modal-step2-do-booking'),
        step3 = container.find('#checkin-modal-step3-container'),
        step3SuccessContainer = container.find('.checkin-modal-step3-success'),
        step3ErrorContainer = container.find('.checkin-modal-step3-error'),
        step3ErrorText = step3ErrorContainer.find('.checkin-modal-step3-error-text'),
        step3TableBody = step3.find('.checkin-modal-step3-table-body'),
        loadingStep3 = step3.find('.ajax-loader-container');

    backBtn.hide();
    bookingBtn.hide();
    
    if (container.hasClass('checkin')) {
        container.removeClass('checkin');
    }
    container.addClass('checkin-done');
    
    doCheckin(bookingIds, reference, function (success) {
        fillRoomNumbers(success, step3SuccessContainer, step3TableBody, step3ErrorContainer, step3ErrorText, loadingStep3);
    }, function (error) {
        console.log(error);
    });
}