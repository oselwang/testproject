var page = 2;

function redirect(url) {
    window.location = url;
}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#profile-photo').attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

$("input:checkbox").change(function () {
    var $this = $(this);

    if ($this.is(":checked")) {
        $('#buy-ingredient').removeClass('disabled');
    } else {
        $('#buy-ingredient').addClass('disabled');
    }

});

$('#editheadline').click(function () {
    $(this).addClass('hidden');
    $('#user-headline').addClass('hidden');
    $('#headline').removeClass('hidden');
});

$('#submit-headline').on('submit', function (e) {
    e.preventDefault();
    var url = $(this).attr('action');
    $.ajax({
        type: 'post',
        url: url,
        data: $(this).serializeArray(),
        dataType: 'json',
        success: function (data) {
            location.reload();
        },
        error: function (data) {

        }
    })
});

$(".upload-file-container input:file").change(function () {
    readURL(this);
    var url = $('#change-profile-photo-form').attr('action');
    $.ajax({
        type: 'post',
        url: url,
        data: new FormData($('#change-profile-photo-form')[0]),
        contentType: false,
        processData: false,
        async: true,
        dataType: 'json',
        success: function (data) {
            location.reload();
        },
        error: function (data) {
            console.log(data);
        }
    });
});

$(".upload-file-container-cover-photo input:file").change(function () {
    var url = $('#change-cover-photo-form').attr('action');
    $.ajax({
        type: 'post',
        url: url,
        data: new FormData($('#change-cover-photo-form')[0]),
        contentType: false,
        processData: false,
        async: true,
        dataType: 'json',
        success: function (data) {
            location.reload();
        },
        error: function (data) {
            console.log(data);
        }
    });
});


$('#cover-photo').hover(function () {
    $(this).css('opacity', 1);
});


$('#review-scroll').bind('scroll', function () {
    if ($(this).scrollTop() + $(this).innerHeight() >= $(this).scrollHeight) {
        alert('end reached');
    }
});


$('#positive').click(function (e) {

    e.preventDefault();
    $('#review-spin').removeClass('hidden');
    $('#review-helpful').addClass('hidden');
    $('#helpful').removeClass('review-info-btn-active');
    $('#helpful').attr('disabled',false);
    $(this).addClass('review-info-btn-active');
    $(this).attr('disabled',true);
    $('#review-least-positive').addClass('hidden');
    $('#least-positive').removeClass('review-info-btn-active');
    $('#least-positive').attr('disabled',false);
    $('#review-newest').addClass('hidden');
    $('#newest').removeClass('review-info-btn-active');
    $('#newest').attr('disabled',false);
    $('#review-positive').removeClass('hidden');
    $('#show-more-least-positive').addClass('hidden');
    $('#show-more-newest').addClass('hidden');
    $('#show-more-helpful').addClass('hidden');
    var recipeid = $('#recipe-id').val();
    var url = '../review/positive/' + recipeid;
    $.ajax({
        type: 'get',
        url: url,
        dataType: 'json',
        success: function (data) {
            page = 2;
            $('#review-spin').addClass('hidden');
            $('#review-positive').text('');
            $.each(data, function (index, value) {
                var firstname = value.firstname;
                var lastname = value.lastname;
                var photo = value.photo_name;
                var review = value.review;
                var rating = value.rating;
                var time = value.diffForHumans;
                var divrating = '';


                if (rating == 1) {
                    divrating = '<div class="reviewer-rating"><span class="fa fa-star"></span><span class="fa fa-star-o"></span><span class="fa fa-star-o"></span><span class="fa fa-star-o"></span> <span class="fa fa-star-o"></span></div>';
                } else if (rating == 2) {
                    divrating = '<div class="reviewer-rating"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star-o"></span><span class="fa fa-star-o"></span> <span class="fa fa-star-o"></span></div>';
                } else if (rating == 3) {
                    divrating = '<div class="reviewer-rating"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star-o"></span> <span class="fa fa-star-o"></span></div>';
                } else if (rating == 4) {
                    divrating = '<div class="reviewer-rating"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star-o"></span></div>';
                } else {
                    divrating = '<div class="reviewer-rating"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span></div>';
                }

                $('#review-positive').append("<div class='row'><div class='col-md-1'><div class='reviewer-user-photo'><img src='" + (photo != null ? '../' + photo : '../images/blank-person.png') + "' class='user-pic' id='profile-photo'> </div> </div> <div class='col-md-11' style='padding-left: 0 !important;'> <div class='reviewer-info'> <div class='reviewer-name'> <b>" + firstname + ' ' + lastname + "</b> - <o style='font-size: 12px;'>" + time + "</o>&nbsp;" + divrating + "<div class='reviewer-review'>" + review + "</div> </div> </div> </div> </div>");
                if(data.length > 2){
                    $('#show-more-positive').removeClass('hidden');
                }
            });
        },
        error: function (data) {

        }
    });
});

