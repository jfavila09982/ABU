import React from 'react';
import { AppBar, Toolbar, Typography } from '@mui/material';

function ChatHeader() {
  return (
    <AppBar position="static">
      <Toolbar>
        <Typography variant="h6">
          Chat Room
        </Typography>
      </Toolbar>
    </AppBar>
  );
}

export default ChatHeader;
