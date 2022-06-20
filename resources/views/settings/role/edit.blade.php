@extends('layouts.app')
@section('title')
    {{ __('Edit Role') }}
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <form action="{{ route('settings.roles.update',$role->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="display_name">{{ __('Role Name') }}</label>
                            <input type="text" name="display_name" id="display_name"
                                   class="form-control @error('display_name') is-invalid @enderror"
                                   value="{{ old('display_name') ?? $role->display_name ?? '' }}">
                            @error('display_name')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">{{ __('Role Description') }}</label>
                            <input type="text" name="description" id="description"
                                   class="form-control @error('description') is-invalid @enderror"
                                   value="{{ old('description') ?? $role->description ?? '' }}">
                            @error('description')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="permissions-wrap">
                            <h6>Permissions</h6>
                            <div class="table-responsive">
                                <table class="table mb-4">
                                    <caption>List of all permissions</caption>
                                    <tbody>
                                    @foreach($modules as $module_name => $permissions)
                                        <tr>
                                            <td class="text-left">
                                                {{ $module_name ?? '' }}
                                            </td>
                                            <td class="">
                                                <div class="d-flex">
                                                    @foreach($permissions as $permission)
                                                        <div class="px-4">
                                                            <div class="n-chk">
                                                                <label
                                                                    class="new-control new-checkbox new-checkbox-text checkbox-primary">
                                                                    <input type="checkbox"
                                                                           class="new-control-input"
                                                                           name="permissions[]"
                                                                           value="{{ $permission->id }}" {{ (is_array($role_permissions) && in_array($permission->id,$role_permissions)) ? 'checked' : ''  }} >
                                                                    <span class="new-control-indicator"></span><span
                                                                        class="new-chk-content">{{ $permission->display_name ?? '' }}</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @error('permissions')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-save">
                                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                                    <polyline points="17 21 17 13 7 13 7 21"></polyline>
                                    <polyline points="7 3 7 8 15 8"></polyline>
                                </svg>
                                {{ __('Update') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

