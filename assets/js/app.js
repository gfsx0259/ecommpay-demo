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
});

centrifuge.on('connect', function(context) {
  console.log(context);
});

centrifuge.connect();
