<?php

namespace App\Actions;

use App\DTO\CustomerDTO;

class CustomerUpdateAction
{
    public function __invoke(CustomerDTO $DTO, $customer)
    {
        $customer->update($DTO->toArray());
    }
}
