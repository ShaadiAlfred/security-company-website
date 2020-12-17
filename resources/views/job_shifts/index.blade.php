@extends('layouts.main')

@push('breadcrumb')
    <li class="breadcrumb-item">
        <a href="javascript:void(0)">
            @lang('Manage Job Shifts')
        </a>
    </li>

    <li class="breadcrumb-item active">
        @lang('All Job Shifts')
    </li>
@endpush

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">@lang('All Job Shifts')</h4>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>@lang('Id')</th>
                                <th>@lang('Name')</th>
                                <th>@lang('Start')</th>
                                <th>@lang('End')</th>
                                <th class="text-nowrap">@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jobShifts as $jobShift)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $jobShift->name }}</td>
                                    <td>{{ $jobShift->start->format('H:i') }}</td>
                                    <td>{{ $jobShift->end->format('H:i') }}</td>
                                    <td>
                                        <div class="button-group">
                                            <a href="{{ route('job_shifts.edit', $jobShift) }}"
                                            class="btn waves-effect waves-light btn-info">
                                                @lang('Edit')
                                            </a>
                                            <button job-shift-id="{{ $jobShift->id }}" type="button"
                                                    class="btn waves-effect waves-light btn-danger delete-job-shift">
                                                @lang('Delete')
                                            </button>
                                        </div>
                                    </td>
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
    <x-toast-container>
        <x-toast.success message="Job shift was deleted successfully!" />
    </x-toast-container>

    <script type="text/javascript">
        $(document).ready(() => {
            $('.btn.delete-job-shift').on('click', function () {
                const jobShiftId = $(this).attr('job-shift-id');

                $.ajax('{{ route('job_shifts.destroy', '') }}/' + jobShiftId, {
                    method: 'DELETE',
                    data: {
                       jobShiftId
                    },
                    success: () => {
                        showSuccess();
                        $(this).parents('tr').remove();
                    }
                });
            });
        });
    </script>
@endpush
