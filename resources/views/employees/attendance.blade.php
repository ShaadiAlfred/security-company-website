@extends('layouts.main')

@push('stylesheets')
    <!-- select2 -->
    <link rel="stylesheet" href="{{ asset('/css/select2.min.css') }}" type="text/css" media="screen" />
@endpush

@push('breadcrumb')
    <li class="breadcrumb-item">
        <a href="javascript:void(0)">
            @lang('Manage Employees')
        </a>
    </li>

    <li class="breadcrumb-item active">
        @lang('Attendance')
    </li>
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        @lang('Attendance')
                    </h4>
                    <form onsubmit="getCurrentLocation(event)" class="mt-4">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="employee" class="m-t-20">
                                        @lang('Employee')
                                    </label>
                                    <select id="employee" name="employee" required>
                                        @foreach($employees as $employee)
                                            <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="m-t-20">
                                        @lang('Note')
                                    </label>
                                    <input class="form-control" id="note" name="note" placeholder="@lang('Note')"
                                           maxlength="128" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        @lang('Send')
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('javascript')
    <x-toast-container>
        <x-toast.success message="Attendance sent successfully!" />
        <x-toast.error message="Attendance was not sent successfully!" />
    </x-toast-container>

    <!-- select2 -->
    <script src="{{ asset('/js/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('/js/select2/i18n/ar.js') }}"></script>

    <script type="text/javascript">
        async function getCurrentLocation(event) {
            event.preventDefault();

            if (window.navigator.geolocation) {
                console.log('Geolocation is available');
                try {
                    window.navigator.geolocation.getCurrentPosition(submitAttendance, console.error);
                } catch (error) {
                    console.error('Permission Denied By User!');
                }
            } else {
                console.error('Geolocation is not available on this device!');
            }
        }

        function submitAttendance(location) {
            // location.coords.[latitude|longitude]

            const submitAttendanceUrl = '{{ route('employees.submitAttendance') }}';

            const employeeId = $('#employee').val();
            const note = $('#note').val();

            $.ajax({
                method: 'POST',
                url: submitAttendanceUrl,
                data: {
                    employeeId: employeeId,
                    note: note,
                    latitude: location.coords.latitude,
                    longitude: location.coords.longitude,
                },
                success: showSuccess,
                error: showError,
            });
        }

        // Init
        $(document).ready(() => {
            $('#employee').select2({
                @if(app()->getLocale() === 'ar')
                    dir: 'rtl',
                    language: 'ar'
                @endif
            })
        });

    </script>
@endpush