$('#show-more-positive').on('click', function () {

    $('#review-spin').removeClass('hidden');
    var recipeid = $('#recipe-id').val();
    var url = '../review/positive/' + recipeid + '?page=' + page;
    $.ajax({
        type: 'get',
        url: url,
        dataType: 'json',
        success: function (data) {
            if (data.length == 0) {
                $('#show-more-positive').addClass('hidden');
            }
            page += 1;
            $('#review-spin').addClass('hidden');
            $.each(data, function (index, value) {
                var firstname = value.firstname;
                var lastname = value.lastname;
                var photo = value.photo_name;
                var review = value.review;
                var rating = value.rating;
                var time = value.diffForHumans;
                var divrating = '';


                if (rating == 1) {
                    divrating = '<div class="reviewer-rating"><span class="fa fa-star"></span><span class="fa fa-star-o"></span><span class="fa fa-star-o"></span><span class="fa fa-star-o"></span> <span class="fa fa-star-o"></span></div>';
                } else if (rating == 2) {
                    divrating = '<div class="reviewer-rating"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star-o"></span><span class="fa fa-star-o"></span> <span class="fa fa-star-o"></span></div>';
                } else if (rating == 3) {
                    divrating = '<div class="reviewer-rating"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star-o"></span> <span class="fa fa-star-o"></span></div>';
                } else if (rating == 4) {
                    divrating = '<div class="reviewer-rating"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star-o"></span></div>';
                } else {
                    divrating = '<div class="reviewer-rating"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span></div>';
                }

                $('#review-positive').append("<div class='row'><div class='col-md-1'><div class='reviewer-user-photo'><img src='" + (photo != null ? '../' + photo : '../images/blank-person.png') + "' class='user-pic' id='profile-photo'> </div> </div> <div class='col-md-11' style='padding-left: 0 !important;'> <div class='reviewer-info'> <div class='reviewer-name'> <b>" + firstname + ' ' + lastname + "</b> - <o style='font-size: 12px;'>" + time + "</o>&nbsp;" + divrating + "<div class='reviewer-review'>" + review + "</div> </div> </div> </div> </div>");

            });
        }
    });
});

