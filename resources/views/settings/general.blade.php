@extends('layouts.app')
@section('title')
    General
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/dropify/dropify.min.css') }}">
@endpush
@section('content')
    <div class="card">
        <div class="card-header">
            <h5>General Settings</h5>
            {{ config('app.timezone') }}
        </div>
        <div class="card-body">
            <form action="{{ route('settings.general.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="site_name">{{ __('Site Name') }}</label>
                            <input type="text" name="site_name" id="site_name"
                                   class="form-control @error('site_name') is-invalid @enderror"
                                   value="{{ get_setting('site_name') }}">
                            @error('site_name')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="site_tagline">{{ __('Site Tagline') }}</label>
                            <input type="text" name="site_tagline" id="site_tagline"
                                   class="form-control @error('site_tagline') is-invalid @enderror"
                                   value="{{ get_setting('site_tagline') }}">
                            @error('site_tagline')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-4 col-md-7 col-sm12">
                                <div class="form-group">
                                    <label for="site_logo">{{ __('Site logo') }}</label>
                                    <input type="file" name="site_logo" id="site_logo"
                                           @if(get_setting('site_logo')) data-default-file="{{ asset('storage/upload/'.get_setting('site_logo')) }}" @endif>
                                    @error('site_logo')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                 class="feather feather-save">
                                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                                <polyline points="17 21 17 13 7 13 7 21"></polyline>
                                <polyline points="7 3 7 8 15 8"></polyline>
                            </svg>
                            {{ __('Save') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('dashboard/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/dropify/dropify.min.js') }}"></script>
    <script>
        $('#currency').select2({
            minimumResultsForSearch: Infinity
        });
        $('#timezone').select2({
            minimumResultsForSearch: Infinity
        });
        $('#site_logo').dropify();
    </script>
@endpush
