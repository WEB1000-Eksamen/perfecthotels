$(function () {
    
    /* NAVBAR ICON */
    
    var navbar      = $('.navbar-left'),
        iconClose   = $('.navbar-hamburger .glyphicon-remove'),
        iconOpen    = $('.navbar-hamburger .glyphicon-menu-hamburger');
    
    // Hide icon by default
    iconOpen.hide();
    
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
            minDate: tomorrow.toDate(),
            onClose: function (selectedDate) {
                fromDate.datepicker("option", "maxDate", selectedDate);
            }
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
});
