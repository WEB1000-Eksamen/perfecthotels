$(function () {
    $('.checkin-btn').on('click', function () {
        var editBookingModal = $('#checkin-modal'),
            editBookingsModalContainer = $('.checkin-modal-container'),
            userInput = editBookingsModalContainer.find('.modal-checkin-reference-input'),
            editBtn = editBookingsModalContainer.find('.modal-checkin-submit');
        
        userInput.tooltip({
            trigger: 'hover',
            placement: 'top'
        });
        
        userInput.keyup(function (evt) {
            if (evt.target.value.length === 6) {
                editBtn.attr('disabled', false);
                $(this).tooltip('hide');
                return;
            }
            editBtn.attr('disabled', true);
        });
        
        userInput.keydown(function (evt) {
            if (evt.target.value.length === 6 && evt.keyCode === 13) {
                editBtn.attr('disabled', false);
                $(this).tooltip('hide');
                return;
            }
        });
        
        editBookingModal.on('click', '.modal-checkin-submit', function () {
            
            checkinGoStepTwo
            
        });
    });
});