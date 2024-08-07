import React, { useState, useEffect } from "react";
import { Box, Typography } from "@mui/material";
import ChatHeader from "./ChatHeader";
import ChatInput from "./ChatInput";
import ChatMessage from "./ChatMessage";
import { getClientIP } from "./getClientAddress";


function ChatWindow() {
  const [messages, setMessages] = useState([]);

  if(!messages){
    console.log('User doest provided message')
  }
  else{
  setMessages(true);
  }

  const [userInfo] = useState({
    userId: "12321232",
    ipAddress: 'sampleip',
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
            User ID: {userInfo.userId} | IP Address: {userInfo.ipAddress} |
            Device: {userInfo.device}
          </Typography>
        </Box>
      </Box>
    </Box>
  );
}

export default ChatWindow;
