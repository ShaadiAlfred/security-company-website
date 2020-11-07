@extends('layouts.main')

@push('breadcrumb')
    <li class="breadcrumb-item">
        <a href="javascript:void(0)">
            @lang('Manage Moderators')
        </a>
    </li>

    <li class="breadcrumb-item active">
        @lang('Add Moderator')
    </li>
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        @lang('Add Moderator')
                    </h4>
                    <form action="{{ route('moderators.store') }}" method="POST" class="mt-4">
                        @csrf
                        <div class="form-group">
                            <label for="name">
                                @lang('Name')
                            </label>
                            <input name="name" type="name" class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name') }}" required id="name" placeholder="@lang('Name')">
                            @error('name')
                                <small class="form-control-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">
                                @lang('E-Mail Address')
                            </label>
                            <input name="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email') }}" id="email" required aria-describedby="emailHelp"
                                   placeholder="@lang('Enter email address')">
                            @error('email')
                                <small class="form-control-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">
                                @lang('Password')
                            </label>
                            <input name="password" type="password" required id="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   value="{{ old('password') }}" placeholder="@lang('Password')">
                            @error('password')
                                <small class="form-control-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password-confirm">
                                @lang('Password Confirm')
                            </label>
                            <input name="password_confirmation" type="password" class="form-control"
                                   id="password-confirm" placeholder="@lang('Password')" required>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            @lang('Add Moderator')
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
