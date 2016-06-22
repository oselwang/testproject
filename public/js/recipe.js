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

$('#positive').click(function (e) {
    
    e.preventDefault();
    $('#review-spin').removeClass('hidden');
    $('#review-helpful').addClass('hidden');
    $('#helpful').removeClass('review-info-btn-active');
    $(this).addClass('review-info-btn-active');
    $('#review-least-positive').addClass('hidden');
    $('#least-positive').removeClass('review-info-btn-active');
    $('#review-newest').addClass('hidden');
    $('#newest').removeClass('review-info-btn-active');
    $('#review-positive').removeClass('hidden');
    var recipeid = $('#recipe-id').val();
    var url = '../review/positive/' + recipeid;
    $.ajax({
        type: 'get',
        url: url,
        dataType: 'json',
        success: function (data) {
            $('#review-spin').addClass('hidden');
            $('#review-positive').text('');
            $.each(data,function(index,value){
                var firstname = value.firstname;
                var lastname = value.lastname;
                var photo = value.photo_name;
                var review = value.review;
                var rating = value.rating;
                var time = value.diffForHumans;
                var divrating = '';
                if(rating == 1){
                    divrating = '<div class="reviewer-rating"><span class="fa fa-star"></span><span class="fa fa-star-o"></span><span class="fa fa-star-o"></span><span class="fa fa-star-o"></span> <span class="fa fa-star-o"></span></div>';
                }else if(rating == 2){
                    divrating = '<div class="reviewer-rating"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star-o"></span><span class="fa fa-star-o"></span> <span class="fa fa-star-o"></span></div>';
                }else if(rating == 3){
                    divrating = '<div class="reviewer-rating"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star-o"></span> <span class="fa fa-star-o"></span></div>';
                }else if(rating == 4){
                    divrating = '<div class="reviewer-rating"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star-o"></span></div>';
                }else{
                    divrating = '<div class="reviewer-rating"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span></div>';
                }
                $('#review-positive').append("<div class='row'><div class='col-md-1'><div class='reviewer-user-photo'><img src='"+(photo != null ? '../'+photo : '../images/blank-person.png')+"' class='user-pic' id='profile-photo'> </div> </div> <div class='col-md-11' style='padding-left: 0 !important;'> <div class='reviewer-info'> <div class='reviewer-name'> <b>"+firstname + ' ' + lastname +"</b> - <o style='font-size: 12px;'>"+time+"</o>&nbsp;"+divrating+"<div class='reviewer-review'>"+review+"</div> </div> </div> </div> </div>");

            });

        },
        error: function (data) {

        }
    });
});

