<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface 
{
    public function getAllUsers() 
    {
        return User::simplePaginate(10);
    }

    public function getUserById($userId) 
    {
        return User::findOrFail($userId);
    }

    public function createUser(array $userData) 
    {
        return User::create($userData);
    }

    public function updateUser($userId, array $userData) 
    {
        $user = User::findOrFail($userId);
        $user->update($userData);
        return $user;
    }

    public function deleteUser($userId) 
    {
        $user = User::findOrFail($userId);
        $user->delete();
    }
}
