function getCountries (callback, errorCallback) {
    $.ajax({
        method: 'GET',
        url: 'app/api/getCountries.php',
        dataType: 'json'
    }).done(function (data) {
        if (data.errorCode) {
            switch(data.errorCode) {
                case 1:
                    errorCallback('Ingen land er registrert.');
                    break;
            }
            return;
        }
        callback(data);
    });
}

function getRoomtypes (callback, errorCallback) {
    $.ajax({
        method: 'GET',
        url: 'app/api/getRoomtypes.php',
        dataType: 'json'
    }).done(function (data) {
        if (data.errorCode) {
            switch(data.errorCode) {
                case 1:
                    errorCallback('Ingen romtyper er registrert.');
                    break;
            }
            return;
        }
        callback(data);
    });
}

function getRoomtypesByCountry (countryid, callback, errorCallback) {
    $.ajax({
        url: 'app/api/getRoomtypesByCountry.php',
        method: 'GET',
        dataType: 'json',
        data: {
            CountryID: countryid
        }
    }).done(function (result) {
        if (result.error) {
            errorCallback(result.error);
            return;
        }
        callback(result);
    });
}

function fillCountryGroup (countryGroup, selectCountryContainer, loader) {

    var i = 0;
    
    getCountries(function (countries) {
        for (countryIndex in countries) {

            var country = countries[countryIndex],
                option = $('<option>').text(
                    country.CountryName
                ).val(country.CountryID);

            countryGroup.append(option);

            i++;
        }
        selectCountryContainer.find(loader).hide();
        countryGroup.show();
    }, function (errorText) {
        countryGroup.remove();
        $('.select-country').append('<p></p>').text(errorText);
        $('#searchBtn').attr('disabled', true);
    });
}

function fillRoomtypeGroup (countryId, roomtypeGroup, selectRoomtypeContainer, loader, searchBtn, inputFields) {

    var i = 0;
    
    if (roomtypeGroup.children().length > 0) {
        roomtypeGroup.children().hide();
    }
    
    selectRoomtypeContainer.find('.roomtype-error-text').hide();
    
    getRoomtypesByCountry(countryId, function (roomtypes) {
        for (roomtypeIndex in roomtypes) {

            var roomtype = roomtypes[roomtypeIndex],
                bedText = (roomtype.Beds > 1) ? 'senger' : 'seng',
                option = $('<option>').text(
                    roomtype.RoomtypeName + ' (' + roomtype.Beds + ' ' + bedText + ')'
                ).val(roomtype.RoomtypeID);

            roomtypeGroup.append(option);

            i++;
        }
        
        validateFields(searchBtn, inputFields);
        
        selectRoomtypeContainer.find(loader).hide();
        selectRoomtypeContainer.find('.roomtype-error-text').hide();
        roomtypeGroup.show();
    }, function (errorText) {
        var errorField = $('.select-roomtype-col').find('.roomtype-error-text');
        roomtypeGroup.hide();
        roomtypeGroup.empty();
        selectRoomtypeContainer.find(loader).hide();
        errorField.text(errorText).show();
        $('#searchBtn').attr('disabled', true);
    });
}

function doSearch (modal) {
    
}

function validateFields (button, inputFields) {
    var fields = inputFields.length,
        validatedFields = 0;
        
    if (fields > 0) {
        for (input in inputFields) {
            if (inputFields[input].val()) {
                validatedFields++;
            }
        }
        if (validatedFields >= fields) {
            button.attr('disabled', false);
        }
    }
}

function getHotelsBySearch (country, fromDate, toDate, roomtype, success, error) {
    
    $.ajax({
        
        url: 'app/api/getHotels.php',
        method: 'GET',
        dataType: 'json',
        data: {
            country: country,
            fromDate: fromDate,
            toDate: toDate,
            roomtype: roomtype
        }
    }).done(function (response) {
        if (response.errorCode == 1) {
            error(response.error);
            return;
        }
        success(response);
        return;
    });

}











