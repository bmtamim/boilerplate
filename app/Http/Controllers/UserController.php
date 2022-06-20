<?php

namespace App\Http\Controllers;

use App\Actions\UserCreateAction;
use App\Actions\UserUpdateAction;
use App\DTO\UserDTO;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{

    public function index()
    {
        checkPermission('user_view');
        $users = User::query()->latest('created_at')->get();

        return view('user.index', compact('users'));
    }

    public function create()
    {
        checkPermission('user_create');

        return view('user.create');
    }

    public function store(UserRequest $request, UserCreateAction $action)
    {
        checkPermission('user_create');

        try {
            $action(UserDTO::create($request));
            Session::flash('toast', [
                'type' => 'success',
                'msg'  => __('User Created!'),
            ]);
        } catch (\Exception $e) {
            Session::flash('toast', [
                'type' => 'danger',
                'msg'  => __('Failed To Create User!'),
            ]);
        }

        return redirect()->route('users.index');
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        checkPermission('user_edit');
        $user = User::query()->findOrFail($id);

        return view('user.edit', compact('user'));
    }


    public function update(UserRequest $request, $id, UserUpdateAction $action)
    {
        checkPermission('user_edit');
        $user = User::query()->findOrFail($id);
        try {
            $action(UserDTO::create($request, $user), $user);
            Session::flash('toast', [
                'type' => 'success',
                'msg'  => __('User Updated!'),
            ]);
        } catch (\Exception $e) {
            Session::flash('toast', [
                'type' => 'danger',
                'msg'  => __('Failed To Update User!'),
            ]);
        }

        return redirect()->route('users.edit', $user->id);
    }

    public function destroy($id)
    {
        checkPermission('user_delete');
        $user = User::query()->findOrFail($id);
        try {
            if ( ! $user->is_deletable) {
                throw new \Exception();
            }
            $user->delete();
            Session::flash('toast', [
                'type' => 'success',
                'msg'  => __('User Deleted!'),
            ]);
        } catch (\Exception $e) {
            Session::flash('toast', [
                'type' => 'danger',
                'msg'  => __('Failed To Delete User!'),
            ]);
        }

        return redirect()->route('users.index');
    }
}
