var server = require('http').Server();
var io = require('socket.io')(server);
var Redis = require('ioredis');
var redis = new Redis();

// redis.subscribe('test-channel');
// redis.subscribe('post-channel');
// redis.subscribe('reply-channel');
redis.psubscribe('*', function(err, count) {});

// redis.on('message', function(channel, message){
//   console.log("recieved message");
//   message = JSON.parse(message);
//   io.emit(channel + ":" + message.event, message.data);
//
// });

redis.on('pmessage', function(subscribed, channel, message) {
    console.log(channel + ':' + message.event, message.data);
    message = JSON.parse(message);
    io.emit(channel + ':' + message.event, message.data);
});

server.listen(3000,function(){
  console.log("listening to port 3000");
});
