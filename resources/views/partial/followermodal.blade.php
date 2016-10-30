<div class="modal fade" id="follower-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true" style="display: none;">
    <div class="row" style="margin-right: 70px">
        <div class="col-md-5 col-md-offset-4">
            <div class="panel panel-login follow-modal" id="follower-wrap">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-12">
                            <a class="active">Follower</a>
                            <a href="#" id="close-follower-modal" style="float: right"><i class="fa fa-remove"></i> </a>
                            {{csrf_field()}}
                        </div>
                    </div>
                    <hr>
                </div>
                <ul class="list-group" id="follower-list">

                </ul>

            </div>
        </div>
    </div>
</div>

<script>
    var url = window.location.href;
    var split = url.split("?");
    var currentUrl = split[0];
    var followerPage = 1;
    var xhrfollower = 4;

    $('#follower-modal-click').one('click', function () {
        var split = currentUrl.split('/');
        var username = split[4];
        var url = "follower/" + username + '?page=' + followerPage;
        $('#follower-wrap').append("<center><i class='fa fa-spinner fa-pulse fa-2x fa-fw' id='follower-spinner'></i></center>");
        $.ajax({
            type: 'get',
            url: url,
            dataType: 'json',
            success: function (data) {
                $('#follower-spinner').addClass('hidden');
                $.each(data, function (index, value) {
                    if (value.followed_by_viewer == false && value.viewer == false) {
                        $('#follower-list').append("<li class='list-group-item'>" + value.name + "<button href='"+value.id+"' class='btn btn-success follow-button-modal'>Follow</button></li>");
                    }else if(value.viewer == true){
                        $('#follower-list').append("<li class='list-group-item'>" + value.name + "</li>");
                    }else {
                        $('#follower-list').append("<li class='list-group-item'>" + value.name + "<button href='"+value.id+"' class='btn btn-success follow-button-modal followed' style='float:right'>Following</button></li>");
                    }

                    if (value.last_page == value.current_page) {
                        xhrfollower = 1;
                    } else {
                        xhrfollower = 4;
                    }
                });
                followerPage += 1;
            }
        })
    });

    $('#follower-list').on('click', '.follow-button-modal', function () {
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
                '_token' : $("#follower-modal input[name='_token']").val()
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

    $('#follower-list').on('mouseenter','.followed',function(){
            var _ = $(this);
            _.css({'background-color': 'red', 'border-color': 'red'});
            _.html('Unfollow');
        });
    $('#follower-list').on('mouseleave','.followed',function(){
            var _ = $(this);
            _.css({'color': '#fff', 'background-color': '#5cb85c', 'border-color': '#4cae4c'});
            _.html('Following');
    });

    $('#close-follower-modal').on('click', function (e) {
        e.preventDefault();
        $('#follower-modal').modal('hide');
    });

    $('#follower-wrap').on('scroll', function () {
        if ($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
            var split = currentUrl.split('/');
            var username = split[4];
            var url = "follower/" + username + '?page=' + followerPage;
            if (xhrfollower != 4) {

            } else {
                $.ajax({
                    type: 'get',
                    url: url,
                    dataType: 'json',
                    success: function (data) {
                        $.each(data, function (index, value) {
                            $('#follower-list').append("<li class='list-group-item'>" + value.name + "</li>");
                            if (value.last_page == value.current_page) {
                                xhrfollower = 1;
                            } else {
                                xhrfollower = 4;
                            }
                        });
                        followerPage += 1;
                    }
                })
            }
        }
    })

</script>