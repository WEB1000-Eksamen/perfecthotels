$(function () {
    $('.checkin-btn').on('click', function () {
        var checkinModal = $('#checkin-modal'),
            checkinModalContainer = $('.checkin-modal-container'),
            userInput = checkinModalContainer.find('.modal-checkin-reference-input'),
            checkinBtn = checkinModalContainer.find('.modal-checkin-submit');
        
        userInput.tooltip({
            trigger: 'hover',
            placement: 'top'
        });
        
        userInput.keyup(function (evt) {
            if (evt.target.value.length === 6) {
                checkinBtn.attr('disabled', false);
                checkinBtn.removeAttr('style');
                $(this).tooltip('hide');
                return;
            }
            checkinBtn.attr('disabled', true);
        });
        
        userInput.keydown(function (evt) {
            // når brukeren har en referanse som er lang nok og man presser enter
            if (evt.target.value.length === 6 && evt.keyCode === 13) {
                checkinGoStepTwo(checkinModalContainer, checkinModal, $(this));
                checkinBtn.attr('disabled', false);
                $(this).tooltip('hide');
                return;
            }
        });
        
        checkinModal.on('click', '.modal-checkin-submit', function () {
            
            checkinGoStepTwo(checkinModalContainer, checkinModal, userInput);
            
        });
    });
});