<?php

namespace App\Repository\Dashboard;

interface AuthRepositoryInterface
{

    public function register(array $userData);

    public function login(array $credentials);

    public function logout();
}
