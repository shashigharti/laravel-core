;
(function ($, FRW, window, document, undefined) {
    "use strict";
    FRW.Popup = {
        init: function(elem){

            $('.popup-trigger').on('click',function (e) {
                e.preventDefault();
                $('.popup-content').addClass('hide');
                $(this).siblings('.popup-content').removeClass('hide');
            });

            $('.popup-content i.clickable').on('click',function (e) {
                e.preventDefault();
                $(this).closest('.popup-content').addClass('hide');
            })
        },
    };

    $(function () {
        if($(".popup-trigger").length === 0){
            return;
        }
        FRW.Popup.init($('.popup-trigger'));
    });
}(jQuery, FRW, window, document));
