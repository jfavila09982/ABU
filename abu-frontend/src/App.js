import {Routes, Route} from 'react-router-dom';
import React from 'react';

import ChatWindow  from './components/ChatWindows';
import CreateUser from './components/CreateUser';
import './assets/styles/App.css';

function App() {
  return (
    <>
    <Routes>
    <Route path="/" element={<CreateUser />} />
    <Route path="/chat" element={<ChatWindow />} />
    </Routes>
    </>
  );
}

  // {/* <ChatWindow /> */}

  // <CreateUser />

export default App;
