$(function () {
    
    var countrySelect = $('.select-country-group'),
        roomtypeSelect = $('.select-roomtype-group'),
        countrySelectBtn = $('<input type="radio" name="country" value="Norge" id="option1" autocomplete="off" checked> <strong>Norge</strong>'),
        roomtypeSelectOpt;
    
    function getCountries (callback) {
        $.ajax({
            method: 'GET',
            url: 'app/api/getCountries.php'
        }).done(function (data) {
            callback(data);
        });
    }
    
    function getRoomtypes (callback) {
        $.ajax({
            method: 'GET',
            url: 'app/api/getRoomtypes.php'
        }).done(function (data) {
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
        });
    }
    
    fillCountryGroup(countrySelect);
    fillRoomtypeGroup(roomtypeSelect);

});