
$(':radio').change(function () {
        $('.choice').text(this.value + ' stars');
    }
);

$('#submit-review').on('click',function (e) {
    e.preventDefault();
    $('#error-review').text('');
    var url = $('#review-form').attr('action');
    var data = $('#review-form').serializeArray();
    $.ajax({
        type: 'post',
        url: url,
        data: data,
        dataType: 'json',
        success: function (data) {
            redirect(window.location.href);
        },
        error: function (data) {
            errors = $.parseJSON(data.responseText);
            $('#flash-error-review').removeClass('hidden');
            $.each(errors, function (index, value) {
                $('#error-review').append("<li>" + value + "</li>")
            })
        }
    });
    
});

$('#edit-review-form').submit(function (e) {
    e.preventDefault();
    $('#error-review').text('');
    var url = $(this).attr('action');
    var data = $(this).serializeArray();
    $.ajax({
        type: 'post',
        url: url,
        data: data,
        dataType: 'json',
        success: function (data) {
            redirect(window.location.href);
        },
        error: function (data) {
            errors = $.parseJSON(data.responseText);
            $('#flash-error-edit-review').removeClass('hidden');
            $.each(errors, function (index, value) {
                $('#error-edit-review').append("<li>" + value + "</li>")
            })
        }
    });
});

$('#close-edit-review-modal').on('click',function (e) {
    e.preventDefault();
    $('#edit-review-modal').modal('hide');
});

$('#close-review-modal').on('click',function (e) {
    e.preventDefault();
    $('#review-modal').modal('hide');
});