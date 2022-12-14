<?php

namespace App\Services;

interface UserServiceInterface
{

    /**
     * Generate hash for password.
     *
     * @param  string $password
     * @return string
     */
    public function hash(string $password);
}