$('#helpful').click(function (e) {

    e.preventDefault();
    $('#review-spin').removeClass('hidden');
    $('#review-helpful').removeClass('hidden');
    $(this).addClass('review-info-btn-active');
    $(this).attr('disabled',true);
    $('#positive').removeClass('review-info-btn-active');
    $('#positive').attr('disabled',false);
    $('#review-least-positive').addClass('hidden');
    $('#least-positive').removeClass('review-info-btn-active');
    $('#least-positive').attr('disabled',false);
    $('#review-newest').addClass('hidden');
    $('#newest').removeClass('review-info-btn-active');
    $('#newest').attr('disabled',false);
    $('#review-positive').addClass('hidden');
    var recipeid = $('#recipe-id').val();
    var url = '../review/helpful/' + recipeid;
    $.ajax({
        type: 'get',
        url: url,
        dataType: 'json',
        success: function (data) {
            $('#review-spin').addClass('hidden');
            $('#review-helpful').text('');
            $.each(data, function (index, value) {
                var firstname = value.firstname;
                var lastname = value.lastname;
                var photo = value.photo_name;
                var review = value.review;
                var rating = value.rating;
                var time = value.diffForHumans;
                var divrating = '';
                if (rating == 1) {
                    divrating = '<div class="reviewer-rating"><span class="fa fa-star"></span><span class="fa fa-star-o"></span><span class="fa fa-star-o"></span><span class="fa fa-star-o"></span> <span class="fa fa-star-o"></span></div>';
                } else if (rating == 2) {
                    divrating = '<div class="reviewer-rating"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star-o"></span><span class="fa fa-star-o"></span> <span class="fa fa-star-o"></span></div>';
                } else if (rating == 3) {
                    divrating = '<div class="reviewer-rating"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star-o"></span> <span class="fa fa-star-o"></span></div>';
                } else if (rating == 4) {
                    divrating = '<div class="reviewer-rating"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star-o"></span></div>';
                } else {
                    divrating = '<div class="reviewer-rating"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span></div>';
                }
                $('#review-helpful').append("<div class='row'><div class='col-md-1'><div class='reviewer-user-photo'><img src='" + (photo != null ? '../' + photo : '../images/blank-person.png') + "' class='user-pic' id='profile-photo'> </div> </div> <div class='col-md-11' style='padding-left: 0 !important;'> <div class='reviewer-info'> <div class='reviewer-name'> <b>" + firstname + ' ' + lastname + "</b> - <o style='font-size: 12px;'>" + time + "</o>&nbsp;" + divrating + "<div class='reviewer-review'>" + review + "</div> </div> </div> </div> </div>");

            });

        },
        error: function (data) {

        }
    });
});

$('#least-positive').click(function (e) {

    e.preventDefault();
    $('#review-spin').removeClass('hidden');
    $('#review-helpful').addClass('hidden');
    $('#helpful').removeClass('review-info-btn-active');
    $('#helpful').attr('disabled',false);
    $('#positive').removeClass('review-info-btn-active');
    $('#positive').attr('disabled',false);
    $('#review-least-positive').removeClass('hidden');
    $(this).addClass('review-info-btn-active');
    $(this).attr('disabled',true);
    $('#review-newest').addClass('hidden');
    $('#newest').removeClass('review-info-btn-active');
    $('#newest').attr('disabled',false);
    $('#review-positive').addClass('hidden');
    $('#show-more-positive').addClass('hidden');
    $('#show-more-newest').addClass('hidden');
    $('#show-more-helpful').addClass('hidden');
    var recipeid = $('#recipe-id').val();
    var url = '../review/least-positive/' + recipeid;
    $.ajax({
        type: 'get',
        url: url,
        dataType: 'json',
        success: function (data) {
            page = 2;
            $('#review-spin').addClass('hidden');
            $('#review-least-positive').text('');
            $.each(data, function (index, value) {
                var firstname = value.firstname;
                var lastname = value.lastname;
                var photo = value.photo_name;
                var review = value.review;
                var rating = value.rating;
                var time = value.diffForHumans;
                var divrating = '';
                if (rating == 1) {
                    divrating = '<div class="reviewer-rating"><span class="fa fa-star"></span><span class="fa fa-star-o"></span><span class="fa fa-star-o"></span><span class="fa fa-star-o"></span> <span class="fa fa-star-o"></span></div>';
                } else if (rating == 2) {
                    divrating = '<div class="reviewer-rating"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star-o"></span><span class="fa fa-star-o"></span> <span class="fa fa-star-o"></span></div>';
                } else if (rating == 3) {
                    divrating = '<div class="reviewer-rating"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star-o"></span> <span class="fa fa-star-o"></span></div>';
                } else if (rating == 4) {
                    divrating = '<div class="reviewer-rating"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star-o"></span></div>';
                } else {
                    divrating = '<div class="reviewer-rating"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span></div>';
                }
                $('#review-least-positive').append("<div class='row'><div class='col-md-1'><div class='reviewer-user-photo'><img src='" + (photo != null ? '../' + photo : '../images/blank-person.png') + "' class='user-pic' id='profile-photo'> </div> </div> <div class='col-md-11' style='padding-left: 0 !important;'> <div class='reviewer-info'> <div class='reviewer-name'> <b>" + firstname + ' ' + lastname + "</b> - <o style='font-size: 12px;'>" + time + "</o>&nbsp;" + divrating + "<div class='reviewer-review'>" + review + "</div> </div> </div> </div> </div>");

                if(data.length > 2) {
                    $('#show-more-least-positive').removeClass('hidden');
                }
            });

        },
        error: function (data) {

        }
    });
});

