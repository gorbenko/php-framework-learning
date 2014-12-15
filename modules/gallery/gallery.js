Site.addFunction(function () {
    $('.gallery-ajax-button').click(function () {
        $(this).remove(); // удаляем кнопку

        $.get('/index2.php?mod=gallery&action=getImage', function (data) {
            $('.gallery').append($(data).fadeIn(250));
        });
    });
});
