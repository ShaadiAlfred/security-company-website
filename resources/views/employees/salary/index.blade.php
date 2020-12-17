@extends('layouts.main')

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css') }}">
    <!-- Date picker plugins css -->
    <link href="{{ asset('assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('breadcrumb')
    <li class="breadcrumb-item">
        <a href="javascript:void(0)">
            @lang('Manage Employees')
        </a>
    </li>

    <li class="breadcrumb-item active">
        {{ $pageTitle }}
    </li>
@endpush

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    {{ $pageTitle }}
                </h4>
                <div class="row">
                    <div class="col-6 mx-auto">
                        <div class="input-group">
                            <input id="datepicker" name="datepicker" type="text" class="form-control" placeholder="MM-YYYY">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="icon-calender"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="table" class="table table-striped">
                        <thead>
                            <tr>
                                <th>@lang('#')</th>
                                <th>@lang('Number')</th>
                                <th>@lang('Profile Picture')</th>
                                <th>@lang('Name')</th>
                                <th>@lang('Job Location')</th>
                                <th>@lang('Salary')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employees as $employee)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        {{ $employee->number }}
                                    </td>
                                    <td>
                                        <div>
                                            <img src="{{ asset($employee->getPicturePath()) }}"
                                                 class="profile-picture" />
                                        </div>
                                    </td>
                                    <td>{{ $employee->name }}</td>
                                    <td>{{ $employee->job_location->name }}</td>
                                    <td>{{ $employee->salary }}</td>
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
    <script src="{{ asset('assets/node_modules/moment/moment.js') }}" type="text/javascript"></script>

    <!-- DataTables -->
    <script src="{{ asset('assets/node_modules/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js') }}"></script>
    <!-- Date Picker Plugin JavaScript -->
    <script src="{{ asset('assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    @if(app()->getLocale() === 'ar')
        <script src="{{ asset('js/bootstrap-datepicker-ar.js') }}"></script>
    @endif

    <script type="text/javascript">
        $(document).ready(() => {
            // DataTables init
            const table = $('#table').DataTable({
                order: [],
                columnDefs: [
                    {
                        targets: 2,
                        orderable: false
                    }
                ],
                @if(app()->getLocale() === 'ar')
                    language: {
                        url: '{{ asset('js/datatables_ar.json') }}'
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
                title: '@lang('Salary for this month')',
                @if(app()->getLocale() === 'ar')
                    language: 'ar',
                @endif
            });

            @if(request()->has('date'))
                $('#datepicker')
                    .datepicker('setDate', moment('{{ request()->date }}', 'MM-YYYY')
                    .startOf('month')
                    .format('MM-YYYY'));
            @else
                $('#datepicker').datepicker('setDate', moment().startOf('month').format('MM-YYYY'));
            @endif

            $('#datepicker').datepicker()
                .on('changeDate', function(e) {
                    const date = moment(e.date).format('MM-YYYY');
                    const url = `{{ route('employees.salary.index') }}?date=${date}`;
                    window.location.replace(url);
                });

        });
    </script>
@endpush
