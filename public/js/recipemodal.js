$(document).on('click', '#close-preview', function () {
    $('.image-preview').popover('hide');
    // Hover befor close the preview
    $('.image-preview').hover(
        function () {
            $('.image-preview').popover('show');
        },
        function () {
            $('.image-preview').popover('hide');
        }
    );
});

$(function () {
    // Create the close button
    var closebtn = $('<button/>', {
        type: "button",
        text: 'x',
        id: 'close-preview',
        style: 'font-size: initial;'
    });
    closebtn.attr("class", "close pull-right");
    // Set the popover default content
    $('.image-preview').popover({
        trigger: 'manual',
        html: true,
        title: "<strong>Preview</strong>" + $(closebtn)[0].outerHTML,
        content: "There's no image",
        placement: 'bottom'
    });
    // Clear event
    $('.image-preview-clear').click(function () {
        $('.image-preview').attr("data-content", "").popover('hide');
        $('.image-preview-filename').val("");
        $('.image-preview-clear').hide();
        $('.image-preview-input input:file').val("");
        $(".image-preview-input-title").text("Browse");
    });
    // Create the preview image
    $(".image-preview-input input:file").change(function () {
        var img = $('<img/>', {
            id: 'dynamic',
            width: 250,
            height: 200
        });
        var file = this.files[0];
        var reader = new FileReader();
        // Set preview image into the popover data-content
        reader.onload = function (e) {
            $(".image-preview-input-title").text("Change");
            $(".image-preview-clear").show();
            $(".image-preview-filename").val(file.name);
            img.attr('src', e.target.result);
            $(".image-preview").attr("data-content", $(img)[0].outerHTML).popover("show");
        }
        reader.readAsDataURL(file);
    });
});

function redirect(url) {
    window.location = url;
}

$('#recipe-form').find('[name="difficulty"], [name="portion"],[name="duration"],[name="preparation"]').combobox().end();

$('#plusinstruction').click(function () {
    $('#instructiontemp').append('<div id="textarea"><textarea name="instruction[]" maxlength="50" class="form-control" placeholder="Instruction" style="display:inline-block;width:88.5%;"></textarea><button type="button" class="btn btn-danger" data-type="plus" id="minusinstruction" style="display:inline-block;width:10%;margin-bottom: 30px;margin-left: 3px;padding: 0.7em"> <span class="glyphicon glyphicon-minus"></span></button></div>');
});

$('#instructiontemp').on('click', '#minusinstruction', function () {
    $(this).parent().remove();
});

$('#plusingredient').click(function () {
    $('#ingredienttemp').append('<div id="deleteingredient"><input type="text" name="ingredient[]" maxlength="50" id="ingredient" class="form-control"placeholder="Ingredient" style="display:inline-block;width:44%;"> <input type="text" name="amount[]" maxlength="50" id="amount" class="form-control" placeholder="Amount" style="display:inline-block;width:44%;"><button type="button" class="btn btn-danger" data-type="plus" id="minusingredient" style="display:inline-block;width:10%;margin-left: 3px;padding: 0.7em"> <span class="glyphicon glyphicon-minus"></span></button></div>');
});

$('#ingredienttemp').on('click', '#minusingredient', function () {
    $(this).parent().remove();
});

$('#recipe-form').submit(function (e) {
    e.preventDefault();
    var url = $('#recipe-form').attr('action');
    $('#error-recipe').text('');
    $.ajax({
        type: 'post',
        url: url,
        data: new FormData(this),
        contentType: false,
        processData: false,
        async: true,
        dataType: 'json',
        success: function (data) {
            redirect(window.location.href);
        },
        error: function (data) {
            errors = $.parseJSON(data.responseText);
            $('#flash-error-recipe').removeClass('hidden');
            $.each(errors, function (index, value) {
                $('#error-recipe').append("<li>" + value + "</li>")
            })
        }
    });
})
