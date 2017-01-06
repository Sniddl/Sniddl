#!/usr/bin/env nodejs

var server = require('http').Server();
var io = require('socket.io')(server);
var Redis = require('ioredis');
var redis = new Redis();

redis.psubscribe('*', function(err, count) {});

redis.on('pmessage', function(subscribed, channel, message) {
    message = JSON.parse(message);
    console.log(channel + ':' + message.event, message.data);
    io.emit(channel + ':' + message.event, message.data);
});

server.listen(3000, 'http://sniddl.com');
