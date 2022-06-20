<?php

namespace App\DTO;

use App\Http\Requests\UserRequest;
use App\Services\FileManagementServices;
use Illuminate\Support\Facades\Hash;
use Spatie\DataTransferObject\DataTransferObject;

class UserDTO extends DataTransferObject
{
    public string $name;
    public string $email;
    public string $phone;
    public ?string $image;
    public bool $status;
    public string $address;
    public ?string $role;
    public ?string $password;

    public static function create(UserRequest $request, $user = null): UserDTO
    {
        $imageName = null;
        if ($request->hasFile('image')) {
            $file      = $request->file('image');
            $imageName = (new FileManagementServices())->updateImage($file, $user ? $user->image : null);
        }

        $data = [
            'name'     => $request->input('name'),
            'email'    => $request->input('email'),
            'phone'    => $request->input('phone'),
            'image'    => $imageName,
            'status'   => $request->filled('status'),
            'address'  => $request->input('address'),
            'role'     => $request->filled('role') ? $request->input('role') : null,
            'password' => $request->filled('password') ? Hash::make($request->input('password')) : null,
        ];

        return new self($data);
    }

    public function toArray(): array
    {
        $data = [
            'name'    => $this->name,
            'email'   => $this->email,
            'phone'   => $this->phone,
            'image'   => $this->image,
            'status'  => $this->status,
            'address' => $this->address,
        ];
        if ($this->password) {
            $data['password'] = $this->password;
        }

        return $data;
    }
}
