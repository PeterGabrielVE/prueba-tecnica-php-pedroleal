<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function getAll()
    {
        return User::all();
    }

    public function getById($id)
    {
        return User::findOrFail($id);
    }

    public function create($data)
    {
        $user = User::create($data);

        if (!$user) {
            throw new \Exception("Error al crear el usuario");
        }

        return $user;
    }

    public function update($id, $data)
    {
        $user = User::findOrFail($id);
        $user->fill($data);
        $user->save();

        return $user;
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);

        return $user->delete();
    }


}