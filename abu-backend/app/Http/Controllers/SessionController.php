<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSessionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SessionController extends Controller
{      
    
    public function createSession(CreateSessionRequest $request)
    {
        
        $randomUUID = $this->generateUUIDv4();

        $setUserName = $request->input('setUserName');
        $sessionId = session_id();
        $data = [
            'id' => $randomUUID,
            'message' => 'Welcome to ABU ' . $setUserName . ' !!',
            'username' => $setUserName,
            'statusCode' => 200,
            'userIp' => $request->ip()
        ];

        return response()->json($data);
    }

    public function getUserIp(Request $request) {
        
        $userIp = $request->ip();
        $data = [
            'message' => 'Fetching User IPs',
            'ip' => $userIp,
            'statusCode' => 200,
        ];  
        
        return response()->json($data);

    }

    public function generateUUIDv4() {
        // Generate 16 random bytes
        $data = random_bytes(16);
    
        // Set version to 0100 (UUID version 4)
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        
        // Set variant to 10xx (RFC 4122 compliant)
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
    
        // Format the bytes as a UUID string
        return sprintf('%08s-%04s-%04s-%04s-%12s',
            bin2hex(substr($data, 0, 4)),
            bin2hex(substr($data, 4, 2)),
            bin2hex(substr($data, 6, 2)),
            bin2hex(substr($data, 8, 2)),
            bin2hex(substr($data, 10, 6))
        );
    }

  



}
