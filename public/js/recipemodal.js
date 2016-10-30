var defaultUrl = 'http://testproject.com/';
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

$('#plus-instruction').click(function () {
    $('#instruction-temp').append('<div id="textarea"><textarea name="instruction[]" class="form-control" placeholder="Instruction" style="display:inline-block;width:94.8%;"></textarea><button type="button" class="btn btn-danger" data-type="plus" id="minus-instruction" style="margin-bottom: 30px;margin-left: 3px;"> <span class="glyphicon glyphicon-remove"></span></button></div>');
});

$('#instruction-temp').on('click', '#minus-instruction', function () {
    $(this).parent().remove();
});

$('#instruction-temp1').on('click', '#minus-instruction', function () {
    $(this).parent().remove();
});

$('#plus-ingredient').click(function () {
    // $('#ingredient-form-recipe-modal').append('<div id="deleteingredient"><input type="text" name="ingredient[]" maxlength="50" id="ingredient" class="form-control"placeholder="Ingredient" style="display:inline-block;width:47.2%;"> <input type="text" name="amount[]" maxlength="50" id="amount" class="form-control" placeholder="Amount" style="display:inline-block;width:37.2%;"><input type="text" name="unit" disabled style="display: inline-block;width: 10%;" value="gram" class="form-control"><button type="button" class="btn btn-danger" data-type="plus" id="minus-ingredient" style="margin-left:2px"> <span class="glyphicon glyphicon-remove"></span></button></div>');
    $('#ingredient-form-recipe-modal').append(' <div id="ingredient-temp"><input type="text" name="ingredient[]" maxlength="50" id="ingredient"class="form-control" tabindex="1"placeholder="Ingredient" style="display:inline-block;width:47.2%;"> <input type="text" name="amount[]" maxlength="50" id="amount"class="form-control"placeholder="Amount" style="display:inline-block;width:37.2%;"tabindex="1"> <input type="text" name="unit[]" disabled style="display: inline-block;width: 10%;margin-left: -4px" value="gram" class="form-control"> <button type="button" class="btn btn-danger" data-type="plus"id="minus-ingredient"style="display:inline-block;"> <span class="glyphicon glyphicon-remove"></span> </button><div class="ingredient-suggestion-container-recipe-modal hidden"> </div> </div>');
});

$('#ingredient-form-recipe-modal').on('click', '#minus-ingredient', function () {
    $(this).parent().remove();
});
$('#ingredient-form-recipe-modal').on('click', '#minus-ingredient', function () {
    $(this).parent().remove();
});

$('#recipe-form').submit(function (e) {
    e.preventDefault();
    var url = $('#recipe-form').attr('action');
    $('#error-recipe').text('');
    delay(function () {
        $.ajax({
            type: 'post',
            url: url,
            data: new FormData(this),
            contentType: false,
            processData: false,
            async: true,
            dataType: 'json',
            success: function (data) {
                location.reload();
            },
            error: function (data) {
                errors = $.parseJSON(data.responseText);
                $('#flash-error-recipe').removeClass('hidden');
                $.each(errors, function (index, value) {
                    $('#error-recipe').append("<li>" + value + "</li>")
                })
            }
        });
    }, 500);
});

$('#close-recipe-modal').on('click', function () {
    $('#recipe-modal').modal('hide');
})

$('#ingredient-form-recipe-modal').on('input','#ingredient', function () {
    var parent = $(this).closest('#ingredient-temp');
    var _ = $(this);
    if (_.val() == '' || _.val().length < 3) {
        parent.find('.ingredient-suggestion-container-recipe-modal').addClass('hidden');
        return;
    }
    parent.find('.ingredient-suggestion-container-recipe-modal').removeClass('hidden');
    parent.find('.ingredient-suggestion-container-recipe-modal').children().remove();
    parent.find('div').append("<div class='ingredient-suggestion-list-recipe-modal'><center><i class='fa fa-spinner fa-pulse fa-fw'></i></center></div>");
    delay(function () {
        var data = _.val();
        var url = defaultUrl + 'ingredient-search';
        $.ajax({
            type: 'post',
            url: url,
            data: {
                _token: $("#recipe-form input[name='_token']").val(),
                ingredient: data
            },
            dataType: 'json',
            success: function (data) {
                parent.find('.ingredient-suggestion-container-recipe-modal').children().remove();
                $.each(data, function (index, value) {
                    var src_str = data[index]['_source']['name'];
                    var term = _.val();
                    term = term.replace(/(\s+)/, "(<[^>]+>)*$1(<[^>]+>)*");
                    var pattern = new RegExp("(" + term + ")", "gi");
                    src_str = src_str.replace(pattern, "<b>$1</b>");
                    src_str = src_str.replace(/(<mark>[^<>]*)((<[^>]+>)+)([^<>]*<\/mark>)/, "$1</mark>$2<mark>$4");
                    parent.find('.ingredient-suggestion-container-recipe-modal').append("<div class='ingredient-suggestion-list-recipe-modal'>" + src_str + "</div>");
                })
            }
        });
    }, 500);

});

$('#ingredient-form-recipe-modal').on('click', '.ingredient-suggestion-container-recipe-modal .ingredient-suggestion-list-recipe-modal', function () {
    var ingredient = $(this).text();
    var parent = $(this).closest('#ingredient-temp');
    parent.find('#ingredient').val(ingredient);
    parent.find('.ingredient-suggestion-container-recipe-modal').addClass('hidden');
});