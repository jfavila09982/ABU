import React, { useState } from "react";
import { Box, Typography } from "@mui/material";
import ChatHeader from "./ChatHeader";
import ChatInput from "./ChatInput";
import ChatMessage from "./ChatMessage";

function ChatWindow() {
  const [messages, setMessages] = useState([]);
  const [userInfo] = useState({
    userId: "12321232",
    ipAddress: "192.168.1.1",
    device: "Desktop",
  });

  const handleSendMessage = (message) => {
    setMessages([...messages, message]);
  };

  return (
    <Box
      display="flex"
      flexDirection="column"
      alignItems="center"
      justifyContent="center"
      height="100vh"
    >
      <Box
        width="80%"
        maxWidth="600px"
        maxHeight="80vh"
        border="1px solid #ccc"
        borderRadius="5px"
        overflow="hidden"
      >
        <ChatHeader />
        <Box flexGrow={1} overflow="auto" p={2}>
          {messages.map((msg, index) => (
            <ChatMessage key={index} message={msg} />
          ))}
        </Box>
        <ChatInput onSend={handleSendMessage} />
        <Box p={2}>
          <Typography variant="caption">
            Session ID: {userInfo.userId} | IP Address: {userInfo.ipAddress} |
            Device: {userInfo.device}
          </Typography>
        </Box>
      </Box>
    </Box>
  );
}

export default ChatWindow;
