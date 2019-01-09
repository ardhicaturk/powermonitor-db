var faye = require('faye');
var client = new faye.Client('http://localhost:8000/');

client.subscribe('/messages', function(message) {
  alert('Got a message: ' + message.text);
});
client.publish('/messages', {
  text: 'Hello world'
});