var dates = ['dateFrom', 'dateTo'];

for(var i = 0; i < dates.length; i++) {
    var current = dates[i];

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

    $('#' + current).on('click', function () {
        $('#' + current).datepicker('show');
    });
    $('#' + current).on('focus', function () {
        $('#' + current).datepicker('show');
    });
}

