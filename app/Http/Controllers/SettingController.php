<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\ProfileRequest;
use App\Models\Currency;
use App\Models\Setting;
use App\Services\FileManagementServices;
use App\Services\FileUploadServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class SettingController extends Controller
{
    public function generalSettingsIndex()
    {
        return view('settings.general');
    }

    public function generalSettingsStore(Request $request)
    {

        $request_data = $request->all();


        if ($request->hasFile('site_logo')) {
            $file                      = $request->file('site_logo');
            $request_data['site_logo'] = (new FileManagementServices())->updateImage($file, get_setting('site_logo'));
        } else {
            $request_data['site_logo'] = get_setting('site_logo');
        }
        if ($request->hasFile('fav_icon')) {
            $file                     = $request->file('fav_icon');
            $request_data['fav_icon'] = (new FileManagementServices())->updateImage($file, get_setting('fav_icon'));
        } else {
            $request_data['fav_icon'] = get_setting('fav_icon');
        }

        try {
            array_walk($request_data, function ($value, $key) {
                if ($key != '_token') {
                    $setting_data = Setting::query()->where(['key' => $key])->first();
                    if ($setting_data) {
                        $setting_data->update(['value' => $value]);
                    } else {
                        Setting::query()->create([
                            'key'   => $key,
                            'value' => $value
                        ]);
                    }

                    Cache::forget($key);
                }
            });
            Session::flash('toast', [
                'type' => 'success',
                'msg'  => __('Settings Updated!'),
            ]);
        } catch (\Exception $e) {
            Session::flash('toast', [
                'type' => 'danger',
                'msg'  => __('Failed To Update General Settings!'),
            ]);
        }

        return redirect()->route('settings.general.index');
    }

    public function profileSettingsIndex()
    {
        return view('settings.profile');
    }

    public function profileSettingsUpdate(ProfileRequest $request, $id)
    {
        $data = $request->validated();

        $profileImage = Auth::user()->image;
        if ($request->hasFile('image')) {
            $file         = $request->file('image');
            $profileImage = (new FileManagementServices())->updateImage($file, Auth::user()->image);
        }
        try {
            Auth::user()->update([
                'name'    => $data['name'],
                'email'   => $data['email'],
                'phone'   => $data['phone'],
                'address' => $data['address'],
                'image'   => $profileImage,
            ]);
            Session::flash('toast', [
                'type' => 'success',
                'msg'  => __('Profile Updated!'),
            ]);
        } catch (\Exception $e) {
            Session::flash('toast', [
                'type' => 'danger',
                'msg'  => __('Failed To Update Profile!'),
            ]);
        }

        return redirect()->route('settings.profile.index');
    }

    public function passwordView()
    {
        return view('settings.password');
    }

    public function passwordChange(PasswordRequest $request)
    {
        if ( ! Hash::check($request->current_password, Auth::user()->getAuthPassword())) {
            throw ValidationException::withMessages([
                'current_password' => 'The Password is incorrect',
            ]);
        }
        try {
            Auth::user()->update([
                'password' => Hash::make($request->new_password),
            ]);
            Session::flash('toast', [
                'type' => 'success',
                'msg'  => 'Password Updated'
            ]);
        } catch (\Exception $e) {
            Session::flash('toast', [
                'type' => 'danger',
                'msg'  => 'Failed To Password Profile!',
            ]);
        }

        return redirect()->route('settings.password.view');
    }
}
