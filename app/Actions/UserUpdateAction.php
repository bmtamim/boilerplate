<?php

namespace App\Actions;

use App\DTO\UserDTO;
use App\Http\Requests\UserRequest;

class UserUpdateAction
{
    public function __invoke(UserDTO $DTO, $user)
    {
        $user->update($DTO->toArray());
        if ($DTO->role) {
            $user->syncRoles($DTO->role);
        }
    }
}
