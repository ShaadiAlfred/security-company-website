@extends('layouts.main')

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css') }}">
    <style type="text/css" media="screen">
        table tbody td:last-child {
            direction: ltr
        }
    </style>
@endpush

@push('breadcrumb')
    <li class="breadcrumb-item">
        <a href="javascript:void(0)">
            @lang('Manage Moderators')
        </a>
    </li>

    <li class="breadcrumb-item active">
        @lang('Manage Attendance')
    </li>
@endpush

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">@lang('Manage Attendance')</h4>
                <div class="table-responsive">
                    <table id="table" class="table table-striped">
                        <thead>
                            <tr>
                                <th>@lang('Id')</th>
                                <th>@lang('Employee')</th>
                                <th>@lang('Note')</th>
                                <th>@lang('Submitted By')</th>
                                <th>@lang('Submitted From')</th>
                                <th>@lang('Submitted At')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($attendanceRecords as $attendanceRecord)
                                <tr>
                                    <td>{{ $attendanceRecord->id }}</td>
                                    <td>{{ $attendanceRecord->employee->name }}</td>
                                    <td>{{ $attendanceRecord->note }}</td>
                                    <td>{{ $attendanceRecord->submittedBy->name }}</td>
                                    <td>{{ $attendanceRecord->submitted_from }}</td>
                                    <td>{{ $attendanceRecord->created_at->format('h:i A - d/m/Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('javascript')
    <!-- MomentsJS -->
    <script src="{{ asset('/assets/node_modules/moment/moment.js') }}" type="text/javascript"></script>

    <!-- DataTables -->
    <script src="{{ asset('/assets/node_modules/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/assets/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js') }}"></script>
    <!-- DataTables date sorting -->
    <script src="{{ asset('/js/date_sorting_datatables.js') }}" type="text/javascript"></script>

    <script type="text/javascript">
        $(document).ready(() => {
            $.fn.dataTable.moment('hh:mm A - DD/MM/YYYY', 5);

            // DataTables init
            const table = $('#table').DataTable({
                @if(app()->getLocale() === 'ar')
                    language: {
                        url: '{{ asset('/js/datatables_ar.json') }}'
                    }
                @endif
            });
        });
    </script>
@endpush
