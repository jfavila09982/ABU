<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function all()
    {
        return $this->user->all();
    }

    public function find($id)
    {
        return $this->user->find($id);
    }

    public function create(array $data)
    {
        return $this->user->create($data);
    }

    public function update($id, array $data)
    {
        $user = $this->user->find($id);
        if ($user) {
            $user->update($data);

            return $user;
        }

        return null;
    }

    public function delete($id)
    {
        $user = $this->user->find($id);
        if ($user) {
            return $user->delete();
        }

        return false;
    }
}
