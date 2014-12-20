Site.addFunction(function () {
    $('.gallery-ajax-button').click(function () {
        $(this).remove(); // удаляем кнопку

        $.get('/index2.php?mod=gallery&action=getImageTag', function (data) {
            $('.gallery-image-wrap').html($(data).fadeIn(250));
        });
    });
});
