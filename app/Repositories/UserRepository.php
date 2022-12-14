<?php


namespace App\Repositories;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function allUsers()
    {
        return User::orderBy('id', 'DESC')->paginate(10);
    }

    public function createUser(array $attributes)
    {
        return User::create($attributes);
    }

    public function getUserById(int $id)
    {
        return User::findOrFail($id);
    }

    public function updateUser(int $id, array $attributes)
    {
        return User::findOrFail($id)->update($attributes);
    }

    public function destroyUser(int $id)
    {
        User::findOrFail($id)->delete();
    }

    public function trashedUsers()
    {
        return User::onlyTrashed()->paginate(10);
    }

    public function restoreTrashedUser($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();
    }

    public function permanentlyDeleteUser($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->forceDelete();
    }
}
