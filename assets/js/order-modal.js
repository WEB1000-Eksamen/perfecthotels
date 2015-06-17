$(function () {
    
    // Open modal button logic
    var orderBtnParent = $('#the-results'),
        // get main parent for close actions
        orderModalMainParent = $('#order-hotel-modal'),
        modalContainer = orderModalMainParent.find('.modal-content');
    
    orderBtnParent.on('click', '.order-hotel-choice', function () {
        
        var hotelID     = $(this).data('hotelId'),
            roomtypeID  = $(this).data('roomtypeId'),
            fromDate    = $(this).data('fromDate'),
            toDate      = $(this).data('toDate');
        
        getModalInfo(hotelID, roomtypeID, function (data) {
            
            data.FromDate = fromDate;
            data.ToDate = toDate;
            
            var from = moment(data.FromDate),
                to = moment(data.ToDate);
            data.Price = formatMoney(to.diff(from, 'days') * data.Price);
            
            modalContainer.find('.ajax-loader-container').hide();
            
            fillResults(data, modalContainer, '#orderModalTmpl');

            var orderBtn = modalContainer.find('#order-hotel-button'),
                userInput = modalContainer.find('.order-hotel-user-input input'),
                emailRegex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/,
                userInputDiv = modalContainer.find('.order-hotel-user-input'),
                userCloseDiv = modalContainer.find('.order-hotel-user-close');

            orderBtn.attr('disabled', true);

            userInput.keyup(function (evt) {
                if (emailRegex.test( evt.target.value )) {
                    orderBtn.attr('disabled', false);
                    return;
                }
                orderBtn.attr('disabled', true);
            });

            orderBtn.on('click', function () {
                
                var email = userInput.val();
                
                $('#reference-number').find('ajax-loader-gif').show();
                
                modalContainer.addClass('order');
                userInputDiv.removeClass('show');
                userInputDiv.addClass('hidden');
                userCloseDiv.removeClass('hidden');
                userCloseDiv.addClass('show');
                
                orderRoom(hotelID, roomtypeID, email, fromDate, toDate, function (success) {
                    
                    modalContainer.find('#reference-number').text(success.Reference);
                    $('#reference-number').find('ajax-loader-gif').show();
                    
                }, function (error) {
                    console.log('error');
                    var errorText = $('<p></p>');
                    errorText.text(error.error);
                    
                    modalContainer.find('#order-hotel-modal-success').empty();
                    modalContainer.find('#order-hotel-modal-reference').empty().append(errorText);
                    
                });
                
            });
            
        }, function (data) {
            
            fillResults(data, modalContainer, '#orderModalErrorTmpl');
            
        });
        
    });
    
    modalContainer.on('click', '.close', function () {
        modalContainer.children().not('.ajax-loader-container').remove();
        modalContainer.find('.ajax-loader-container').show();
        
        if (modalContainer.hasClass('order')) {
            modalContainer.removeClass('order');
        }
        
        orderModalMainParent.modal('hide');
        return;
    
    });
});