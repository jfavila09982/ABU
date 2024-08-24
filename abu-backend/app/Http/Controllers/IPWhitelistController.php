<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IPWhitelistController extends Controller
{
    public function index(){

        $ips = IPAddress::all();

        $data = ['message' => 'List of IPs Whitelisted',
                 'data' => $ips,
                 'statusCode' => 200,
                ]; 
                

        return response()->json($data);

    }
}
