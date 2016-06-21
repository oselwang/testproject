
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