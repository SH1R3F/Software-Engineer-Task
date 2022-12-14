<?php

namespace App\Repositories;

interface UserRepositoryInterface
{
    public function allUsers();

    public function createUser(array $attributes);

    public function getUserById(int $id);

    public function updateUser(int $id, array $attributes);

    public function destroyUser(int $id);

    public function trashedUsers();

    public function restoreTrashedUser($id);

    public function permanentlyDeleteUser($id);
}
