$(function () {

    var orderBtn = $('#order-hotel-button'),
        containerToUpdate = $('.modal-content'),
        userInput = $('.order-hotel-user-input input'),
        emailRegex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/,
        userInputDiv = $('.order-hotel-user-input'),
        userCloseDiv = $('.order-hotel-user-close');
    
    
    orderBtn.attr('disabled', true);
    
    userInput.keyup(function (evt) {
        if (emailRegex.test( evt.target.value )) {
            orderBtn.attr('disabled', false);
            return;
        }
        orderBtn.attr('disabled', true);
    });
    
    orderBtn.on('click', function () {
        containerToUpdate.addClass('order');
        userInputDiv.removeClass('show');
        userInputDiv.addClass('hidden');
        userCloseDiv.removeClass('hidden');
        userCloseDiv.addClass('show');
    });

});