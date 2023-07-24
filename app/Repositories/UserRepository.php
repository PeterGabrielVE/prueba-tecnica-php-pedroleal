<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function create($data)
    {
        $user = User::create($data);

        if (!$user) {
            throw new \Exception("Error al crear el jugador");
        }

        return $user;
    }


}