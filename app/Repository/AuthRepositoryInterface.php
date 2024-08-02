<?php

namespace App\Repository;

interface AuthRepositoryInterface
{

    public function register(array $userData);

    public function login(array $credentials);

    public function logout();
}
