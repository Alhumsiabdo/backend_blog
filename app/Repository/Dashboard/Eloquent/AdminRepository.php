<?php

namespace App\Repository\Dashboard\Eloquent;

use App\Models\User;
use App\Repository\Dashboard\AdminRepositoryInterface;

class AdminRepository extends BaseRepository implements AdminRepositoryInterface
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    /**
     * Create a new admin with a default role of 'admin'
     *
     * @param array $data
     * @return User
     */
    public function create(array $data)
    {
        // Ensure the 'role' is set to 'admin'
        $data['role'] = 'admin';

        // Hash the password if it's provided
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        // Create and return the new admin user
        return $this->model->create($data);
    }
}
