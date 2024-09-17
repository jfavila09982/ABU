<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSessionRequest;
use App\Http\Traits\RespondsWithHttpStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use WebSocket\Client;
use Carbon\Carbon;

class SessionController extends Controller
{      

    use RespondsWithHttpStatus;
    
    
    public function createSession(CreateSessionRequest $request)
    {
        
        $randomUUID = $this->generateUUIDv4();
        $setUserName = $request->input('setUserName');
        $data = [
            'id' => $randomUUID,
            'username' => $setUserName,
            'statusCode' => 200,
            'userIp' => $request->ip()
        ];
        
        //Connect to WebSocket server (use textalk/websocket)
        try{
            $client = new Client("ws://localhost:8081");
            $now = Carbon::now();    
            $client->send(json_encode([
                'type' => 'session',
                'sessionId' => $randomUUID,
                'username' => $setUserName,
                'timestamp' => $now
            ]));
            $response = $client->receive();
            Log::info($response);


            if (isset($responseData['userId'])){
                $data['websocketUserId'] = $responseData['userId'];
            }

        } catch (\Exception $e){
            // $client->close(); 
           // Handle connection error
            Log::error('Websocket connection failed: ' . $e->getMessage());
        }

        return $this->success('Welcome to ABU ' . $setUserName . ' !!', $data);
 
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
       
        $data = random_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
        return sprintf('%08s-%04s-%04s-%04s-%12s',
            bin2hex(substr($data, 0, 4)),
            bin2hex(substr($data, 4, 2)),
            bin2hex(substr($data, 6, 2)),
            bin2hex(substr($data, 8, 2)),
            bin2hex(substr($data, 10, 6))
        );
    }


  

  



}
