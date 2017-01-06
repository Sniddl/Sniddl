#!/usr/bin/env nodejs

var app   = require('express')();
var http  = require('http').Server(app);
var io    = require('socket.io')(http);
var Redis = require('ioredis');
var redis = new Redis();

redis.psubscribe('*', function(err, count) {});

redis.on('pmessage', function(subscribed, channel, message) {
    message = JSON.parse(message);
    console.log(channel + ':' + message.event, message.data);
    io.emit(channel + ':' + message.event, message.data);
});

http.listen(3000,function(){
  console.log("listening to port 3000");
});
