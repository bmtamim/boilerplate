<?php

namespace App\DTO;

use App\Http\Requests\CustomerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\DataTransferObject\DataTransferObject;

class CustomerDTO extends DataTransferObject
{
    public string $name;
    public string $email;
    public ?string $phone;
    public ?string $address;
    public string $password;
    public string $status;


    public static function create(CustomerRequest $request): CustomerDTO
    {
        return new self([
            'name'     => $request->input('name'),
            'email'    => $request->input('email'),
            'phone'    => $request->input('phone'),
            'address'  => $request->input('address'),
            'password' => Hash::make(Str::random('10')),
            'status'   => true,
        ]);
    }

    public function toArray(): array
    {
        return [
            'name'     => $this->name,
            'email'    => $this->email,
            'phone'    => $this->phone,
            'address'  => $this->address,
            'password' => $this->password,
            'status'   => $this->status,
        ];
    }
}
