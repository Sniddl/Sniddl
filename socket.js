// var server = require('http').createServer(function (req, res) {
//   res.writeHead(200, {'Content-Type': 'text/plain'});
//   res.end('Hello World\n');
// });
//
// var io = require('socket.io')(server);
// var Redis = require('ioredis');
// var redis = new Redis();
// redis.psubscribe('*', function(err, count) {});
//
// redis.on('pmessage', function(subscribed, channel, message) {
//     console.log(channel + ':' + message.event, message.data);
//     message = JSON.parse(message);
//     io.emit(channel + ':' + message.event, message.data);
// });
//
// server.listen(3000,function(){
//   console.log("listening to port 3000");
// });
//
//




var app = require('http').createServer(handler)
var io = require('socket.io')(app);
var fs = require('fs');

app.listen(3000);

function handler (req, res) {
  fs.readFile(__dirname + '/index.html',
  function (err, data) {
    if (err) {
      res.writeHead(500);
      return res.end('Error loading index.html');
    }

    res.writeHead(200);
    res.end(data);
  });
}

io.on('connection', function (socket) {
  socket.emit('news', { hello: 'world' });
  socket.on('my other event', function (data) {
    console.log(data);
  });
});


var Redis = require('ioredis');
var redis = new Redis();
redis.psubscribe('*', function(err, count) {});

redis.on('pmessage', function(subscribed, channel, message) {
    console.log(channel + ':' + message.event, message.data);
    message = JSON.parse(message);
    io.emit(channel + ':' + message.event, message.data);
});
