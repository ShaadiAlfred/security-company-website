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
                                <th>@lang('Id')</th>
                                <th>@lang('Name')</th>
                                <th>@lang('National ID')</th>
                                <th>@lang('Address')</th>
                                <th>@lang('Phone')</th>
                                <th>@lang('Age')</th>
                                <th>@lang('Notes')</th>
                                <th>@lang('Job Location')</th>
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
                                            <a href="{{ route('employees.edit', $employee->id) }}"
                                            class="btn waves-effect waves-light btn-info">
                                                @lang('Edit')
                                            </a>
                                            <button employee-id="{{ $employee->id }}" type="button"
                                                    class="btn waves-effect waves-light btn-danger delete-employee">
                                                @lang('Delete')
                                            </button>
                                        </div>
                                    </td>
                                    <td>{{ $employee->id }}</td>
                                    <td>{{ $employee->name }}</td>
                                    <td>{{ $employee->national_id }}</td>
                                    <td>{{ $employee->address }}</td>
                                    <td>{{ $employee->phone }}</td>
                                    <td>{{ $employee->age }}</td>
                                    <td>{{ $employee->notes }}</td>
                                    <td>{{ $employee->job_location }}</td>
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

    <!-- DataTables -->
    <script src="{{ asset('/assets/node_modules/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/assets/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js') }}"></script>
    <!-- DataTables date sorting -->
    <script src="{{ asset('/js/date_sorting_datatables.js') }}" type="text/javascript"></script>

    <x-toast-container>
        <x-toast.success message="Employee was deleted successfully!" />
    </x-toast-container>

    <script type="text/javascript">
        $(document).ready(() => {

            $.fn.dataTable.moment('D/M/Y', 11);

            // DataTables init
            const table = $('#table').DataTable({
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
                        }
                    });
                }
            });
        });
    </script>
@endpush
