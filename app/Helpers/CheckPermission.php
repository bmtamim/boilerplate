<?php

use Illuminate\Support\Facades\Auth;

if ( ! function_exists('CheckPermission')) {


    function checkPermission($permission): bool
    {
        if (Auth::check() && Auth::user()->can($permission)) {
            return true;
        }

        return abort(403, __('Sorry, You are not allowed!'));
    }

    function checkPermissionApi($permission): bool
    {
        if (Auth::check() && Auth::user()->can($permission)) {
            return true;
        }

        return abort(403, __('Sorry, You are not allowed!'));
    }
}
