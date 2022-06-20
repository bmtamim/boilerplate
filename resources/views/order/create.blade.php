@extends('layouts.app')
@section('title')
    {{ __('New Order') }}
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/flatpickr/flatpickr.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/flatpickr/custom-flatpickr.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/bootstrap-select/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/apps/invoice-add.css') }}">
    @livewireStyles
@endpush
@section('content')
    <livewire:create-order/>
@endsection
@push('scripts')
    <script src="{{ asset('dashboard/plugins/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>

    <script>
        let delivery_date = document.getElementById('delivery_date');
        if (delivery_date) {
            f1 = flatpickr(delivery_date, {
                dateFormat: 'd-m-Y',
            });
        }
    </script>
    @livewireScripts
@endpush
