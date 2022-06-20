<?php

namespace App\Actions;

use App\DTO\UserDTO;
use App\Models\User;
use Illuminate\Http\Request;

class UserCreateAction
{
    public function __invoke(UserDTO $DTO)
    {
        $user = User::create($DTO->toArray());
        if ($DTO->role) {
            $user->assignRole($DTO->role);
        }
    }
}
