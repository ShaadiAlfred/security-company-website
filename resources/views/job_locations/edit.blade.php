@extends('layouts.main')

@push('breadcrumb')
    <li class="breadcrumb-item">
        <a href="javascript:void(0)">
            @lang('Manage Job Locations')
        </a>
    </li>

    <li class="breadcrumb-item active">
        @lang('Edit Job Location')
    </li>
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        @lang('Edit Job Location')
                    </h4>
                    <form action="{{ route('job_locations.update', $jobLocation->id) }}" method="POST" class="mt-4">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">
                                @lang('Name')
                            </label>
                            <input name="name" type="name" class="form-control @error('name') is-invalid @enderror"
                                   value="{{ $jobLocation->name }}" required id="name" placeholder="@lang('Name')">
                            @error('name')
                                <small class="form-control-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="hourly_wage">
                                @lang('Hourly Wage')
                            </label>
                            <input name="hourly_wage" type="number" max="9999.99" step="any"
                                   class="form-control @error('hourly_wage') is-invalid @enderror"
                                   value="{{ $jobLocation->hourly_wage }}" id="hourly_wage" required
                                   placeholder="@lang('Enter hourly wage of this location')">
                            @error('hourly_wage')
                                <small class="form-control-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">
                            @lang('Update Job Location')
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('javascript')
    @if (session()->has('success'))
        <x-toast-container>
            <x-toast.success message="{{ session('success') }}" automaticTrigger="true" />
        </x-toast-container>
    @endif
@endpush
