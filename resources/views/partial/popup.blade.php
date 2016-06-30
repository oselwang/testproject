<link rel="stylesheet" type="text/css" href="{{asset('css/popup.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/animate.css')}}">
<div class="" id="popupnotif">
    <div class="padding-top-10">
        <div class="notif-extended animate" v-show="show" v-for="namaa in nama" transition="fade">
            <div>
                <p class="notify-count-green">You have a new messages<a href="#" v-on:click="refreshnotif"
                                                                        style="float:right;height:10px;width:10px">&times;</a>
                </p>
            </div>
            <div class="notif-message" v-for="urle in url">
                <a href="../../../@{{urle}}">
                    <span style="font-size:12px">@{{ namaa }}</span>
                <span class="notif-subject">
                    <span class="notif-subject-from"></span>
                </span>
                <span class="notif-subject-message">
                    subscribed to your newsletter.
                    <span class="label label-danger pull-right">25 MAR 2015</span>
                </span>
                </a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.16/vue.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/1.3.7/socket.io.min.js"></script>

<script type="text/javascript">
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
            nama: [],
            url: [],
            show: false,
            count: 0
        },
        methods: {
            takeDataReview: function () {
                socket.on('review-channel:App\\Events\\UserSubmittedReview:{{Auth::user()->id}}', function (data) {
                    this.nama = [];
                    this.url = [];
                    this.nama.push(data.name + ' submit a review on your recipe');
                    this.url.push(data.notification_url);
                    this.show = true;
                    this.count += 1;
                }.bind(this));
            },

            takeDataFollow: function () {
                socket.on('follow-channel:App\\Events\\UserFollowing:{{Auth::user()->id}}', function (data) {
                    this.nama = [];
                    this.url = [];
                    this.nama.push(data.name + ' has followed you');
                    this.url.push(data.notification_url);
                    this.show = true;
                    this.count += 1;
                }.bind(this));
            },


            refreshnotif: function (e) {
                e.preventDefault();
                this.show = false;
                this.nama = [];
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
