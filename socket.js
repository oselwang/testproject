var server = require('http').Server();

var io = require('socket.io')(server);

var Redis = require('ioredis');
var redis = new Redis();

redis.psubscribe('*',function(err,count){
    console.log('psubscribe');
});

redis.on('pmessage', function(subscribed,channel,message) {
    message = JSON.parse(message);
    io.emit(channel + ':' + message.event + ':' + message.data.user_id, message.data);
});

server.listen(3000);