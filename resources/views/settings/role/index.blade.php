@extends('layouts.app')
@section('title')
    {{ __('Roles') }}
@endsection
@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/plugins/table/datatable/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/plugins/table/datatable/dt-global_style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/plugins/sweetalerts/sweetalert.css') }}">
@endpush
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h5>{{ __('Roles') }}</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="roles" class="table dt-table-hover" style="width:100%">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Permissions</th>
                            <th class="no-content">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <td>{{ $role->display_name ?? '' }}</td>
                                <td>{{ $role->description ?? '' }}</td>
                                <td>
                                    <span class="badge badge-primary">{{ $role->permissions()->count() ?? '' }}</span>
                                </td>
                                <td class="text-center">
                                    @if($role->name != 'super_admin')
                                        <a href="{{ route('settings.roles.edit',$role->id) }}"
                                           class="text-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                 stroke-linecap="round" stroke-linejoin="round"
                                                 class="feather feather-edit table-sm">
                                                <path
                                                    d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                <path
                                                    d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                            </svg>
                                        </a>
{{--                                        <button class="text-danger border-0 bg-transparent"--}}
                                        {{--                                                onclick="event.preventDefault(); deleteData({{ $role->id }})">--}}
                                        {{--                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"--}}
                                        {{--                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"--}}
                                        {{--                                                 stroke-linecap="round" stroke-linejoin="round"--}}
                                        {{--                                                 class="feather feather-trash-2">--}}
                                        {{--                                                <polyline points="3 6 5 6 21 6"></polyline>--}}
                                        {{--                                                <path--}}
                                        {{--                                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>--}}
                                        {{--                                                <line x1="10" y1="11" x2="10" y2="17"></line>--}}
                                        {{--                                                <line x1="14" y1="11" x2="14" y2="17"></line>--}}
                                        {{--                                            </svg>--}}
                                        {{--                                        </button>--}}
                                        {{--                                        <form action="{{ route('settings.roles.destroy',$role->id) }}"--}}
                                        {{--                                              id="delete-data-{{ $role->id }}" method="POST">--}}
                                        {{--                                            @csrf--}}
                                        {{--                                            @method('DELETE')--}}
                                        {{--                                        </form>--}}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Permissions</th>
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
    <script src="{{ asset('dashboard/plugins/sweetalerts/sweetalert2.min.js') }}"></script>
    <script>
        $('#roles').DataTable({
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
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 7,
            "ordering": false
        });

        function deleteData(id) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Delete',
                padding: '1.5em'
            }).then(function (result) {
                if (result.value) {
                    $('#delete-data-' + id).submit();
                }
            })
        }

    </script>
@endpush
