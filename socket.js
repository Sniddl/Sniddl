#!/usr/bin/env nodejs

function handler (req, res) {
  fs.readFile(__dirname + '/index.html',
  function (err, data) {
    if (err) {
      res.writeHead(500);
      return res.end('Error socket.js line 8');}
    res.writeHead(200);
    res.end(data);});}


var server = require('http').createServer(handler);
var Socket = require('socket.io');
var io = new Socket();
var fs = require('fs');
var Redis = require('ioredis');
var redis = new Redis();
io.set('origins', '*:*');

redis.psubscribe('*', function(err, count) {});

redis.on('pmessage', function(subscribed, channel, message) {
    console.log(channel + ':' + message.event, message.data);
    message = JSON.parse(message);
    io.emit(channel + ':' + message.event, message.data);
});

server.listen(3000,function(){
  console.log("listening to port 3000");
});
