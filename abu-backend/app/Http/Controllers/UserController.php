<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userService->getAllUsers();

        return response()->json($users);
    }

    public function show($id)
    {
        $user = $this->userService->getUserById($id);

        return response()->json($user);
    }

    public function store(Request $request)
    {
        $user = $this->userService->createUser($request->all());

        return response()->json($user, 201);
    }

    public function update(Request $request, $id)
    {
        $user = $this->userService->updateUser($id, $request->all());

        return response()->json($user);
    }

    public function destroy($id)
    {
        $success = $this->userService->deleteUser($id);

        return response()->json(['success' => $success]);
    }
}
