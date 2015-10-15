Site.addFunction(function () {
    document.querySelector('.guestbook-button-ajax').addEventListener('click', function () {
        var name    = document.querySelector('.guestbook-form-first-name').value;
        var message = document.querySelector('.guestbook-form-message').value;

        Site.ajax({
            url: 'http://localhost/index2.php?mod=guestbook&action=add',
            method: 'POST',
            params: {
                'first-name': name,
                'message': message
            },
            success: function () {
                location.reload();
            }
        })
    })
});
