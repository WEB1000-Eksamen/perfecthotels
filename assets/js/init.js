(function () { 
    var dates = ['dateFrom', 'dateTo'];

    for(var i = 0; i < dates.length; i++) {
        var current = dates[i];
        console.log(current);

        $('#' + current).datepicker({
            showOn: "focus",
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
        });

        $('#' + current).bind('click', function () {
            $('#' + current).datepicker('show');
        });
        $('#' + current).bind('focus', function () {
            $('#' + current).datepicker('show');
        });
    }
    
    $('.navbar-hamburger').bind('click', function () {
        $('.navbar-left').toggleClass('active');
    });
    
})();