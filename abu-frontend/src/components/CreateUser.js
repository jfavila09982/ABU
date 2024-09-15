import React, { useState } from "react";
import { Box, Typography, Button, TextField } from "@mui/material";
import axios from "axios";

function CreateUser() {
  const [username, setUsername] = useState("");
  const [messages, setMessages] = useState([]);
  const [userInfo, setUserInfo] = useState({
    userId: "",
    ipAddress: "",
    device: "Desktop",
  });
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState(null);

  const handleSendMessage = (message) => {
    setMessages([...messages, message]);
  };

  const createUserSession = async () => {
    if (!username) {
      setError("Username is required.");
      return;
    }

    setLoading(true);

    
    setError(null);

    try {
      // Make a POST request to the Laravel API
      const response = await axios.post("http://localhost:8000/api/create", {
        setUserName: username,
      });

      // Handle successful response from the API
      const data = response.data;
      setUserInfo({
        userId: data.id,
        ipAddress: data.userIp,
        device: userInfo.device,
      });

      // Clear the username input
      setUsername("");

      console.log("User session created:", data);
    } catch (error) {
      setError("Error creating user session.");
      console.error("Error creating user session:", error);
    } finally {
      setLoading(false);
    }
  };

  return (
    <Box
      display="flex"
      flexDirection="column"
      alignItems="center"
      justifyContent="center"
      height="100vh"
      p={2}
    >
      <Box
        width="80%"
        maxWidth="600px"
        border="1px solid #ccc"
        borderRadius="5px"
        overflow="hidden"
        p={2}
      >
        <Typography variant="h6" gutterBottom>
          Set Username
        </Typography>
        <TextField
          label="Enter Username"
          placeholder="You'll be known by?"
          variant="outlined"
          fullWidth
          value={username}
          onChange={(e) => setUsername(e.target.value)}
          margin="normal"
        />
        <Button
          variant="contained"
          color="primary"
          onClick={createUserSession}
          disabled={loading}
        >
          {loading ? "Creating..." : "Create Session"}
        </Button>
        {error && (
          <Typography color="error" variant="body2" mt={2}>
            {error}
          </Typography>
        )}
        {userInfo.userId && (
          <Box mt={2}>
            <Typography variant="caption">
              User ID: {userInfo.userId} | IP Address: {userInfo.ipAddress} | Device: {userInfo.device}
            </Typography>
          </Box>
        )}
        <Box mt={2}>
          {messages.map((msg, index) => (
            <Typography key={index} variant="body2">
              {msg}
            </Typography>
          ))}
        </Box>
      </Box>
    </Box>
  );
}

export default CreateUser;
