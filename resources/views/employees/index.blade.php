@extends('layouts.main')

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css') }}">
@endpush

@push('breadcrumb')
    <li class="breadcrumb-item">
        <a href="javascript:void(0)">
            @lang('Manage Employees')
        </a>
    </li>

    <li class="breadcrumb-item active">
        @lang('All Employees')
    </li>
@endpush

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">@lang('All Employees')</h4>
                <div class="table-responsive">
                    <table id="table" class="table table-striped">
                        <thead>
                            <tr>
                                <th class="text-nowrap">@lang('Action')</th>
                                <th>@lang('Number')</th>
                                <th>@lang('Profile Picture')</th>
                                <th>@lang('Name')</th>
                                <th>@lang('National ID')</th>
                                <th>@lang('Address')</th>
                                <th>@lang('Phone')</th>
                                <th>@lang('Age')</th>
                                <th>@lang('Notes')</th>
                                <th>@lang('Job Location')</th>
                                <th>@lang('Job Shift')</th>
                                <th>@lang('Section')</th>
                                <th>@lang('3ohda')</th>
                                <th>@lang('Hired On')</th>
                                <th>@lang('Status')</th>
                                <th>@lang('Kashf Amny')</th>
                                <th>@lang('No3 El Mo5alfa')</th>
                                <th>@lang('Pants')</th>
                                <th>@lang('Summer T-shirt')</th>
                                <th>@lang('Winter T-shirt')</th>
                                <th>@lang('Eish')</th>
                                <th>@lang('Jacket')</th>
                                <th>@lang('Shoes')</th>
                                <th>@lang('Vest')</th>
                                <th>@lang('Donk')</th>
                                <th>@lang('Notes 2')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employees as $employee)
                                <tr>
                                    <td>
                                        <div class="button-group">
                                            <a href="{{ route('employees.edit', $employee) }}"
                                            class="btn waves-effect waves-light btn-info">
                                                @lang('Edit')
                                            </a>
                                            <button employee-id="{{ $employee->id }}" type="button"
                                                    class="btn waves-effect waves-light btn-cyan update-employee">
                                                @lang('Update')
                                            </button>
                                            <button employee-id="{{ $employee->id }}" type="button"
                                                    class="btn waves-effect waves-light btn-danger delete-employee">
                                                @lang('Delete')
                                            </button>
                                        </div>
                                    </td>
                                    <td>{{ $employee->number }}</td>
                                    <td>
                                        <div>
                                            <div class="profile-picture-container">
                                                <img src="{{ asset($employee->getPicturePath()) }}"
                                                     class="profile-picture" />
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $employee->name }}</td>
                                    <td>{{ $employee->national_id }}</td>
                                    <td>{{ $employee->address }}</td>
                                    <td>{{ $employee->phone }}</td>
                                    <td>{{ $employee->age }}</td>
                                    <td>{{ $employee->notes }}</td>
                                    <td
                                        data-id="{{ $employee->job_location->id }}"
                                    >{{ $employee->job_location->name }}</td>
                                    <td
                                        data-id="{{ $employee->job_shift->id }}"
                                    >{{ $employee->job_shift->name }}</td>
                                    <td>{{ $employee->section }}</td>
                                    <td>{{ $employee['3ohda'] }}</td>
                                    <td>{{ $employee->hired_on }}</td>
                                    <td>{{ $employee->status }}</td>
                                    <td>{{ $employee->kashf_amny }}</td>
                                    <td>{{ $employee->no3_el_mo5alfa }}</td>
                                    <td>{{ $employee->pants }}</td>
                                    <td>{{ $employee->summer_t_shirt }}</td>
                                    <td>{{ $employee->winter_t_shirt }}</td>
                                    <td>{{ $employee->eish }}</td>
                                    <td>{{ $employee->jacket }}</td>
                                    <td>{{ $employee->shoes }}</td>
                                    <td>{{ $employee->vest }}</td>
                                    <td>{{ $employee->donk }}</td>
                                    <td>{{ $employee->notes_2 }}</td>
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
    <!-- Editable Table -->
    <script src="{{ asset('assets/node_modules/tiny-editable/mindmup-editabletable.min.js') }}"></script>
    <!-- DataTables -->
    <script src="{{ asset('/assets/node_modules/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/assets/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js') }}"></script>
    <!-- DataTables date sorting -->
    <script src="{{ asset('/js/date_sorting_datatables.js') }}" type="text/javascript"></script>

    <x-toast-container>
        <x-toast.success message="Employee was deleted successfully!" />
        <x-toast.success_with_message />
        <x-toast.error_with_message />
    </x-toast-container>

    <script type="text/javascript">
        function getData($row) {
            const $tds = $row.children('td');

            const employeeData = {
                number: 1,
                name: 3,
                national_id: 4,
                address: 5,
                phone: 6,
                age: 7,
                notes: 8,
                section: 11,
                '3ohda': 12,
                hired_on: 13,
                status: 14,
                kashf_amny: 15,
                no3_el_mo5alfa: 16,
                pants: 17,
                summer_t_shirt: 18,
                winter_t_shirt: 19,
                eish: 20,
                jacket: 21,
                shoes: 22,
                vest: 23,
                donk: 24,
                notes_2: 25
            };

            const employeeRelationships = {
                job_location_id: 9,
                job_shift_id: 10,
            };

            const data = {};

            for (const employeeDataKey in employeeData) {
                const columnIndex = employeeData[employeeDataKey];
                data[employeeDataKey] = $tds.eq(columnIndex).text();
            }

            for (const employeeRelationshipKey in employeeRelationships) {
                const columnIndex = employeeRelationships[employeeRelationshipKey];
                data[employeeRelationshipKey] = $tds.eq(columnIndex).data('id');
            }

            return data;
        }
    </script>

    <script type="text/javascript">
        $(document).ready(() => {
            $.fn.dataTable.moment('D/M/Y', 11);

            // DataTables init
            const table = $('#table').DataTable({
                order: [],
                columnDefs: [
                    {
                        targets: 0,
                        orderable: false
                    }
                ],
                @if(app()->getLocale() === 'ar')
                    language: {
                        url: '{{ asset('/js/datatables_ar.json') }}'
                    }
                @endif
            });

            $('.btn.delete-employee').on('click', function () {
                const employeeId = $(this).attr('employee-id');

                if (confirm('@lang('Are you sure you want to delete this employee?')')) {
                    $.ajax('{{ route('employees.destroy', '') }}/' + employeeId, {
                        method: 'DELETE',
                        data: {
                            employeeId
                        },
                        success: () => {
                            showSuccess();
                            $(this).parents('tr').remove();
                        },
                        error: () => {
                            showError('لا يمكن حذف هذا الموظف قبل حذف سجلات حضوره!')
                        }
                    });
                }
            });

            $('.btn.update-employee').on('click', function () {
                const employeeId = $(this).attr('employee-id');

                const data = getData($(this).parents('tr'));

                $.ajax('{{ route('employees.api.update', '') }}/' + employeeId, {
                    method: 'PUT',
                    data,
                    success: (data) => {
                        showSuccessWithMessage(data.success);
                    },
                    error: (xhr, ajaxOptions, thrownError) => {
                        const errors = xhr.responseJSON.errors;

                        let delay = 0;

                        for (const error in errors) {
                            let errorMessage = errors[error][0];

                            errorMessage = errorMessage.replace(/d\/m\/Y/, 'سنة/شهر/يوم');

                            setTimeout(showError.bind(this, errorMessage), delay);
                            delay += 1000;
                        }
                    }
                })
            });

            $('#table').editableTableWidget({
                disabledColumns: [0, 2],
                selectboxOptions: {
                    9: [
                        @foreach($jobLocations as $jobLocation)
                            {
                                value: '{{ $jobLocation->id }}',
                                text: '{{ $jobLocation->name }}'
                            },
                        @endforeach
                    ],
                    10: [
                        @foreach($jobShifts as $jobShift)
                            {
                                value: '{{ $jobShift->id }}',
                                text: '{{ $jobShift->name }}'
                            },
                        @endforeach
                    ]
                }
            });
        });
    </script>
@endpush
