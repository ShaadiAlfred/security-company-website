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
                    <form action="{{ route('moderators.store') }}" method="POST" class="mt-4"
                          enctype="multipart/form-data">
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
                        <div class="row">
                            <div class="col-6">
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
                                <img id="picture-preview" />
                            </div>
                        </div>
                        <br />

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

    <script>
        (function showPicturePreview() {
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
        })();

        $(() => {
            $('#picture').change(function() {
                const file = $('#picture')[0].files[0].name;
                $(this).next('label').text(file);
            });
        });
    </script>
    @if (session()->has('success'))
        <x-toast-container>
            <x-toast.success message="{{ session('success') }}" automaticTrigger="true" />
        </x-toast-container>
    @endif
@endpush
