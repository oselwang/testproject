$('#search-recipe').click(function (e) {
    e.preventDefault();
    $('.search-container').slideToggle("fast");
});

$('#notification').one('click', function (e) {
    e.preventDefault();
});

var delay = (function () {
    var timer = 0;
    return function (callback, ms) {
        clearTimeout(timer);
        timer = setTimeout(callback, ms);
    };
})();

$('#search').keyup(function () {
    if ($(this).val() == '') {
        $('.suggestion-container').addClass('hidden');
    }
    $('.suggestion-list').parent().remove();
    delay(function () {
        var data = $('#search').val();
        var url = 'http://testproject.net/suggest-search';
        $.ajax({
            type: 'post',
            url: url,
            data: {
                search: data
            },
            dataType: 'json',
            success: function (data) {
                $.each(data, function (index, value) {
                    var src_str = data[index]['_source']['name'];
                    var term = $('#search').val();
                    term = term.replace(/(\s+)/, "(<[^>]+>)*$1(<[^>]+>)*");
                    var pattern = new RegExp("(" + term + ")", "gi");
                    src_str = src_str.replace(pattern, "<b>$1</b>");
                    src_str = src_str.replace(/(<mark>[^<>]*)((<[^>]+>)+)([^<>]*<\/mark>)/, "$1</mark>$2<mark>$4");
                    $('.suggestion-container').removeClass('hidden');
                    $('.suggestion-container').append("<a href='{{url('http://testproject.net/recipe/')}}" + data[index]['_source']['slug'] + "'><div class='suggestion-list'><img src={{url('http://testproject.net/')}}" + data[index]['_source']['photo_name'] + " class='suggestion-pic'>" + src_str + "</div></a>");
                    console.log(data[index]);
                })
            }
        });
    }, 500);

});

$('#notification').one('click',function () {
   $.ajax({
       type:'post',
       url: 'testproject.net/getNotification',
       
   })
});