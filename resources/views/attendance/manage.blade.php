@extends('layouts.main')

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css') }}">
    <!-- Date picker plugins css -->
    <link href="{{ asset('assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
    <style type="text/css" media="screen">
        table tbody td:last-child {
            direction: ltr
        }
        table tbody td {
            vertical-align: middle !important;
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
                <div class="row">
                    <div class="col-4 ml-auto">
                        <div class="input-group">
                            <input id="datepicker" name="datepicker" type="text"
                                   class="form-control" placeholder="MM-YYYY">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="icon-calender"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-2 mr-auto">
                        <div class="input-group">
                            <a role="button"
                               href="{{ route('moderators.download_attendance') . '?date=' . request()->date }}"
                               class="btn waves-effect waves-light btn-outline-success">
                                @lang('Download')
                            </a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="table" class="table table-striped">
                        <thead>
                            <tr>
                                <th>@lang('#')</th>
                                <th>@lang('Employee Number')</th>
                                <th>@lang('Attendance')</th>
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
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $attendanceRecord->employee->number }}</td>
                                    <td>
                                        {{ $attendanceRecord->is_present ? __('Present') : __('Absent') }}
                                    </td>
                                    <td>
                                        <a href="{{ route('employees.edit', $attendanceRecord->employee) }}">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset($attendanceRecord->employee->getPicturePath()) }}"
                                                     class="employee-profile-picture" />
                                                {{ $attendanceRecord->employee->name }}
                                            </div>
                                        </a>
                                    </td>
                                    <td>{{ $attendanceRecord->note }}</td>
                                    <td>
                                        <a href="{{ route('moderators.show', $attendanceRecord->submittedBy) }}">
                                            {{ $attendanceRecord->submittedBy->name }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ $attendanceRecord->googleMapsLink() }}"
                                           target="_blank">
                                            {{ $attendanceRecord->submitted_from }}
                                        </a>
                                    </td>
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
    <!-- Date Picker Plugin JavaScript -->
    <script src="{{ asset('assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    @if(app()->getLocale() === 'ar')
        <script src="{{ asset('js/bootstrap-datepicker-ar.js') }}"></script>
    @endif

    <script type="text/javascript">
        $(document).ready(() => {
            $.fn.dataTable.moment('hh:mm A - DD/MM/YYYY', 5);

            // DataTables init
            const table = $('#table').DataTable({
                ordering: true,
                order: [],
                @if(app()->getLocale() === 'ar')
                    language: {
                        url: '{{ asset('/js/datatables_ar.json') }}'
                    }
                @endif
            });


            // Date picker init
            const datePicker = $('#datepicker').datepicker({
                format: 'mm-yyyy',
                immediateUpdates: true,
                minViewMode: 1,
                maxViewMode: 3,
                autoclose: true,
                title: '@lang('Show attendance for')',
                @if(app()->getLocale() === 'ar')
                    language: 'ar',
                @endif
            });

            @if(request()->has('date'))
                $('#datepicker')
                    .datepicker('setDate', moment('{{ request()->date }}', 'MM-YYYY')
                    .startOf('month')
                    .format('MM-YYYY'));
            @endif

            $('#datepicker').datepicker()
                .on('changeDate', function(e) {
                    const date = moment(e.date).format('MM-YYYY');
                    const url = `{{ route('moderators.manage_attendance') }}?date=${date}`;
                    window.location.replace(url);
                });
        });
    </script>
@endpush
