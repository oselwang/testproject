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