$('#helpful').click(function (e) {

    e.preventDefault();
    $('#review-spin').removeClass('hidden');
    $('#review-helpful').removeClass('hidden');
    $('#helpful').addClass('review-info-btn-active');
    $('#positive').removeClass('review-info-btn-active');
    $('#review-least-positive').addClass('hidden');
    $('#least-positive').removeClass('review-info-btn-active');
    $('#review-newest').addClass('hidden');
    $('#newest').removeClass('review-info-btn-active');
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
            $.each(data,function(index,value){
                var firstname = value.firstname;
                var lastname = value.lastname;
                var photo = value.photo_name;
                var review = value.review;
                var rating = value.rating;
                var time = value.diffForHumans;
                var divrating = '';
                if(rating == 1){
                    divrating = '<div class="reviewer-rating"><span class="fa fa-star"></span><span class="fa fa-star-o"></span><span class="fa fa-star-o"></span><span class="fa fa-star-o"></span> <span class="fa fa-star-o"></span></div>';
                }else if(rating == 2){
                    divrating = '<div class="reviewer-rating"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star-o"></span><span class="fa fa-star-o"></span> <span class="fa fa-star-o"></span></div>';
                }else if(rating == 3){
                    divrating = '<div class="reviewer-rating"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star-o"></span> <span class="fa fa-star-o"></span></div>';
                }else if(rating == 4){
                    divrating = '<div class="reviewer-rating"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star-o"></span></div>';
                }else{
                    divrating = '<div class="reviewer-rating"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span></div>';
                }
                $('#review-helpful').append("<div class='row'><div class='col-md-1'><div class='reviewer-user-photo'><img src='"+(photo != null ? '../'+photo : '../images/blank-person.png')+"' class='user-pic' id='profile-photo'> </div> </div> <div class='col-md-11' style='padding-left: 0 !important;'> <div class='reviewer-info'> <div class='reviewer-name'> <b>"+firstname + ' ' + lastname +"</b> - <o style='font-size: 12px;'>"+time+"</o>&nbsp;"+divrating+"<div class='reviewer-review'>"+review+"</div> </div> </div> </div> </div>");

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
    $('#positive').removeClass('review-info-btn-active');
    $('#review-least-positive').removeClass('hidden');
    $('#least-positive').addClass('review-info-btn-active');
    $('#review-newest').addClass('hidden');
    $('#newest').removeClass('review-info-btn-active');
    $('#review-positive').addClass('hidden');
    var recipeid = $('#recipe-id').val();
    var url = '../review/least-positive/' + recipeid;
    $.ajax({
        type: 'get',
        url: url,
        dataType: 'json',
        success: function (data) {
            $('#review-spin').addClass('hidden');
            $('#review-least-positive').text('');
            $.each(data,function(index,value){
                var firstname = value.firstname;
                var lastname = value.lastname;
                var photo = value.photo_name;
                var review = value.review;
                var rating = value.rating;
                var time = value.diffForHumans;
                var divrating = '';
                if(rating == 1){
                    divrating = '<div class="reviewer-rating"><span class="fa fa-star"></span><span class="fa fa-star-o"></span><span class="fa fa-star-o"></span><span class="fa fa-star-o"></span> <span class="fa fa-star-o"></span></div>';
                }else if(rating == 2){
                    divrating = '<div class="reviewer-rating"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star-o"></span><span class="fa fa-star-o"></span> <span class="fa fa-star-o"></span></div>';
                }else if(rating == 3){
                    divrating = '<div class="reviewer-rating"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star-o"></span> <span class="fa fa-star-o"></span></div>';
                }else if(rating == 4){
                    divrating = '<div class="reviewer-rating"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star-o"></span></div>';
                }else{
                    divrating = '<div class="reviewer-rating"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span></div>';
                }
                $('#review-helpful').append("<div class='row'><div class='col-md-1'><div class='reviewer-user-photo'><img src='"+(photo != null ? '../'+photo : '../images/blank-person.png')+"' class='user-pic' id='profile-photo'> </div> </div> <div class='col-md-11' style='padding-left: 0 !important;'> <div class='reviewer-info'> <div class='reviewer-name'> <b>"+firstname + ' ' + lastname +"</b> - <o style='font-size: 12px;'>"+time+"</o>&nbsp;"+divrating+"<div class='reviewer-review'>"+review+"</div> </div> </div> </div> </div>");

            });

        },
        error: function (data) {

        }
    });
});

$('#newest').click(function (e) {

    e.preventDefault();
    $('#review-spin').removeClass('hidden');
    $('#review-helpful').addClass('hidden');
    $('#helpful').removeClass('review-info-btn-active');
    $('#positive').removeClass('review-info-btn-active');
    $('#review-least-positive').addClass('hidden');
    $('#least-positive').removeClass('review-info-btn-active');
    $('#review-newest').removeClass('hidden');
    $('#newest').addClass('review-info-btn-active');
    $('#review-positive').addClass('hidden');
    var recipeid = $('#recipe-id').val();
    var url = '../review/newest/' + recipeid;
    $.ajax({
        type: 'get',
        url: url,
        dataType: 'json',
        success: function (data) {
            $('#review-spin').addClass('hidden');
            $('#review-newest').text('');
            $.each(data,function(index,value){
                var firstname = value.firstname;
                var lastname = value.lastname;
                var photo = value.photo_name;
                var review = value.review;
                var rating = value.rating;
                var time = value.diffForHumans;
                var divrating = '';
                if(rating == 1){
                    divrating = '<div class="reviewer-rating"><span class="fa fa-star"></span><span class="fa fa-star-o"></span><span class="fa fa-star-o"></span><span class="fa fa-star-o"></span> <span class="fa fa-star-o"></span></div>';
                }else if(rating == 2){
                    divrating = '<div class="reviewer-rating"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star-o"></span><span class="fa fa-star-o"></span> <span class="fa fa-star-o"></span></div>';
                }else if(rating == 3){
                    divrating = '<div class="reviewer-rating"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star-o"></span> <span class="fa fa-star-o"></span></div>';
                }else if(rating == 4){
                    divrating = '<div class="reviewer-rating"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star-o"></span></div>';
                }else{
                    divrating = '<div class="reviewer-rating"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span></div>';
                }
                $('#review-helpful').append("<div class='row'><div class='col-md-1'><div class='reviewer-user-photo'><img src='"+(photo != null ? '../'+photo : '../images/blank-person.png')+"' class='user-pic' id='profile-photo'> </div> </div> <div class='col-md-11' style='padding-left: 0 !important;'> <div class='reviewer-info'> <div class='reviewer-name'> <b>"+firstname + ' ' + lastname +"</b> - <o style='font-size: 12px;'>"+time+"</o>&nbsp;"+divrating+"<div class='reviewer-review'>"+review+"</div> </div> </div> </div> </div>");

            });

        },
        error: function (data) {

        }
    });
});