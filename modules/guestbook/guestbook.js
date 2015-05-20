Site.addFunction(function () {
    document.querySelector('.guestbook-button-ajax').addEventListener('click', function () {
        var name    = document.querySelector('.guestbook-form-first-name').value,
            message = document.querySelector('.guestbook-form-message').innerHTML;

        var xmlhttp = new XMLHttpRequest();
        var params = 'first-name=' + encodeURIComponent(name) + '&message=' + encodeURIComponent(message);
        xmlhttp.open("POST", 'http://localhost/index2.php?mod=guestbook&action=add', true);
        xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4) {
                if (xmlhttp.status == 200) {
                    alert(name + ', сказал(а):\n' + message);
                } else {
                    alert('Ошибка при отправке запроса')
                }
            }
        }

        xmlhttp.send(params);
    })
});
