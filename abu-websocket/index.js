import { WebSocketServer } from "ws";

const port = 8081;
const wss = new WebSocketServer({ port }, () => {
  console.log(`WebSocket server is running on port ${port}`);
});

wss.on("listening", () => {
  console.log(`WebSocket server is listening on port ${port}`);
});

wss.on("connection", function connection(ws, req) {
  var serverId = req.headers["sec-websocket-key"];

  console.log(`New connection from: ${req.socket.remoteAddress}`);

  ws.on("message", function message(data) {
    console.log("Received: %s", data);

    // Echo the message back to the client
    ws.send(`Echo: ${data}`);
    ws.send(`serverId: ${serverId}`);
    console.log(`serverId: ${serverId}`);
  });

  // ws.on("close", function close() {
  //   console.log("Client disconnected");
  // });

  ws.on("error", function error(err) {
    console.error("WebSocket error:", err);
  });

  ws.send("Established connection to the Local  WebSocket server!");
});

wss.on("error", (error) => {
  console.error("WebSocket server error:", error);
});

process.on("SIGINT", () => {
  console.log("Shutting down WebSocket server");
  wss.close(() => {
    console.log("WebSocket server closed");
    process.exit(0);
  });
});
