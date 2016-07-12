<link rel="stylesheet" type="text/css" href="{{asset('css/popup.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/animate.css')}}">
<div class="" id="popupnotif">
    <div class="padding-top-10">
        <div class="notif-extended animate" v-show="show" v-for="messages in message" transition="fade">
            <div>
                <p class="notify-count-green">You have a new notification<a href="#" v-on:click="refreshnotif"
                                                                            style="float:right;height:10px;width:10px">&times;</a>
                </p>
            </div>
            <div class="notif-message" v-for="urle in url">
                <a href="../../../@{{urle}}">
                    <span style="font-size:12px">@{{ messages }}</span>
                <span class="notif-subject">
                    <span class="notif-subject-from"></span>
                </span>
                <span class="notif-subject-message">
                    <span class="label label-danger pull-right"></span>
                </span>
                </a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.16/vue.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/1.3.7/socket.io.min.js"></script>

<script type="text/javascript">
    function getNotification(){
        var url = 'http://testproject.net/notification';
        $('#notification-list').text('');
        $('#notification-list').append("<center><li><i class='fa fa-spinner fa-pulse fa-3x fa-fw notification-spinner' id='notification-spinner'></i> </li> </center>");
        $(this).unbind('click');
        $.ajax({
            type:'get',
            url: url,
            dataType: 'json',
            success: function (data) {
                if(data.length == 0){
                    $('#notification-spinner').addClass('hidden');
                    $('#notification-list').append("<li class='notification-list'><p class='notification-none'>No notification yet</p></li>");
                }else{
                    $('#notification-spinner').addClass('hidden');
                    $.each(data,function (index,value) {
                        var status = "<i class='fa fa-circle' style='margin-right: 10px;'></i>";
                        var url = 'http://testproject.net/';
                        $('#notification-list').append("<li class='notification-list'><a href="+url + value.url+"?notification_id="+value.id+"><div class='row'><div class='col-lg-1'>"+status +value.message+"</div></div></a></li>");
                    })
                }
            }

        })
    }

    var socket = io('testproject.net:3000');

    Vue.transition('fade', {
        css: false,
        enter: function (el, done) {
            // element is already inserted into the DOM
            // call done when animation finishes.
            $(el)
                    .css('opacity', 0)
                    .animate({opacity: 1}, 1000, done)
        },
        enterCancelled: function (el) {
            $(el).stop()
        },
        leave: function (el, done) {
            // same as enter
            $(el).animate({opacity: 0}, 1000, done)
        },
        leaveCancelled: function (el) {
            $(el).stop()
        }
    });
    new Vue({
        el: 'body',
        data: {
            message: [],
            url: [],
            show: false,
            count: 0
        },
        methods: {
            takeDataReview: function () {
                socket.on('review-channel:App\\Events\\UserSubmittedReview:{{Auth::user()->id}}', function (data) {
                    var defaulturl = 'http://testproject.net/';
                    var message = data.name + ' submit a review on your recipe';
                    this.message = [];
                    this.url = [];
                    this.message.push(message);
                    this.url.push(data.notification_url + "?notification_id=" + data.notification_id);
                    this.show = true;
                    this.count += 1;
                    $('#notification').on('click',getNotification());
                }.bind(this));
            },

            takeDataFollow: function () {
                socket.on('follow-channel:App\\Events\\UserFollowing:{{Auth::user()->id}}', function (data) {
                    this.message = [];
                    this.url = [];
                    this.message.push(data.name + ' has followed you');
                    this.url.push(data.notification_url);
                    this.show = true;
                    this.count += 1;
                }.bind(this));
            },


            refreshnotif: function (e) {
                e.preventDefault();
                this.show = false;
                this.message = [];
                this.url = [];
            }

        },
        ready: function () {
            this.takeDataReview();
            var vm = this;
            $.get('{{url('totalnotification')}}', function (data) {
                vm.count = data;
            });
        }
    });
</script>
