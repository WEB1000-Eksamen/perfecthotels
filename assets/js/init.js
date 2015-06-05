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
    var today = new Date(),
        tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1);
    
    var fromDate = $('#fromDate'),
        toDate = $('#toDate'),
        options = {
            showOn: "focus",
            numberOfMonths: 1,
            dateFormat: 'DD dd. MM yy',
            dayNames: [ "Søndag", "Mandag", "Tirsdag", "Onsdag", "Torsdag", "Fredag", "Lørdag" ],
            dayNamesMin: [ "Sø", "Ma", "Ti", "On", "To", "Fr", "Lø" ],
            monthNames: [ 
                "Januar", 
                "Februar", 
                "Mars", 
                "April", 
                "Mai", 
                "Juni", 
                "Juli", 
                "August", 
                "September", 
                "Oktober", 
                "November", 
                "Desember" 
            ]
        },
        fromDateOptions = $.extend(true, {
            minDate: today,
            onClose: function (selectedDate) {
                if (selectedDate) {
                    var validDate = new Date(selectedDate);
                    validDate.setDate(validDate.getDate() + 1);
                    toDate.datepicker("option", "minDate", validDate);
                }
            }
        }, options),
        toDateOptions = $.extend(true, {
            minDate: tomorrow,
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
    toDate.on('click', function () {
        toDate.datepicker('show');
    });
    toDate.on('focus', function () {
        toDate.datepicker('show');
    });
    
    /* mock api */
    
    var hotelContent = [{
        hotelName: '',
        text: '',
        image: '',
        categories: []
    }];
    
});
