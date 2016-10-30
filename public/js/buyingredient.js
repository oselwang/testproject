function initMap() {

    var markers = [];

    var origin_place_id = null;

    var map = new google.maps.Map(document.getElementById('map'), {
        mapTypeControl: false,
        center: {lat: -6.175372, lng: 106.828535},
        zoom: 13
    });

    var directionsDisplay = new google.maps.DirectionsRenderer;
    directionsDisplay.setMap(map);

    var origin_input = document.getElementById('origin-input');

    map.controls[google.maps.ControlPosition.TOP_LEFT].push(origin_input);

    var origin_autocomplete = new google.maps.places.Autocomplete(origin_input);
    origin_autocomplete.bindTo('bounds', map);

    function expandViewportToFitPlace(map, place) {
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);
        }
    }

    origin_autocomplete.addListener('place_changed', function () {
        var place = origin_autocomplete.getPlace();
        if (!place.geometry) {
            window.alert("Autocomplete's returned place contains no geometry");
            return;
        }
        expandViewportToFitPlace(map, place);
        // If the place has a geometry, store its place ID and route if we have
        // the other place ID
        origin_place_id = place.place_id;
        clearMarkers();
        addMarker(place.geometry.location);
    });

    function addMarker(location) {
        var marker = new google.maps.Marker({
            position: location,
            map: map
        });
        markers.push(marker);
    }

    function clearMarkers() {
        setMapOnAll(null);
    }

    function setMapOnAll(map) {
        for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(map);
        }
    }
}

var defaultUrl = 'http://testproject.com/';


$('#ingredient-wrapper').on('input','#ingredient', function () {
    var parent = $(this).closest('td');
    var _ = $(this);
    if (_.val() == '' || _.val().length < 3) {
        parent.find('.ingredient-suggestion-container').addClass('hidden');
        return;
    }
    parent.find('.ingredient-suggestion-container').removeClass('hidden');
    parent.find('.ingredient-suggestion-container').children().remove();
    parent.find('div').append("<div class='ingredient-suggestion-list'><center><i class='fa fa-spinner fa-pulse fa-fw'></i></center></div>");
    delay(function () {
        var data = _.val();
        var url = defaultUrl + 'ingredient-search';
        $.ajax({
            type: 'post',
            url: url,
            data: {
                _token: $("#ingredient-form input[name='_token']").val(),
                ingredient: data
            },
            dataType: 'json',
            success: function (data) {
                parent.find('.ingredient-suggestion-container').children().remove();
                $.each(data, function (index, value) {
                    var src_str = data[index]['_source']['name'];
                    var term = _.val();
                    term = term.replace(/(\s+)/, "(<[^>]+>)*$1(<[^>]+>)*");
                    var pattern = new RegExp("(" + term + ")", "gi");
                    src_str = src_str.replace(pattern, "<b>$1</b>");
                    src_str = src_str.replace(/(<mark>[^<>]*)((<[^>]+>)+)([^<>]*<\/mark>)/, "$1</mark>$2<mark>$4");
                    parent.find('.ingredient-suggestion-container').append("<div class='ingredient-suggestion-list'>" + src_str + "</div>");
                })
            }
        });
    }, 500);

});

$('#ingredient-form').on('keyup',function (e) {

});

$('#ingredient-wrapper').on('click', '.ingredient-suggestion-container .ingredient-suggestion-list', function () {
    var ingredient = $(this).text();
    var parent = $(this).closest('td');
    parent.find('#ingredient').val(ingredient);
    parent.find('.ingredient-suggestion-container').addClass('hidden');
});

$("#add_row").on("click", function () {
    $('#ingredient-wrapper').append("<tr><td><input type='text' id='ingredient' name='ingredient[]' placeholder='Ingredient' class='form-control' required autocomplete='off'> <div class='ingredient-suggestion-container hidden'></div></td> <td style='width: 42%'> <input type='number' name='amount[]' placeholder='Amount' class='form-control' required style='width:80%;display: inline-block ' autocomplete='off' min='1'>&nbsp;<input type='text' value='gram' disabled class='form-control' style='width: 19%;display: inline-block'/></td><td> <input type='text' disabled class='form-control'></td><td id='remove-row'> <button class='btn btn-danger glyphicon glyphicon-remove row-remove' style='position: relative;left:20%'></button> </td></tr>")
});


$('#ingredient-wrapper').on('click','.row-remove', function () {
    $(this).closest('tr').remove();
});
// Sortable Code
var fixHelperModified = function (e, tr) {
    var $originals = tr.children();
    var $helper = tr.clone();

    $helper.children().each(function (index) {
        $(this).width($originals.eq(index).width())
    });

    return $helper;
};

$('#ingredient-form').on('submit',function (e) {
    e.preventDefault();
    var ingredient = $(this).serializeArray();
    var url = defaultUrl + 'recipe/finish-buy-ingredient';
    $.ajax({
        type: 'post',
        url: url,
        data: ingredient,
        dataType: 'json',
        success: function (data) {
           alert(data);
        }
    })
});