$('#show-more-least-positive').on('click', function () {

    $('#review-spin').removeClass('hidden');
    var recipeid = $('#recipe-id').val();
    var url = '../review/least-positive/' + recipeid + '?page=' + page;
    $.ajax({
        type: 'get',
        url: url,
        dataType: 'json',
        success: function (data) {
            if (data.length == 0) {
                $('#show-more-least-positive').addClass('hidden');
            }
            page += 1;
            $('#review-spin').addClass('hidden');
            $.each(data, function (index, value) {
                var firstname = value.firstname;
                var lastname = value.lastname;
                var photo = value.photo_name;
                var review = value.review;
                var rating = value.rating;
                var time = value.diffForHumans;
                var divrating = '';


                if (rating == 1) {
                    divrating = '<div class="reviewer-rating"><span class="fa fa-star"></span><span class="fa fa-star-o"></span><span class="fa fa-star-o"></span><span class="fa fa-star-o"></span> <span class="fa fa-star-o"></span></div>';
                } else if (rating == 2) {
                    divrating = '<div class="reviewer-rating"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star-o"></span><span class="fa fa-star-o"></span> <span class="fa fa-star-o"></span></div>';
                } else if (rating == 3) {
                    divrating = '<div class="reviewer-rating"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star-o"></span> <span class="fa fa-star-o"></span></div>';
                } else if (rating == 4) {
                    divrating = '<div class="reviewer-rating"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star-o"></span></div>';
                } else {
                    divrating = '<div class="reviewer-rating"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span></div>';
                }

                $('#review-least-positive').append("<div class='row'><div class='col-md-1'><div class='reviewer-user-photo'><img src='" + (photo != null ? '../' + photo : '../images/blank-person.png') + "' class='user-pic' id='profile-photo'> </div> </div> <div class='col-md-11' style='padding-left: 0 !important;'> <div class='reviewer-info'> <div class='reviewer-name'> <b>" + firstname + ' ' + lastname + "</b> - <o style='font-size: 12px;'>" + time + "</o>&nbsp;" + divrating + "<div class='reviewer-review'>" + review + "</div> </div> </div> </div> </div>");

            });
        }
    });
});

