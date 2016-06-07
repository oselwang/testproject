var easy_prev_click = 0;
var easy_next_click = 0;
var width = $('#easy-wrapper').css('width');

$('#easy-scroll').hover(function () {
    var transform = $('#easy-wrapper').css('transform');
    var transform_value = transform.split(',');
    var total_transform = parseInt(width) + parseInt(transform_value[4]);
    if (total_transform < 1000) {
        $('#next-easy').addClass('hidden');
        $('#prev-easy').removeClass('hidden');
    } else if (total_transform > 1000 && total_transform == parseInt(width)) {
        $('#next-easy').removeClass('hidden');
    } else if (total_transform > 1000 && total_transform != parseInt(width)) {
        $('#next-easy').removeClass('hidden');
        $('#prev-easy').removeClass('hidden');
    } else {
        $('#next-easy').removeClass('hidden');
    }
}, function () {
    $('#next-easy').addClass('hidden');
    $('#prev-easy').addClass('hidden');
});

$('#btn-right-easy').on('click', function (e) {
    e.preventDefault();
    easy_next_click -= 900;
    $('#easy-wrapper').css({transform: 'translate3d(' + easy_next_click + 'px,0px,0px'});
    $('#easy-wrapper').css("transition", '0.1s');
    easy_prev_click = easy_next_click;
    var total_width = parseInt(width) + easy_next_click;
    if (easy_next_click != 0) {
        $('#prev-easy').removeClass('hidden');
        $('#prev-easy').fadeIn();
    }
    if (total_width < 1000) {
        $('#next-easy').addClass('hidden');
    }
});
$('#btn-left-easy').on('click', function (e) {
    e.preventDefault();
    easy_prev_click += 900;
    $('#easy-wrapper').css({transform: 'translate3d(' + easy_prev_click + 'px,0px,0px'});
    $('#easy-wrapper').css("transition", '0.1s');
    easy_next_click = easy_prev_click;
    if (easy_next_click == 0) {
        $('#prev-easy').addClass('hidden');
        $('#next-easy').removeClass('hidden');
    } else {
        $('#next-easy').removeClass('hidden');
    }
});

