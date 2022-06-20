@extends('layouts.app')
@section('title')

@endsection
@push('styles')
    <link href="{{ asset('dashboard/plugins/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('dashboard/assets/css/dashboard/dash_1.css') }}" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
    <div class="row">
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">

        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('dashboard/plugins/apex/apexcharts.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/dashboard/dash_1.js') }}"></script>
@endpush
