Site.addFunction(function () {
    // TODO: быдло-код!
    $('.header-layout').click(function () {
        $(this).remove();

        $('.module, .section').addClass('draggable');

        var down = false,
            offsetY = 0,
            offsetX = 0;

        $('.module.draggable').on('mousedown', function (e) {
            var $this = $(this),
                width = $this.width(),
                height = $this.height();

            $(document.body).addClass('layout');
            $this.toggleClass('mousedown');

            down = true;
            offsetY = e.offsetY;
            offsetX = e.offsetX;

            $this.css({
                top: 'auto',
                left: 'auto',
                width: width,
                height: height
            });
        });

        $(document).on('mousemove', function (e) {
            if (down) {
                $('.module.draggable').css({
                    top: e.pageY - offsetY,
                    left: e.pageX - offsetX
                });
            }
        });

        $(document).on('mouseup', function (e) {
            var $this = $(e.target).closest('.module');

            $(document.body).removeClass('layout');
            $('.module.draggable').removeClass('mousedown');

            $this.css({
                width: 'auto',
                height: 'auto'
            });

            down = false;
        });
    });
});
