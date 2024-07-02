<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;

class UserRepository
{
    public function createUser(Request $request, array $data)
    {
        // Get the user's IP address
        $ipAddress = $request->ip();        

        // Validate the incoming data
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            // Hash the password before storing it
            $data['password'] = bcrypt($data['password']);
            // Add IP address to the data array
            $data['ip_address'] = $ipAddress;

            $user = User::create($data);
            return $user;
        } catch (\Exception $e) {
            return response()->json(['error' => 'User could not be created'], 500);
        }
    }

    public function randomUsers(Request $request)
{
    if (!Session::has('user_id')) {
        Session::put('user_id', (string) Str::uuid());
    }
   
    $device = $request->server('HTTP_USER_AGENT');
  

    $data = [
        'user_id' => Session::get('user_id'),
        'device' => $device,
    ];   
    return response()->json([
        'message' => 'success',
        'data' => $data,
        'status' => 200
    ]);
}
    public function getAllUsers()
    {
        return User::all();
    }

    public function getUserById($id)
    {
        return User::findOrFail($id);
    }

    public function updateUser($id, array $data)
    {
        $user = User::findOrFail($id);
        $currentIp = $user->getCurrentAddress();
        $ipAddress = $currentIp; 
        $user['ip_address'] = $ipAddress;
        $user->update($data);
        return $user;
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
    }
}
