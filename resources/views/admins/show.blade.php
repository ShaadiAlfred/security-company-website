@extends('layouts.main')

@push('breadcrumb')
<li class="breadcrumb-item">
    <a href="javascript:void(0)">
        @lang('Manage Admins')
    </a>
</li>

<li class="breadcrumb-item active">
    {{ $admin->name }}
</li>
@endpush

@section('content')
    <div class="row">
        <div class="col-lg-4 col-xlg-3 col-md-5">
            <div class="card">
                <div class="card-body">
                    <center class="m-t-30">
                        <img src="{{ asset('storage/profile-pictures/default.png') }}" class="img-circle" width="150">
                        <h4 class="card-title m-t-10">
                            {{ $admin->name }}
                        </h4>
                        <h6 class="card-subtitle">
                            {{ $admin->role->name }}
                        </h6>
                        <div class="row text-center justify-content-md-center">
                            <div class="col-4">
                                <a href="javascript:void(0)" class="link">
                                    <i class="icon-people"></i>
                                    <font class="font-medium">
                                        {{ $admin->attendance->count() }}
                                    </font>
                                </a>
                            </div>
                        </div>
                    </center>
                </div>
                <div>
                    <hr>
                </div>
                <div class="card-body">
                    <small class="text-muted">@lang('E-Mail Address') </small>
                    <h6>{{ $admin->email }}</h6>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-8 col-xlg-9 col-md-7">
            <div class="card">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs profile-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#attendance" role="tab">
                            @lang('Attendance')
                        </a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="attendance" role="tabpanel">
                        <div class="card-body">
                            <div class="profiletimeline">
                                @foreach($admin->attendance->sortByDesc('created_at')->take(5) as $attendance)
                                    <div class="sl-item">
                                        <div class="sl-left">
                                            <img src="{{ asset('storage/profile-pictures/default.png') }}"
                                                 alt="user" class="img-circle">
                                        </div>
                                        <div class="sl-right">
                                            <div>
                                                <a href="javascript:void(0)" class="link">
                                                    {{ $attendance->employee->name }}
                                                </a>
                                                <span class="sl-date">
                                                    {{ $attendance->created_at->diffForHumans() }}
                                                </span>
                                            </div>
                                            <br />
                                            <div>
                                                <div class="row">
                                                    <p>
                                                        @lang('Note'): {{ $attendance->note }}
                                                    </p>
                                                </div>
                                                <div class="row">
                                                    <p>
                                                        @lang('Submitted From'):&nbsp;
                                                        <a href="{{ $attendance->googleMapsLink() }}">
                                                            {{ $attendance->submitted_from }}
                                                        </a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
