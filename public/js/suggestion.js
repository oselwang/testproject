var easy_prev_click = 0;
var easy_next_click = 0;
var medium_prev_click = 0;
var medium_next_click = 0;
var hard_prev_click = 0;
var hard_next_click = 0;
var easy_width = $('#easy-wrapper').css('width');
var medium_width = $('#medium-wrapper').css('width');
var hard_width = $('#hard-wrapper').css('width');

$('#easy-scroll').hover(function () {

    var transform = $('#easy-wrapper').css('transform');
    var transform_value = transform.split(',');
    var total_transform = parseInt(easy_width) + parseInt(transform_value[4]);
    if (total_transform < 1000) {
        $('#next-easy').addClass('hidden');
        $('#prev-easy').removeClass('hidden');
    } else if (total_transform > 1000 && total_transform == parseInt(easy_width)) {
        $('#next-easy').removeClass('hidden');
    } else if (total_transform > 1000 && total_transform != parseInt(easy_width)) {
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
    var total_width = parseInt(easy_width) + easy_next_click;
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


/**
 * Medium scroll
 */
$('#medium-scroll').hover(function () {
    var transform = $('#medium-wrapper').css('transform');
    var transform_value = transform.split(',');
    var total_transform = parseInt(medium_width) + parseInt(transform_value[4]);
    if (total_transform < 1000) {
        $('#next-medium').addClass('hidden');
        $('#prev-medium').removeClass('hidden');
    } else if (total_transform > 1000 && total_transform == parseInt(medium_width)) {
        $('#next-medium').removeClass('hidden');
    } else if (total_transform > 1000 && total_transform != parseInt(medium_width)) {
        $('#next-medium').removeClass('hidden');
        $('#prev-medium').removeClass('hidden');
    } else {
        $('#next-medium').removeClass('hidden');
    }
}, function () {
    $('#next-medium').addClass('hidden');
    $('#prev-medium').addClass('hidden');
});

$('#btn-right-medium').on('click', function (e) {
    e.preventDefault();
    medium_next_click -= 900;
    $('#medium-wrapper').css({transform: 'translate3d(' + medium_next_click + 'px,0px,0px'});
    $('#medium-wrapper').css("transition", '0.1s');
    medium_prev_click = medium_next_click;
    var total_width = parseInt(medium_width) + medium_next_click;
    if (medium_next_click != 0) {
        $('#prev-medium').removeClass('hidden');
        $('#prev-medium').fadeIn();
    }
    if (total_width < 1000) {
        $('#next-medium').addClass('hidden');
    }
});
$('#btn-left-medium').on('click', function (e) {
    e.preventDefault();
    medium_prev_click += 900;
    $('#medium-wrapper').css({transform: 'translate3d(' + medium_prev_click + 'px,0px,0px'});
    $('#medium-wrapper').css("transition", '0.1s');
    medium_next_click = medium_prev_click;
    if (medium_next_click == 0) {
        $('#prev-medium').addClass('hidden');
        $('#next-medium').removeClass('hidden');
    } else {
        $('#next-medium').removeClass('hidden');
    }
});


/**
 * Hard scroll
 */
$('#hard-scroll').hover(function () {
    var transform = $('#hard-wrapper').css('transform');
    var transform_value = transform.split(',');
    var total_transform = parseInt(hard_width) + parseInt(transform_value[4]);
    if (total_transform < 1000) {
        $('#next-hard').addClass('hidden');
        $('#prev-hard').removeClass('hidden');
    } else if (total_transform > 1000 && total_transform == parseInt(hard_width)) {
        $('#next-hard').removeClass('hidden');
    } else if (total_transform > 1000 && total_transform != parseInt(hard_width)) {
        $('#next-hard').removeClass('hidden');
        $('#prev-hard').removeClass('hidden');
    } else {
        $('#next-hard').removeClass('hidden');
    }
}, function () {
    $('#next-hard').addClass('hidden');
    $('#prev-hard').addClass('hidden');
});

$('#btn-right-hard').on('click', function (e) {
    e.preventDefault();
    hard_next_click -= 900;
    $('#hard-wrapper').css({transform: 'translate3d(' + hard_next_click + 'px,0px,0px'});
    $('#hard-wrapper').css("transition", '0.1s');
    hard_prev_click = hard_next_click;
    var total_width = parseInt(hard_width) + hard_next_click;
    if (hard_next_click != 0) {
        $('#prev-hard').removeClass('hidden');
        $('#prev-hard').fadeIn();
    }
    if (total_width < 1000) {
        $('#next-hard').addClass('hidden');
    }
});
$('#btn-left-hard').on('click', function (e) {
    e.preventDefault();
    hard_prev_click += 900;
    $('#hard-wrapper').css({transform: 'translate3d(' + hard_prev_click + 'px,0px,0px'});
    $('#hard-wrapper').css("transition", '0.1s');
    hard_next_click = hard_prev_click;
    if (hard_next_click == 0) {
        $('#prev-hard').addClass('hidden');
        $('#next-hard').removeClass('hidden');
    } else {
        $('#next-hard').removeClass('hidden');
    }
});