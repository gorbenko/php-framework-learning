/**
 * Глобальный объект проекта
 */

// TODO: использовать AMD

var Site = function() {

    // функции запускаемые по DOM ready
    var funcs = [];

    return {

        addFunction : function (f) {
            funcs.push(f);
            return this;
        },

        init : function () {
            for (i in funcs) {
                try {
                    funcs[i]();
                } catch(e) {
                    if (window.console) {
                        console.log(e);
                    }
                }
            }
        }
    }
}();

$(function() {
    Site.init();
});
