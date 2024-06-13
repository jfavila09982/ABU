import React from 'react';
import { Box, Typography } from '@mui/material';

function ChatMessage({ message, timestamp }) {
  return (
    <Box p={1} borderBottom="1px solid #ccc">
      <Typography variant="body1">{message}</Typography>
      <Typography variant="caption" color="textSecondary">
        {new Date(timestamp).toLocaleString()} {/* Display timestamp */}
      </Typography>
    </Box>
  );
}

export default ChatMessage;
