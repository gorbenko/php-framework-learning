Site.declare('header', function () {
    $('.header-layout').on('click', function () {

        var $body = $(document.body);

        if (!$body.hasClass('layout')) {
            $body.addClass('layout');

            $('.section').addClass('dropzone');

            $('.module')
                .addClass('draggable')
                .attr('draggable', true);
        } else {
            $body.removeClass('layout');

            $('.section').removeClass('dropzone');

            $('.module')
                .removeClass('draggable')
                .attr('draggable', null);
        }

        var dragged;

        $(document)
            .on('dragstart', function (event) {
                dragged = event.target;

                $(event.target).addClass('move');
            })
            .on('dragend', function (event) {
                $(event.target).removeClass('move');
            })
            .on('dragover', function (event) {
                event.preventDefault();
            })
            .on('dragenter', function (event) {
                var $target = $(event.target);

                if ($target.hasClass('dropzone')) {
                    $target.addClass('receiver');
                }
            })
            .on('dragleave', function (event) {
                var $target = $(event.target);

                if ($target.hasClass('dropzone')) {
                    $target.removeClass('receiver');
                }
            })
            .on('drop', function (event) {
                event.preventDefault();

                var $target = $(event.target);

                if ($target.hasClass('dropzone')) {
                    $target.removeClass('receiver');
                    dragged.parentNode.removeChild(dragged);
                    event.target.appendChild(dragged);

                    var layoutConfig = {};
                    // TODO: сделать за 1 цикл
                    $('.section').each(function (index, section) {
                        var sectionName = $(this).data('section');
                        layoutConfig[sectionName] = layoutConfig[sectionName] || [];
                    });

                    $('.section').children('.module').each(function (index, module) {
                        var sectionName = $(this).parent().data('section');
                        layoutConfig[sectionName].push($(module).data('module'));
                    });

                    $.cookie('site.layout', JSON.stringify(layoutConfig));
                }
            })
    });
});
