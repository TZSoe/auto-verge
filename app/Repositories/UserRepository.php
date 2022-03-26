<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface 
{
    public function getAllUsers() 
    {
        return User::where('isAdmin',0)->paginate(10);
    }

    public function getUserById($userId) 
    {
        return User::where('isAdmin', 0)->findOrFail($userId);
    }

    public function createUser(array $userData) 
    {
        return User::create($userData);
    }

    public function updateUser($userId, array $userData) 
    {
        $user = $this->getUserById($userId);
        $user->update($userData);
        return $user;
    }

    public function deleteUser($userId) 
    {
        $user = $this->getUserById($userId);
        $user->delete();
    }
}
