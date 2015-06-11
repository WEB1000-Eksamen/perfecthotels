function getCountries (callback, errorCallback) {
    $.ajax({
        method: 'GET',
        url: 'app/api/getCountries.php'
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
        url: 'app/api/getRoomtypes.php'
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

function fillCountryGroup (countryGroup) {

    var i = 0;

    getCountries(function (countries) {
        for (countryIndex in countries) {

            var country = countries[countryIndex],
                buttonLabel = $('<label></label>').addClass('btn').addClass('btn-default'),
                button = $('<input>').attr({
                    type: 'radio',
                    name: 'country',
                    autocomplete: 'off'
                }).val(country.CountryID),
                buttonText = $('<strong>').text(country.CountryName);

            if (i === 0) {
                button.prop('checked', true);
                buttonLabel.addClass('active');
            }

            var entireButton = buttonLabel.append(button).append(buttonText);
            countryGroup.append(entireButton);

            i++;
        }
    }, function (errorText) {
        countryGroup.remove();
        $('.select-country').append('<p></p>').text(errorText);
        $('#searchBtn').attr('disabled', true);
    });
}

function fillRoomtypeGroup (roomtypeGroup) {

    var i = 0;

    getRoomtypes(function (roomtypes) {
        for (roomtypeIndex in roomtypes) {

            var roomtype = roomtypes[roomtypeIndex],
                bedText = (roomtype.Beds > 1) ? 'senger' : 'seng',
                option = $('<option>').text(
                    roomtype.RoomtypeName + ' (' + roomtype.Beds + ' ' + bedText + ')'
                ).val(roomtype.RoomtypeID);

            roomtypeGroup.append(option);

            i++;
        }
    }, function (errorText) {
        roomtypeGroup.remove();
        $('.select-roomtype-col').append('<p></p>').text(errorText);
        $('#searchBtn').attr('disabled', true);
    });
}