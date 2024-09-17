import { WebSocketServer } from "ws";

const socket = new WebSocketServer("ws://localhost:8081");
let websocketUserId;

socket.onmessage = function (event) {
  const data = JSON.parse(event.data);
  if (data.type === "sessionConfirmed") {
    websocketUserId = data.userId;
    ws.send(`userId: ${websocketUserId} connected`);
    // Store this ID and send it with future requests
  }
};

// // When making API calls:
// fetch("/api/create", {
//   headers: {
//     "X-Websocket-User-Id": websocketUserId,
//   },
// });
