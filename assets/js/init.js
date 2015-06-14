$(function () {
    
    /* NAVBAR ICON */
    
    var navbar          = $('.navbar-left'),
        iconClose       = $('.navbar-hamburger .glyphicon-remove'),
        iconOpen        = $('.navbar-hamburger .glyphicon-menu-hamburger'),
        searchBtn       = $('#searchBtn'),
        ajaxLoader      = '.ajax-loader-gif',
        searchTerms     = $('.search-terms');
    
    
    // Hide search terms by default
    searchTerms.hide();
    // Hide icon by default
    iconOpen.hide();
    
    // disable search button by default
    searchBtn.attr('disabled', true);
    
    $('.navbar-hamburger').bind('click', function () {
        navbar.toggleClass('active');
        
        // hvis navbaren har active,
        // gjem hamburgeren
        // vis krysset
        if (navbar.hasClass('active')) {
            iconOpen.hide();
            iconClose.fadeIn();
            return;
        }
        // ellers skal det
        // motsatte skje
        iconClose.hide();
        iconOpen.fadeIn();
    });
    
    /* NAVBAR DATEPICKER */
    var dateFormat = 'dd M yy',
        today = moment(),
        tomorrow = moment(today).add(1, 'days');
    
    var fromDate = $('#fromDate'),
        toDate = $('#toDate'),
        fromDateBtn = $('#fromDateButton'),
        toDateBtn = $('#toDateButton'),
        options = {
            showOn: "focus",
            numberOfMonths: 1,
            dateFormat: dateFormat
        },
        fromDateOptions = $.extend(true, {
            minDate: today.toDate(),
            onClose: function (selectedDate) {
                if (selectedDate) {
                    var minDateForRange = moment(selectedDate).add(1, 'days');
                    toDate.datepicker("option", "minDate", minDateForRange.toDate());
                }
            }
        }, options),
        toDateOptions = $.extend(true, {
            minDate: tomorrow.toDate()
        }, options);
    
    fromDate.datepicker(fromDateOptions);
    toDate.datepicker(toDateOptions);

    fromDate.on('click', function () {
        fromDate.datepicker('show');
    });
    fromDate.on('focus', function () {
        fromDate.datepicker('show');
    });
    fromDateBtn.on('click', function () {
        fromDate.datepicker('show');
    });
    toDate.on('click', function () {
        toDate.datepicker('show');
    });
    toDate.on('focus', function () {
        toDate.datepicker('show');
    });
    toDateBtn.on('click', function () {
        toDate.datepicker('show');
    });
    
    /* MENU AJAX */
    var countrySelectGroup = $('.select-country-group'),
        roomtypeSelectGroup = $('.select-roomtype-group');
    
    fillCountryGroup(countrySelectGroup, $('.select-country'), ajaxLoader);
    fillRoomtypeGroup(roomtypeSelectGroup, $('.select-roomtype-col'), ajaxLoader);
    
    var inputFields = [toDate, fromDate, roomtypeSelectGroup];
    
    for (input in inputFields) {
        inputFields[input].on('change', function () {
            validateFields(searchBtn, inputFields);
        });
    }
    
    searchBtn.on('click', function (evt) {
        evt.preventDefault();
        
        $('.page-header').find('.ajax-loader-gif').show();
        
        var countryID = $('.select-country-group'),
            resultContainer = $('#the-results'),
            errorContainer = $('.result-errors');
        
        // define search term values
        var searchTermCountry = $('.select-country-group option:selected').text(),
            searchTermFrom = fromDate.val(),
            searchTermTo = toDate.val(),
            searchTermRoomtype = $('.select-roomtype-group option:selected').text();
        
        errorContainer.hide();
        searchTerms.show();
        
        searchTerms.find('#search-term-country').text(searchTermCountry);
        searchTerms.find('#search-term-fromdate').text(searchTermFrom);
        searchTerms.find('#search-term-todate').text(searchTermTo);
        searchTerms.find('#search-term-roomtype').text(searchTermRoomtype);
        
        getHotelsBySearch(countryID.val(), fromDate.val(), toDate.val(), roomtypeSelectGroup.val(), function (data) {
            
            var navbar = $('.navbar-left');
            
            // remove eventual old results
            resultContainer.find('.result-container').remove();
            
            // fill results to result container
            fillResults(data, resultContainer, "#resultTmpl");
            
            $('.page-header').find('.ajax-loader-gif').hide();
            
            if (navbar.hasClass('active')) {
                navbar.removeClass('active');
            }
            
            return;
            
        }, function (error) {
            
            // get rid of old errors
            errorContainer.find('.please-search').hide();
            errorContainer.find('.no-results').remove();
            // get rid of old results
            resultContainer.find('.result-container').remove();
            // render errors
            fillResults({error: error}, errorContainer, "#errorTmpl");
            errorContainer.show();
            
            $('.page-header').find('.ajax-loader-gif').hide();
            
            return;
            
        });
        
    });
});