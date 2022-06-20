@extends('layouts.app')
@section('title')
    {{ __('Orders') }}
@endsection
@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/plugins/table/datatable/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/plugins/table/datatable/dt-global_style.css') }}">
@endpush
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h5>{{ __('Orders') }}</h5>
                        </div>
                        <div class="col-6 text-right">
                            <a href="{{ route('orders.create') }}"
                               class="btn btn-primary">{{ __('Add Order') }}</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="orders-table" class="table dt-table-hover" style="width:100%">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Created AT</th>
                            <th class="no-content">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{ '#'.$order->id ?? '' }}</td>
                                <td>{{ $order->title ?? '' }}</td>
                                <td>{{ $order->amount ?? '' }}</td>
                                <td>
                                    @if($order->status === 'pending')
                                        <span class="badge badge-warning">{{ __('Pending Payment') }}</span>
                                    @elseif($order->status === 'complete')
                                        <span class="badge badge-success">{{ __('Complete') }}</span>
                                    @endif
                                </td>

                                <td>{{ $order->created_at ? $order->created_at->format('d-m-Y h:i a') : '' }}</td>
                                <td>
                                    <a href="{{ route('orders.edit',$order->id) }}"
                                       class="text-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                             stroke-linecap="round" stroke-linejoin="round"
                                             class="feather feather-edit table-sm">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Created AT</th>
                            <th class="no-content">Actions</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('dashboard/plugins/table/datatable/datatables.js') }}"></script>
{{--    <script src="{{ asset('dashboard/plugins/sweetalerts/sweetalert2.min.js') }}"></script>--}}
    <script>
        $('#orders-table').DataTable({
            "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
                "<'table-responsive'tr>" +
                "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
            "oLanguage": {
                "oPaginate": {
                    "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                    "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
                },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
                "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [20, 50, 100],
            "pageLength": 20,
            "ordering": false
        });


    </script>
@endpush
