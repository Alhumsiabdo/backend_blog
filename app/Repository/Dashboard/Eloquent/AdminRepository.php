<?php

namespace App\Repository\Dashboard\Eloquent;

use App\Models\User;
use App\Repository\Dashboard\AdminRepositoryInterface;

class AdminRepository implements AdminRepositoryInterface
{
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }
    public function all()
    {
        return $this->model->where('role', 'admin')->get();
    }

    public function find($id)
    {
        return $this->model->where('role', 'admin')->where('id', $id)->first();
    }


    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $user = $this->model->find($id);
        if ($user) {
            $user->update($data);
            return $user;
        }

        return null;
    }

    public function delete($id)
    {
        $user = $this->model->find($id);
        if ($user) {
            $user->delete();
            return true;
        }

        return false;
    }
}
