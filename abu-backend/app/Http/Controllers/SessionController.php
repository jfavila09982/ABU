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
        $setUserName = $request->input('setUserName');
        $data = [
            'message' => 'Welcome to ABU ' . $setUserName . ' !!',
            'username' => $setUserName,
            'statusCode' => 200,
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


}
