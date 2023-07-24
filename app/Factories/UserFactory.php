<?php

namespace App\Factories;

use App\Models\User;

class UserFactory
{
    public function create($data)
    {
        return new User([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
    }
}