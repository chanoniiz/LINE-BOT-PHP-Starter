
<script src="lib/mqtt.js"></script>
<script type="text/javascript">
// Create a client instance
client = new Paho.MQTT.Client("broker.mqttdashboard.com", Number(8000), "clientId_test");

// set callback handlers
client.onConnectionLost = onConnectionLost;
client.onMessageArrived = onMessageArrived;

// connect the client
client.connect({onSuccess:onConnect});


// called when the client connects
function onConnect() {
  // Once a connection has been made, make a subscription and send a message.
  console.log("onConnect");
  client.subscribe("test/mqtt"); //Toppic sub
  message = new Paho.MQTT.Message("Hello MJU"); //message pub
  message.destinationName = "test/mqtt"; //Toppic pub
  client.send(message);
}

// called when the client loses its connection
function onConnectionLost(responseObject) {
  if (responseObject.errorCode !== 0) {
    console.log("onConnectionLost:"+responseObject.errorMessage);
  }
}
