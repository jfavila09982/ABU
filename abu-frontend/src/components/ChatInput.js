import React, { useState } from 'react';
import { Box, TextField, IconButton, Snackbar } from '@mui/material';
import SendIcon from '@mui/icons-material/Send';
import { Alert } from '@mui/material';

function ChatInput({ onSend }) {
  const [message, setMessage] = useState('');
  const [openSnackbar, setOpenSnackbar] = useState(false);
  const [snackbarMessage, setSnackbarMessage] = useState('');

  const handleSend = () => {
    if (message.trim()) {
      try {
        onSend(message);
        setMessage('');
        setSnackbarMessage('Message sent!');
      } catch (error) {
        setSnackbarMessage('Failed to send message.');
      } finally {
        setOpenSnackbar(true);
      }
    }
  };

  const handleCloseSnackbar = () => {
    setOpenSnackbar(false);
  };

  return (
    <Box display="flex" p={2} alignItems="center">
      <TextField
        fullWidth
        variant="outlined"
        placeholder="Type a message..."
        value={message}
        onChange={(e) => setMessage(e.target.value)}
        onKeyPress={(e) => e.key === 'Enter' && handleSend()}
        inputProps={{ 'aria-label': 'message input' }}
      />
      <IconButton color="primary" onClick={handleSend} aria-label="send message">
        <SendIcon />
      </IconButton>
      <Snackbar
        open={openSnackbar}
        autoHideDuration={3000}
        onClose={handleCloseSnackbar}
      >
        <Alert onClose={handleCloseSnackbar} severity={snackbarMessage.includes('Failed') ? 'error' : 'success'}>
          {snackbarMessage}
        </Alert>
      </Snackbar>
    </Box>
  );
}

export default ChatInput;
