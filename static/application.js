/**
 * Глобальный объект проекта
 */

// TODO: использовать AMD

var Site = function() {

    // функции запускаемые по DOM ready
    var funcs = [];

    return {

        addFunction: function (f) {
            funcs.push(f);
            return this;
        },

        init: function () {
            for (i in funcs) {
                try {
                    funcs[i]();
                } catch (e) {
                    if (window.console) {
                        console.log(e);
                    }
                }
            }
        },

        ajax: function (options) {
            options = options || {};

            var method = options.method || 'GET';
            var url    = options.url;
            var async  = options.async || true;
            var params = options.params;

            var xhr = new XMLHttpRequest();
            xhr.open(method, url, async);

            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4) {
                    if (xhr.status == 200) {
                        options.success(xhr.response, xhr);
                    } else {
                        options.error(xhr.response, xhr);
                    }

                }
            };

            switch (method) {
                case 'POST':
                    var queryString = Object.keys(params).reduce(function (prev, next) {
                        return prev + '=' + encodeURIComponent(params[prev]) + '&' + next + '=' + encodeURIComponent(params[next]);
                    });
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhr.send(queryString);
                    break;
                case 'GET':
                    xhr.send(null);
                    break;
            }
        }
    }
}();

$(function() {
    Site.init();
});
