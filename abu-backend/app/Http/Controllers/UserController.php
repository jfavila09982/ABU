<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;


class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $users = $this->userRepository->getAllUsers();
        return response()->json($users);
    }
    

    public function show(Request $request, $id)
    {
        $user = $this->userRepository->getUserById($id);
        return response()->json($user);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $user = $this->userRepository->createUser($request, $data);
        return response()->json($user, 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $user = $this->userRepository->updateUser($id, $data);
        return response()->json($user);
    }

    public function destroy($id)
    {
        $this->userRepository->deleteUser($id);
        return response()->json(null, 204);
    }


    public function createUser(Request $request)
    {
        $data = $request->all();
        return $this->userRepository->createUser($request, $data);
    }




    //random user 

    public function random(Request $request)
    {
        return $this->userRepository->randomUsers($request);
    }

}
