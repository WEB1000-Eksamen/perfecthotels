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

function fillAvailableCheckins(data, successContainer, successTableBody, errorContainer, errorContainerText, loader) {
    loader.hide();
    if (data.error) {
        errorContainerText.text(data.error);
        errorContainer.show();
        return;
    }
    
    /*
    <th>Hotellnavn</th>
    <th>Romtype</th>
    <th>Fra</th>
    <th>Til</th>
    <th>Velg</th>
    */
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
        
        successTableBody.append(tableRow);
    }
    successContainer.show();
}

function checkinGoStepTwo (container, mainElement, reference) {    
    var backBtn = mainElement.find('.checkin-modal-go-back'),
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
        loadingStep3 = step3.find('.ajax-loader-container');
    
    if (container.hasClass('checkin-success')) {
        container.removeClass('checkin-success');
    }
    container.addClass('checkin');
    
    getAvailableCheckins(reference.val(), function (success) {
        fillAvailableCheckins(success, step2SuccessContainer, step2TableBody, step2ErrorContainer, step2ErrorText, loadingStep2);
        step2SuccessCounter.text(success.length);
    }, function (error) {
        fillAvailableCheckins(error, step2SuccessContainer, step2TableBody, step2ErrorContainer, step2ErrorText, loadingStep2);
    });
    
    reference.val('');
    
    backBtn.show();
    backBtn.on('click', function () {
        if (container.hasClass('checkin')) {
            container.removeClass('checkin');
            loadingStep2.show();
            step2SuccessContainer.hide();
            step2TableBody.empty();
            step2ErrorContainer.hide();
            step2ErrorText.empty();
            backBtn.hide();
        }
    });
    
    mainElement.on('click', '.close', function () {
        // CLEANUP ALL THE THINGS
        step2TableBody.empty();
        step3TableBody.empty();
        loadingStep2.show();
        loadingStep3.show();
    });
}

function checkinGoStepThree (container, mainElement) {
    var backBtn = mainElement.find('.checkin-modal-go-back');
    backBtn.hide();
    
    if (container.hasClass('checkin')) {
        container.removeClass('checkin');
    }
    container.addClass('checkin-success');
}