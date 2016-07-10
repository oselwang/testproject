$('#search-recipe').click(function (e) {
    e.preventDefault();
    $('.search-container').slideToggle("fast");
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
                    var urlhref = 'http://testproject.net/recipe/';
                    var urlphoto = 'http://testproject.net/';
                    term = term.replace(/(\s+)/, "(<[^>]+>)*$1(<[^>]+>)*");
                    var pattern = new RegExp("(" + term + ")", "gi");
                    src_str = src_str.replace(pattern, "<b>$1</b>");
                    src_str = src_str.replace(/(<mark>[^<>]*)((<[^>]+>)+)([^<>]*<\/mark>)/, "$1</mark>$2<mark>$4");
                    $('.suggestion-container').removeClass('hidden');
                    $('.suggestion-container').append("<a href="+urlhref + data[index]['_source']['slug'] + "><div class='suggestion-list'><img src="+ urlphoto + data[index]['_source']['photo_name']+" class='suggestion-pic'>" + src_str + "</div></a>");

                    console.log(data[index]);
                })
            }
        });
    }, 500);

});

$('#notification').one('click',function () {
    var url = 'http://testproject.net/notification';
   $.ajax({
       type:'get',
       url: url,
       dataType: 'json',
       success: function (data) {
           if(data.length == 0){
               $('#notification-spinner').addClass('hidden');
               $('#notification-list').append("<li class='notification-list'><p class='notification-none'>No notification yet</p></li>");
           }
           $.each(data,function (index,value) {
               var background = '';
               var status = "<i class='fa fa-circle' style='margin-right: 10px;'></i>";
               var url = 'http://testproject.net/';
               $('#notification-spinner').addClass('hidden');
               $('#notification-list').append("<li class='notification-list' "+background+"><a href="+url + value.url+"?notification_id="+value.id+"><div class='row'><div class='col-lg-1'>"+status +value.message+"</div></div></a></li>");
           })
       }

   })
});