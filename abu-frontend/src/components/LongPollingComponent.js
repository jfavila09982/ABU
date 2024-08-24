import React, { useState, useEffect } from 'react';

const LongPollingComponent = () => {
  const [data, setData] = useState(null);

  useEffect(() => {
    const poll = async () => {
      try {
        const response = await fetch('/api/poll');
        const result = await response.json();
        setData(result.data);

      
        poll();
      } catch (error) {
        console.error('Polling error:', error);
      
      }
    };
    poll();
    return () => {
      setData(null);
    };
  }, []);

  const updateData = async () => {
    try {
      await fetch('/api/update', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ data: 'New data' }),
      });
    } catch (error) {
      console.error('Update error:', error);
    }
  };

  return (
    <div>
      <h1>Long Polling Example</h1>
      <p>Data: {data}</p>
      <button onClick={updateData}>Update Data</button>
    </div>
    );
};

export default LongPollingComponent;
