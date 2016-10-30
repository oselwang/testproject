<div class="modal fade" id="following-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true" style="display: none;">
    <div class="row" style="margin-right: 70px">
        <div class="col-md-5 col-md-offset-4">
            <div class="panel panel-login follow-modal" id="following-wrap">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-12">
                            <a class="active">Following</a>
                            <a href="#" id="close-following-modal" style="float: right"><i class="fa fa-remove"></i> </a>
                            {{csrf_field()}}
                        </div>
                    </div>
                    <hr>
                </div>
                <ul class="list-group" id="following-list">

                </ul>

            </div>
        </div>
    </div>
</div>

<script>
    var url = window.location.href;
    var split = url.split("?");
    var currentUrl = split[0];
    var followingPage = 1;
    var xhrfollowing = 4;

    $('#following-modal-click').one('click', function () {
        var split = currentUrl.split('/');
        var username = split[4];
        var url = "following/" + username + '?page=' + followingPage;
        $('#following-wrap').append("<center><i class='fa fa-spinner fa-pulse fa-2x fa-fw' id='following-spinner'></i></center>");
        $.ajax({
            type: 'get',
            url: url,
            dataType: 'json',
            success: function (data) {
                $('#following-spinner').addClass('hidden');
                $.each(data, function (index, value) {
                    if (value.followed_by_viewer == false && value.viewer == false) {
                        $('#following-list').append("<li class='list-group-item'>" + value.name + "<button href='"+value.id+"' class='btn btn-success follow-button-modal'>Follow</button></li>");
                    }else if(value.viewer == true){
                        $('#following-list').append("<li class='list-group-item'>" + value.name + "</li>");
                    }else {
                        $('#following-list').append("<li class='list-group-item'>" + value.name + "<button href='"+value.id+"' class='btn btn-success follow-button-modal followed' style='float:right'>Following</button></li>");
                    }

                    if (value.last_page == value.current_page) {
                        xhrfollowing = 1;
                    } else {
                        xhrfollowing = 4;
                    }
                });
                followingPage += 1;
            }
        })
    });

    $('#following-list').on('click', '.follow-button-modal', function () {
        var _ = $(this);
        var id = _.attr("href");
        _.html("<div style='padding-left: 1em;padding-right: 1em'><i class='fa fa-spinner fa-pulse fa-1x fa-fw'></i></div>");
        _.prop('disabled',true);
        var url = 'follow-user';
        $.ajax({
            type: 'post',
            url: url,
            data: {
                'user_id' : id,
                '_token' : $("#following-modal input[name='_token']").val()
            },
            dataType: 'json',
            success: function (data) {
                _.prop('disabled', false);
                if (data == 'Following') {
                    _.css({'color': '#fff', 'background-color': '#5cb85c', 'border-color': '#4cae4c'});
                    _.mouseenter(function () {
                        _.css({'background-color': 'red', 'border-color': 'red'});
                        _.html('Unfollow');
                    }).mouseleave(function () {
                        _.css({'color': '#fff', 'background-color': '#5cb85c', 'border-color': '#4cae4c'});
                        _.html('Following');
                    });
                    _.html(data);
                } else if (data = 'Follow') {
                    _.html(data);
                    _.removeClass('followed');
                    _.css({'color': '#fff', 'background-color': '#5cb85c', 'border-color': '#4cae4c'});
                    _.mouseenter(function () {
                        _.css({'color': '#fff', 'background-color': '#449d44', 'border-color': '#398439'});
                        _.html(data);
                    }).mouseleave(function () {
                        _.css({'color': '#fff', 'background-color': '#5cb85c', 'border-color': '#4cae4c'});
                        _.html(data);
                    })

                }
            },
            error: function (data) {

            }

        });

    });

    $('#following-list').on('mouseenter','.followed',function(){
        var _ = $(this);
        _.css({'background-color': 'red', 'border-color': 'red'});
        _.html('Unfollow');
    });
    $('#following-list').on('mouseleave','.followed',function(){
        var _ = $(this);
        _.css({'color': '#fff', 'background-color': '#5cb85c', 'border-color': '#4cae4c'});
        _.html('Following');
    });

    $('#close-following-modal').on('click', function (e) {
        e.preventDefault();
        $('#following-modal').modal('hide');
    });


</script>