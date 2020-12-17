@extends('layouts.main')

@push('stylesheets')
    <!-- Time picker plugins css -->
    <link href="{{ asset('assets/node_modules/clockpicker/dist/jquery-clockpicker.min.css') }}" rel="stylesheet">
    <style type="text/css" media="screen">
        #start, #end {
            cursor: pointer;
            caret-color: transparent;
            user-select: none;
        }
    </style>
@endpush

@push('breadcrumb')
    <li class="breadcrumb-item">
        <a href="javascript:void(0)">
            @lang('Manage Job Shifts')
        </a>
    </li>

    <li class="breadcrumb-item active">
        {{ __($pageTitle) }}
    </li>
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        {{ __($pageTitle) }}
                    </h4>
                    <form action="{{ route('job_shifts.update', $jobShift) }}" method="POST" class="mt-4">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">
                                @lang('Name')
                            </label>
                            <input name="name" type="name" class="form-control @error('name') is-invalid @enderror"
                                   value="{{ $jobShift->name }}" required id="name" placeholder="@lang('Name')">
                            @error('name')
                                <small class="form-control-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="start">
                                        @lang('Start')
                                    </label>
                                    <div class="input-group">
                                        <input id="start" name="start" class="form-control timepicker"
                                               value="{{ $jobShift->start->format('H:i') }}" required />
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                        </div>
                                    </div>
                                    @error('start')
                                        <small class="form-control-feedback">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="end">
                                        @lang('End')
                                    </label>
                                    <div class="input-group">
                                        <input id="end" name="end" class="form-control timepicker"
                                               value="{{ $jobShift->end->format('H:i') }}" required />
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                        </div>
                                    </div>
                                    @error('end')
                                        <small class="form-control-feedback">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            @lang('Update Job Shift')
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('javascript')
    <!-- Clock Plugin JavaScript -->
    <script src="{{ asset('assets/node_modules/clockpicker/dist/jquery-clockpicker.min.js') }}"></script>

    <script>
        // Clock pickers
        $('.timepicker').clockpicker({
            placement: 'bottom',
            align: 'left',
            autoclose: true,
            'default': 'now'
        });
    </script>

    @if (session()->has('success'))
        <x-toast-container>
            <x-toast.success message="{{ session('success') }}" automaticTrigger="true" />
        </x-toast-container>
    @endif
@endpush
