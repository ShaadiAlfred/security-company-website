@extends('layouts.main')

@push('breadcrumb')
    <li class="breadcrumb-item">
        <a href="javascript:void(0)">
            @lang('Manage Job Locations')
        </a>
    </li>

    <li class="breadcrumb-item active">
        @lang('All Job Locations')
    </li>
@endpush

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">@lang('All Job Locations')</h4>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>@lang('Id')</th>
                                <th>@lang('Name')</th>
                                <th>@lang('Hourly Wage')</th>
                                <th class="text-nowrap">@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jobLocations as $id => $location)
                                <tr>
                                    <td>{{ ++$id }}</td>
                                    <td>{{ $location->name }}</td>
                                    <td>{{ $location->hourly_wage }}</td>
                                    <td>
                                        <div class="button-group">
                                            <a href="{{ route('job_locations.edit', $location->id) }}"
                                            class="btn waves-effect waves-light btn-info">
                                                @lang('Edit')
                                            </a>
                                            <button job-location-id="{{ $location->id }}" type="button"
                                                    class="btn waves-effect waves-light btn-danger delete-job-location">
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
    <x-toast.success message="Job location was deleted successfully!" />

    <script type="text/javascript">
        $(document).ready(() => {
            $('.btn.delete-job-location').on('click', function () {
                const jobLocationId = $(this).attr('job-location-id');

                $.ajax('{{ route('job_locations.destroy', '') }}/' + jobLocationId, {
                    method: 'DELETE',
                    data: {
                       jobLocationId
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
