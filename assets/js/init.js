var dates = ['From', 'To'];

for(var i = 0; i < dates.length; i++) {
    var current = dates[i],
        selectorString = '#date' + current;

    $(selectorString).datepicker({
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

    $(selectorString).on('click', function () {
        $(selectorString).datepicker('show');
    });
    $(selectorString).on('focus', function () {
        $(selectorString).datepicker('show');
    });
}

