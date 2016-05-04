$(document).ready(function () {
    $(window).scroll(function () {
        if ($(this).scrollTop() > 50) {
            $('#flash-pop-up').fadeOut();
            $('#back-to-top').fadeIn();
        } else {
            $('#back-to-top').fadeOut();
        }
    });

    $(function () {
        $("#flash-pop-up").fadeIn(function () {
            setTimeout(function () {
                    $('#flash-pop-up').fadeOut();
                }, 3000
            );
        });
    });

    $('#back-to-top').click(function () {
        $('#back-to-top').tooltip('hide');
        $('body,html').animate({
            scrollTop: 0
        }, 800);
        return false;
    });

    $('#back-to-top').tooltip('show');

});

