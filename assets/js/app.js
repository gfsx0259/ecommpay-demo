// assets/js/app.js

require('../css/app.css');
var Centrifuge = require("centrifuge");

var centrifuge = new Centrifuge('ws://localhost:8000/connection/websocket', {
    debug: true
});

centrifuge.setToken(jwt);

window.sub = centrifuge.subscribe("demo");
sub.on('publish', function(context) {
    console.log(context);
    $('.messages').append($('<div>').html(context.data.message));
});

centrifuge.on('connect', function(context) {
  console.log(context);
});

centrifuge.connect();


$(function () {
    $("button[type=\"submit\"]").click(() => {
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
