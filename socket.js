#!/usr/bin/env nodejs

var app   = require('express')();
var https  = require('https');
var io    = require('socket.io')(https);
var Redis = require('ioredis');
var redis = new Redis();
var server = https.createServer({
                key: fs.readFileSync('privkey.pem'),
                cert: fs.readFileSync('fullchain.pem')
             },app);

redis.psubscribe('*', function(err, count) {});

redis.on('pmessage', function(subscribed, channel, message) {
    message = JSON.parse(message);
    console.log(channel + ':' + message.event, message.data);
    io.emit(channel + ':' + message.event, message.data);
});

https.listen(3000,function(){
  console.log("listening to port 3000");
});
