<?php

use App\Models\Currency;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Models\Role;

if (!function_exists('get_currency')) {

    function get_currency()
    {
        return Cache::rememberForever('currency_data', function () {
            $currency_code = get_setting('currency');
            $currency      = Currency::query()->select(['id', 'name', 'symbol', 'position', 'code'])->where(['code' => $currency_code])->first();
            if ($currency) {
                return $currency;
            }
            return collect();
        });
    }
}

if (!function_exists('get_roles')) {

    function get_roles(bool $super_admin = false)
    {
        return Cache::rememberForever('roles_list', function () {
            $roles = Role::query()->where('name', '!=', 'super_admin')->get();
            if ($roles) {
                return $roles;
            }
            return collect();
        });
    }
}
