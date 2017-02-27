Site.declare('gallery', function () {
    $('.gallery-ajax-button').click(function () {
        $(this).remove(); // удаляем кнопку

        Site.ajax({
            url: '/index2.php?mod=gallery&action=getImageTag',
            success: function (data) {
                $('.gallery-image-wrap').html($(data).fadeIn(250));
            }
        });
    });
});
