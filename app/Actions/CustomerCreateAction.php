<?php

namespace App\Actions;

use App\DTO\CustomerDTO;
use App\Models\User;

class CustomerCreateAction
{
    public function __invoke(CustomerDTO $DTO)
    {
        $user = User::query()->create($DTO->toArray());
        $user?->assignRole('customer');
    }
}
