#!/usr/bin/env nodejs
var http = require('http');
http.createServer(function (req, res) {
  res.writeHead(200, {'Content-Type': 'text/plain'});
  res.end('Hello World\n');
}).listen(8080, 'localhost');
console.log('Server running at http://localhost:8080/');


// #!/usr/bin/env nodejs
// var server = require('http').createServer(function (req, res) {
//   res.writeHead(200, {'Content-Type': 'text/plain'});
//   res.end('Hello World\n');
// }).listen(8080, 'localhost');
//
// var io = require('socket.io')(server);
// var Redis = require('ioredis');
// var redis = new Redis();
//
// redis.psubscribe('*', function(err, count) {});
//
// redis.on('pmessage', function(subscribed, channel, message) {
//     console.log(channel + ':' + message.event, message.data);
//     message = JSON.parse(message);
//     io.emit(channel + ':' + message.event, message.data);
// });
//
// // server.listen(3000,function(){
// //   console.log("listening to port 3000");
// // });
