<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\UserRepositoryInterface;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class UserController extends Controller
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository) 
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userRepository->getAllUsers();
        return response()->json([
            'status' => 'success',
            'data' => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        $userData['username'] = $request->username;
        $userData['password'] = bcrypt($request->password);

        if($request->has('isAdmin')){
            $userData['isAdmin'] = $request->isAdmin;
        }

        $user = $this->userRepository->createUser($userData);

        return response()->json([
            'status' => 'success',
            'data' => $user
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->userRepository->getUserById($id);
        return response()->json([
            'status' => 'success',
            'data' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $userData = [];

        if($request->has('username')){
            $userData['username'] = $request->username;
        }
        if($request->has('password')){
            $userData['password'] = bcrypt($request->password);
        }
        if($request->has('isAdmin')){
            $userData['isAdmin'] = $request->isAdmin;
        }

        $user = $this->userRepository->updateUser($id, $userData);

        return response()->json([
            'status' => 'success',
            'data' => $user
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $this->userRepository->deleteUser($id);
        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
