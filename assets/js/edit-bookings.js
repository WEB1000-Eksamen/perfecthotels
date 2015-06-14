$(function () {
    $('.edit-bookings-btn').on('click', function () {
        // insert orderModalStep1Tmpl in step1
        var editBookingModal = $('#edit-bookings-modal'),
            editBookingsModalContainer = $('.edit-bookings-modal-container'),
            userInput = editBookingsModalContainer.find('.modal-bookings-reference-input'),
            editBtn = editBookingsModalContainer.find('.modal-bookings-submit');
        
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
        
        editBookingModal.on('click', '.modal-bookings-submit', function () {
            
            editBookingsModalContainer.addClass('edit');
            editBookingModal.find('.edit-bookings-modal-go-back').show();
            
            getBookingsFromReference(userInput.val(), function (data) {
                editBookingsModalContainer.find('.step2 .ajax-loader-container').hide();
                fillResults(data, editBookingsModalContainer.find('.step2 .results-table'), '#orderModalStep2Tmpl');
            }, function (error) {
                editBookingsModalContainer.find('.step2 .ajax-loader-container').hide();
                fillResults(error, editBookingsModalContainer.find('.step2'), '#orderModalStep2ErrorTmpl');
            });
            
        });
            // get the reference typed in
            // onclick submit reference
            // do ajax
                // insert orderModalStep1Tmpl in step2
        
        // on close, do cleanup
        editBookingModal.on('click', '.close', function () {
            if (editBookingsModalContainer.hasClass('edit')) {
                editBookingsModalContainer.removeClass('edit');
            }
            
            userInput.val('');
            editBtn.attr('disabled', true);
            
            editBookingsModalContainer.find('.step2 .row').remove();
            editBookingsModalContainer.find('.step2 .ajax-loader-container').show();
            
            editBookingModal.modal('hide');
            return;
        });
        
        editBookingModal.on('click', '.edit-bookings-modal-go-back', function () {
            $(this).hide();
            
            if (editBookingsModalContainer.hasClass('edit')) {
                editBookingsModalContainer.removeClass('edit');
            }
            
            userInput.val('');
            editBtn.attr('disabled', true);
            
            editBookingsModalContainer.find('.step2 .row').remove();
            editBookingsModalContainer.find('.step2 .ajax-loader-container').show();
        });
    });
});