@extends('layouts.main')

@push('stylesheets')
    <!-- Date picker plugins css -->
    <link href="{{ asset('/assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
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
        @lang('Add Employee')
    </li>
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        @lang('Add Employee')
                    </h4>
                    <form action="{{ route('employees.store') }}" method="POST" class="mt-4"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-8">
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input id="picture"
                                               name="picture"
                                               type="file"
                                               class="custom-file-input @error('picture') is-invalid @enderror"
                                               accept="image/*">
                                        <label class="custom-file-label" for="picture">
                                            @lang('Choose Profile Picture')
                                        </label>
                                        @error('picture')
                                            <small class="form-control-feedback">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row picture-preview d-none">
                            <div class="col">
                                <img id="picture-preview"
                                     class="profile-picture m-t-15 mx-auto"
                                     style="width: 300px; height: 300px;" />
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="number">
                                        @lang('Employee Number')
                                    </label>
                                    <input name="number" type="number" id="number" required
                                           class="form-control @error('number') is-invalid @enderror"
                                           placeholder="@lang('Employee Number')"
                                           value="{{ old('number') }}">
                                    @error('number')
                                        <small class="form-control-feedback">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="name">
                                        @lang('Name')
                                    </label>
                                    <input name="name" type="name" maxlength="64"
                                           class="form-control @error('name') is-invalid @enderror"
                                           required id="name" placeholder="@lang('Name')"
                                           value="{{ old('name') }}">
                                    @error('name')
                                        <small class="form-control-feedback">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="national_id">
                                        @lang('National ID')
                                    </label>
                                    <input name="national_id" type="number" id="national_id" required
                                           class="form-control @error('national_id') is-invalid @enderror"
                                           placeholder="@lang('National ID')" maxlength="64"
                                           value="{{ old('national_id') }}">
                                    @error('national_id')
                                        <small class="form-control-feedback">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label for="address">
                                        @lang('Address')
                                    </label>
                                    <input name="address" type="text"  maxlength="128"
                                           class="form-control @error('address') is-invalid @enderror"
                                           required id="address" placeholder="@lang('Address')"
                                           value="{{ old('address') }}">
                                    @error('address')
                                        <small class="form-control-feedback">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="phone">
                                        @lang('Phone')
                                    </label>
                                    <input name="phone" type="text" id="phone" required maxlength="64"
                                           class="form-control @error('phone') is-invalid @enderror"
                                           placeholder="@lang('Phone')"
                                           value="{{ old('phone') }}">
                                    @error('phone')
                                        <small class="form-control-feedback">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="age">
                                        @lang('Age')
                                    </label>
                                    <input name="age" type="number" max="255"
                                           class="form-control @error('age') is-invalid @enderror" required
                                           id="age" placeholder="@lang('Age')"
                                           value="{{ old('age') }}">
                                    @error('age')
                                        <small class="form-control-feedback">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="notes">
                                        @lang('Notes')
                                    </label>
                                    <input name="notes" type="text" id="notes" maxlength="64"
                                           class="form-control @error('notes') is-invalid @enderror"
                                           placeholder="@lang('Notes')"
                                           value="{{ old('notes') }}">
                                    @error('notes')
                                        <small class="form-control-feedback">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="job_location_id">
                                        @lang('Job Location')
                                    </label>
                                    <select id="job_location_id" name="job_location_id"
                                            class="form-control" required>
                                        @foreach($jobLocations as $jobLocation)
                                            <option value="{{ $jobLocation->id }}">
                                                {{ $jobLocation->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('job_location_id')
                                        <small class="form-control-feedback">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="section">
                                        @lang('Section')
                                    </label>
                                    <input name="section" type="text" id="section" required maxlength="32"
                                           class="form-control @error('section') is-invalid @enderror"
                                           placeholder="@lang('Section')"
                                           value="{{ old('section') }}">
                                    @error('section')
                                        <small class="form-control-feedback">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="hired_on">
                                        @lang('Hired On')
                                    </label>
                                    <div class="input-group">
                                        <input id="hired_on" name="hired_on" type="text" class="form-control
                                               mydatepicker" placeholder="dd/mm/yyyy" required
                                               pattern="\d\d/\d\d/\d\d\d\d"
                                               value="{{ old('hired_on') }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="icon-calender"></i></span>
                                        </div>
                                    </div>
                                    @error('hired_on')
                                        <small class="form-control-feedback">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="status">
                                        @lang('Status')
                                    </label>
                                    <input name="status" type="text" maxlength="1"
                                           class="form-control @error('status') is-invalid @enderror"
                                           id="status" placeholder="@lang('Status')"
                                            value="{{ old('status') }}">
                                    @error('status')
                                        <small class="form-control-feedback">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="3ohda">
                                        @lang('3ohda')
                                    </label>
                                    <input name="3ohda" type="text" id="3ohda" maxlength="16"
                                           class="form-control @error('3ohda') is-invalid @enderror"
                                           placeholder="@lang('3ohda')"
                                            value="{{ old('3ohda') }}">
                                    @error('3ohda')
                                        <small class="form-control-feedback">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="kashf_amny">
                                        @lang('Kashf Amny')
                                    </label>
                                    <input id="kashf_amny" name="kashf_amny" type="text"
                                            class="form-control @error('kashf_amny') is-invalid @enderror"
                                            placeholder="@lang('Kashf Amny')" maxlength="16"
                                            value="{{ old('kashf_amny') }}">
                                    @error('kashf_amny')
                                        <small class="form-control-feedback">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="no3_el_mo5alfa">
                                        @lang('No3 El Mo5alfa')
                                    </label>
                                    <input name="no3_el_mo5alfa" type="text" maxlength="64"
                                           class="form-control @error('no3_el_mo5alfa') is-invalid @enderror"
                                           id="no3_el_mo5alfa" placeholder="@lang('No3 El Mo5alfa')"
                                           value="{{ old('no3_el_mo5alfa') }}">
                                    @error('no3_el_mo5alfa')
                                        <small class="form-control-feedback">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="pants">
                                        @lang('Pants')
                                    </label>
                                    <input name="pants" type="text" maxlength="32"
                                           class="form-control @error('pants') is-invalid @enderror"
                                           id="pants" placeholder="@lang('Pants')"
                                           value="{{ old('pants') }}">
                                    @error('pants')
                                        <small class="form-control-feedback">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="summer_t_shirt">
                                        @lang('Summer T-shirt')
                                    </label>
                                    <input name="summer_t_shirt" type="text" maxlength="32"
                                           class="form-control @error('summer_t_shirt') is-invalid @enderror"
                                           id="summer_t_shirt" placeholder="@lang('Summer T-shirt')"
                                           value="{{ old('summer_t_shirt') }}">
                                    @error('summer_t_shirt')
                                        <small class="form-control-feedback">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="winter_t_shirt">
                                        @lang('Winter T-shirt')
                                    </label>
                                    <input name="winter_t_shirt" type="text" maxlength="32"
                                           class="form-control @error('winter_t_shirt') is-invalid @enderror"
                                           id="winter_t_shirt" placeholder="@lang('Winter T-shirt')"
                                           value="{{ old('winter_t_shirt') }}">
                                    @error('winter_t_shirt')
                                        <small class="form-control-feedback">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="jacket">
                                        @lang('Jacket')
                                    </label>
                                    <input name="jacket" type="text" maxlength="32"
                                           class="form-control @error('jacket') is-invalid @enderror"
                                           id="jacket" placeholder="@lang('Jacket')"
                                           value="{{ old('jacket') }}">
                                    @error('jacket')
                                        <small class="form-control-feedback">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="shoes">
                                        @lang('Shoes')
                                    </label>
                                    <input name="shoes" type="text" maxlength="32"
                                           class="form-control @error('shoes') is-invalid @enderror"
                                           id="shoes" placeholder="@lang('Shoes')"
                                           value="{{ old('shoes') }}">
                                    @error('shoes')
                                        <small class="form-control-feedback">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="vest">
                                        @lang('Vest')
                                    </label>
                                    <input name="vest" type="text" maxlength="32"
                                           class="form-control @error('vest') is-invalid @enderror"
                                           id="vest" placeholder="@lang('Vest')"
                                           value="{{ old('vest') }}">
                                    @error('vest')
                                        <small class="form-control-feedback">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="eish">
                                        @lang('Eish')
                                    </label>
                                    <input name="eish" type="text" maxlength="32"
                                           class="form-control @error('eish') is-invalid @enderror"
                                           id="eish" placeholder="@lang('Eish')"
                                           value="{{ old('eish') }}">
                                    @error('eish')
                                        <small class="form-control-feedback">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="donk">
                                        @lang('Donk')
                                    </label>
                                    <input name="donk" type="text" maxlength="32"
                                           class="form-control @error('donk') is-invalid @enderror"
                                           id="donk" placeholder="@lang('Donk')"
                                           value="{{ old('donk') }}">
                                    @error('donk')
                                        <small class="form-control-feedback">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="notes_2">
                                        @lang('Notes 2')
                                    </label>
                                    <input name="notes_2" type="text" maxlength="32"
                                           class="form-control @error('notes_2') is-invalid @enderror"
                                           id="notes_2" placeholder="@lang('Notes 2')"
                                           value="{{ old('notes_2') }}">
                                    @error('notes_2')
                                        <small class="form-control-feedback">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="job_shift_id">
                                        @lang('Job Shift')
                                    </label>
                                    <select id="job_shift_id" name="job_shift_id"
                                            class="form-control" required>
                                        @foreach($jobShifts as $jobShift)
                                            <option value="{{ $jobShift->id }}">
                                                {{ $jobShift->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('job_shift_id')
                                        <small class="form-control-feedback">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            @lang('Add Employee')
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('javascript')
    <!-- Date picker -->
    <script src="{{ asset('/assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <!-- select2 -->
    <script src="{{ asset('/js/select2/select2.full.min.js') }}"></script>
    @if(app()->getLocale() === 'ar')
        <script src="{{ asset('/js/bootstrap-datepicker-ar.js') }}" type="text/javascript"></script>
        <script src="{{ asset('/js/select2/i18n/ar.js') }}"></script>
    @endif

    <script type="text/javascript">
        function showPicturePreview() {
            const pictureInput            = document.querySelector('#picture');
            const previewElement          = document.querySelector('#picture-preview');
            const picturePreviewContainer = document.querySelector('.picture-preview');

            const fileReader = new FileReader();

            fileReader.onload = (e) => {
                previewElement.src = e.target.result;
            };

            pictureInput.addEventListener('change', () => {
                if (pictureInput.files.length) {
                    picturePreviewContainer.classList.remove('d-none');
                    fileReader.readAsDataURL(pictureInput.files[0]);
                } else {
                    picturePreviewContainer.classList.add('d-none');
                }
            });
        }

        $(document).ready(() => {
            $('.mydatepicker').datepicker({
                autoclose: true,
                format: 'dd/mm/yyyy',
                immediateUpdates: true,
                todayBtn: 'linked',
                orientation: 'bottom',
                @if(app()->getLocale() === 'ar')
                    rtl: true,
                    language: 'ar',
                @endif
            });

            $('.mydatepicker').datepicker('update', new Date);

            $('#job_location_id').select2({
                width: '100%',
                @if(app()->getLocale() === 'ar')
                    dir: 'rtl',
                    language: 'ar'
                @endif
            });

            $('#job_shift_id').select2({
                width: '100%',
                @if(app()->getLocale() === 'ar')
                    dir: 'rtl',
                    language: 'ar'
                @endif
            });

            showPicturePreview();

            $('#picture').change(function() {
                const file = $('#picture')[0].files[0].name;
                $(this).next('label').text(file);
            });
        });
    </script>

    @if(session()->has('success'))
        <x-toast-container>
            <x-toast.success message="{{ session('success') }}" automaticTrigger="true" />
        </x-toast-container>
    @endif

    @if($errors->any())
        <x-toast-container>
            @foreach ($errors->all() as $error)
                <x-toast.error message="{{ $error }}" automaticTrigger="true" />
            @endforeach
        </x-toast-container>
    @endif
@endpush
