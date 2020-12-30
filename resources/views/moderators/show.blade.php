@extends('layouts.main')

@push('breadcrumb')
<li class="breadcrumb-item">
    <a href="javascript:void(0)">
        @lang('Manage Moderators')
    </a>
</li>

<li class="breadcrumb-item active">
    {{ $moderator->name }}
</li>
@endpush

@section('content')
    <div class="row">
        <div class="col-lg-4 col-xlg-3 col-md-5">
            <div class="card">
                <div class="card-body">
                    <center class="m-t-30">
                        <img src="{{ asset($moderator->getPicturePath()) }}"
                             class="profile-picture">

                        <h4 class="card-title m-t-10">
                            {{ $moderator->name }}
                        </h4>
                        <h6 class="card-subtitle">
                            {{ $moderator->role->name }}
                        </h6>
                        <div class="row text-center justify-content-md-center">
                            <div class="col-4">
                                <a href="javascript:void(0)" class="link">
                                    <i class="icon-people"></i>
                                    <font class="font-medium">
                                        {{ $moderator->attendance->count() }}
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
                    <h6>{{ $moderator->email }}</h6>
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
                                @foreach($moderator->attendance->sortByDesc('created_at')->take(5) as $attendance)
                                    <div class="sl-item">
                                        <div class="sl-left">
                                            <img src="{{ asset($attendance->employee->getPicturePath()) }}"
                                                alt="user" class="profile-picture"
                                                style="height: 40px; width: 40px;">
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