$('#newest').click(function (e) {
    e.preventDefault();
    $('#review-spin').removeClass('hidden');
    $('#review-helpful').addClass('hidden');
    $('#helpful').removeClass('review-info-btn-active');
    $('#helpful').attr('disabled',false);
    $('#positive').removeClass('review-info-btn-active');
    $('#positive').attr('disabled',false);
    $('#review-least-positive').addClass('hidden');
    $('#least-positive').removeClass('review-info-btn-active');
    $('#least-positive').attr('disabled',false);
    $('#review-newest').removeClass('hidden');
    $(this).addClass('review-info-btn-active');
    $(this).attr('disabled',true);

    $('#review-positive').addClass('hidden');
    $('#show-more-positive').addClass('hidden');
    $('#show-more-least-positive').addClass('hidden');
    $('#show-more-helpful').addClass('hidden');
    var recipeid = $('#recipe-id').val();
    var url = '../review/newest/' + recipeid;
    $.ajax({
        type: 'get',
        url: url,
        dataType: 'json',
        success: function (data) {
            $('#review-spin').addClass('hidden');
            $('#review-newest').text('');
            $.each(data, function (index, value) {
                var firstname = value.firstname;
                var lastname = value.lastname;
                var photo = value.photo_name;
                var review = value.review;
                var rating = value.rating;
                var time = value.diffForHumans;
                var divrating = '';
                if (rating == 1) {
                    divrating = '<div class="reviewer-rating"><span class="fa fa-star"></span><span class="fa fa-star-o"></span><span class="fa fa-star-o"></span><span class="fa fa-star-o"></span> <span class="fa fa-star-o"></span></div>';
                } else if (rating == 2) {
                    divrating = '<div class="reviewer-rating"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star-o"></span><span class="fa fa-star-o"></span> <span class="fa fa-star-o"></span></div>';
                } else if (rating == 3) {
                    divrating = '<div class="reviewer-rating"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star-o"></span> <span class="fa fa-star-o"></span></div>';
                } else if (rating == 4) {
                    divrating = '<div class="reviewer-rating"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star-o"></span></div>';
                } else {
                    divrating = '<div class="reviewer-rating"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span></div>';
                }
                $('#review-newest').append("<div class='row'><div class='col-md-1'><div class='reviewer-user-photo'><img src='" + (photo != null ? '../' + photo : '../images/blank-person.png') + "' class='user-pic' id='profile-photo'> </div> </div> <div class='col-md-11' style='padding-left: 0 !important;'> <div class='reviewer-info'> <div class='reviewer-name'> <b>" + firstname + ' ' + lastname + "</b> - <o style='font-size: 12px;'>" + time + "</o>&nbsp;" + divrating + "<div class='reviewer-review'>" + review + "</div> </div> </div> </div> </div>");
            });
            if(data.length > 2) {
                $('#show-more-newest').removeClass('hidden');
            }

        },
        error: function (data) {

        }
    });
});

$('#show-more-newest').on('click', function () {

    $('#review-spin').removeClass('hidden');
    var recipeid = $('#recipe-id').val();
    var url = '../review/newest/' + recipeid + '?page=' + page;
    $.ajax({
        type: 'get',
        url: url,
        dataType: 'json',
        success: function (data) {
            if (data.length == 0) {
                $('#show-more-newest').addClass('hidden');
            }
            page += 1;
            $('#review-spin').addClass('hidden');
            $.each(data, function (index, value) {
                var firstname = value.firstname;
                var lastname = value.lastname;
                var photo = value.photo_name;
                var review = value.review;
                var rating = value.rating;
                var time = value.diffForHumans;
                var divrating = '';


                if (rating == 1) {
                    divrating = '<div class="reviewer-rating"><span class="fa fa-star"></span><span class="fa fa-star-o"></span><span class="fa fa-star-o"></span><span class="fa fa-star-o"></span> <span class="fa fa-star-o"></span></div>';
                } else if (rating == 2) {
                    divrating = '<div class="reviewer-rating"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star-o"></span><span class="fa fa-star-o"></span> <span class="fa fa-star-o"></span></div>';
                } else if (rating == 3) {
                    divrating = '<div class="reviewer-rating"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star-o"></span> <span class="fa fa-star-o"></span></div>';
                } else if (rating == 4) {
                    divrating = '<div class="reviewer-rating"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star-o"></span></div>';
                } else {
                    divrating = '<div class="reviewer-rating"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span></div>';
                }

                $('#review-newest').append("<div class='row'><div class='col-md-1'><div class='reviewer-user-photo'><img src='" + (photo != null ? '../' + photo : '../images/blank-person.png') + "' class='user-pic' id='profile-photo'> </div> </div> <div class='col-md-11' style='padding-left: 0 !important;'> <div class='reviewer-info'> <div class='reviewer-name'> <b>" + firstname + ' ' + lastname + "</b> - <o style='font-size: 12px;'>" + time + "</o>&nbsp;" + divrating + "<div class='reviewer-review'>" + review + "</div> </div> </div> </div> </div>");
                $('#show-more-positive').addClass('hidden');
                $('#show-more-least-positive').addClass('hidden');
                $('#show-more-newest').removeClass('hidden');
                $('#show-more-helpful').addClass('hidden');
            });
        }
    });
});