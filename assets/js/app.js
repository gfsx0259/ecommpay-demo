// assets/js/app.js

require('../css/app.css');
var Centrifuge = require("centrifuge");

var centrifuge = new Centrifuge('ws://localhost:8000/connection/websocket', {
    debug: true,
    user: userId
});

centrifuge.setToken(jwt);


function updateUsersList()
{
    Object.keys(window.clients).forEach(function (key) {
        var user = window.clients[key];

        $('#joinChat').append($('<option>', {value: user, text: user}))
    })
}

window.sub = centrifuge.subscribe('demo#' + userId);
sub.on('publish', function(context) {
    console.log(context);
    $('.messages').append($('<div>').html(context.data.message));
});

window.clients = {};

window.sub2 = centrifuge.subscribe('shared:join');
sub2.on('join', function (context) {
console.log('JOOIN shared', context);

return;
    if (!window.clients[context.info.user]) {
        window.clients[context.info.user] = context.info.user;
    }
    updateUsersList();
});

sub2.presence().then(function(message) {
    window.clients = {};
    Object.keys(message.presence).forEach(function (key) {
        var userData = message.presence[key];

        if (!window.clients[userData.user]) {
            window.clients[userData.user] = userData.user;
        }
    });
    updateUsersList();

    console.log(message);
}, function(err) {
    // presence call failed with error
});

centrifuge.on('connect', function(context) {
  console.log(context);
});

centrifuge.connect();


$(function () {
    $("#contact-form button[type=\"submit\"]").click(() => {
        $.ajax({
            url: '/?r=site/chat',
            type: 'post',
            dataType: 'json',
            data: $('form').serialize(),
            success: function(data) {
                console.log(data);
            }
        });
        return false;
    })
});
