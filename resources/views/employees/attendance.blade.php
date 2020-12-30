@extends('layouts.main')

@push('stylesheets')
    <!-- select2 -->
    <link rel="stylesheet" href="{{ asset('/css/select2.min.css') }}" type="text/css" media="screen" />
    <!-- swtichery -->
    <link rel="stylesheet" href="{{ asset('/assets/node_modules/switchery/dist/switchery.min.css') }}" type="text/css" media="screen" />
@endpush

@push('breadcrumb')
    <li class="breadcrumb-item">
        <a href="javascript:void(0)">
            @lang('Manage Employees')
        </a>
    </li>

    <li class="breadcrumb-item active">
        @lang('Attendance')
    </li>
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        @lang('Attendance')
                    </h4>
                    <form onsubmit="getCurrentLocation(event)" class="mt-4">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="employee" class="m-t-20">
                                        @lang('Employee')
                                    </label>
                                    <select id="employee" name="employee" required>
                                        @foreach($employees as $employee)
                                            <option value="{{ $employee->id }}">
                                                {{ $employee->number . ' - ' . $employee->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="m-t-20">
                                        @lang('Note')
                                    </label>
                                    <input class="form-control" id="note" name="note" placeholder="@lang('Note')"
                                           maxlength="128" type="text">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="is_present" class="m-t-20">
                                        @lang('Is present?')
                                    </label>
                                    <br />
                                    <div class="d-flex pr-5" style="align-items: center;">
                                        <label class="m-0 ml-3">@lang('Present')</label>

                                        <input id="is_present"
                                               name="is_present"
                                               type="checkbox"
                                               class="js-switch"
                                               data-size="large"
                                               data-color="#f62d51"
                                               checked>

                                        <label class="m-0 mr-3">@lang('Absent')</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="webcam-container" class="d-none">
                            <video id="webcam" autoplay></video>

                            <button id="flip-webcam-btn"
                                    type="button"
                                    class="btn btn-cyan btn-circle btn-lg">
                                <i class="fas fa-sync-alt"></i>
                            </button>

                            <div id="webcam-btns-container" class="form-group">
                                <button id="capture-btn"
                                        type="button"
                                        class="btn btn-success btn-circle btn-lg">
                                    <i class="fas fa-camera-retro"></i>
                                </button>
                                <button id="close-webcam-btn"
                                        type="button"
                                        class="btn btn-danger btn-circle btn-lg">
                                    <i class="fas fa-times-circle"></i>
                                </button>
                            </div>
                            <canvas id="canvas" class="d-none"></canvas>
                            <audio id="snapSound"
                                   src="{{ asset('audio/camera-shutter-click.wav') }}"
                                   preload="auto">
                            </audio>
                        </div>
                        <div class="row">
                            <div class="col">
                                <img id="taken-picture-preview" class="img-fluid p-40" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <button id="open-webcam-btn" type="button" class="btn btn-info">
                                        <i class="fas fa-camera"></i> @lang('Take A Photo')
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        @lang('Send')
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('javascript')
    <x-toast-container>
        <x-toast.success message="Attendance sent successfully!" />
        <x-toast.error message="Attendance was not sent successfully!" />
    </x-toast-container>

    <!-- select2 -->
    <script src="{{ asset('/js/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('/js/select2/i18n/ar.js') }}"></script>

    <!-- swtichery -->
    <script src="{{ asset('/assets/node_modules/switchery/dist/switchery.min.js') }}"></script>

    <!-- webcam-easy -->
    <script src="{{ asset('js/webcam-easy.min.js') }}"></script>

    <!-- base64ToBlob -->
    <script type="text/javascript" src="{{ asset('js/base64ToBlob.js') }}"></script>

    <script type="text/javascript">
        async function getCurrentLocation(event) {
            event.preventDefault();

            if (window.navigator.geolocation) {
                console.log('Geolocation is available');
                try {
                    window.navigator.geolocation.getCurrentPosition(submitAttendance, console.error);
                } catch (error) {
                    console.error('Permission Denied By User!');
                }
            } else {
                console.error('Geolocation is not available on this device!');
            }
        }

        function submitAttendance(location) {
            // location.coords.[latitude|longitude]

            const submitAttendanceUrl = '{{ route('employees.submitAttendance') }}';

            const employeeId = $('#employee').val();
            const note = $('#note').val();
            const isPresent = document.querySelector('#is_present').checked;
            const formData = new FormData();

            formData.append('employeeId', employeeId);
            formData.append('isPresent', isPresent);
            formData.append('note', note);
            formData.append('latitude', location.coords.latitude);
            formData.append('longitude', location.coords.longitude);

            if (picture) {
                const blob = base64ToBlob(picture.replace(/^data:image\/(png|jpg);base64,/, ''), 'image/png');
                console.log(blob)
                formData.append('picture', blob);
            }

            $.ajax({
                method: 'POST',
                url: submitAttendanceUrl,
                data: formData,
                contentType: false,
                processData: false,
                success: showSuccess,
                error: showError,
            });
        }

        // Init
        $(document).ready(() => {
            // Switchery
            document.querySelectorAll('.js-switch').forEach(element => {
                new Switchery(element, element.dataset);
            });

            $('#employee').select2({
                'width': '100%',
                @if(app()->getLocale() === 'ar')
                    dir: 'rtl',
                    language: 'ar'
                @endif
            });
        });
    </script>
    <script>
        const webcamContainer = document.getElementById('webcam-container');
        const webcamElement = document.getElementById('webcam');
        const canvasElement = document.getElementById('canvas');
        const snapSoundElement = document.getElementById('snapSound');
        const webcam = new Webcam(webcamElement, 'enviroment', canvasElement, snapSoundElement);
        const captureBtn = document.getElementById('capture-btn');
        const closeWebcamBtn = document.getElementById('close-webcam-btn');
        const flipWebcamBtn = document.getElementById('flip-webcam-btn');
        let picture;
        const takenPicturePreview = document.getElementById('taken-picture-preview');

        function startWebcam() {
            webcamContainer.classList.remove('d-none');

            webcam.start()
                  .then(result =>{
                      console.log('Webcam started!');
                      if (webcamElement.style.transform === 'scale(-1, 1)') {
                          webcamElement.style.transform = 'translateX(-50%) scale(-1, 1)';
                      } else {
                          webcamElement.style.transform = 'translateX(-50%)';
                      }
                  })
                  .catch(err => {
                      console.log(err);
                  });
        }

        function flipWebcam() {
            webcam.flip();
            webcam.stop();
            startWebcam();
        }

        function closeWebcam() {
            webcam.stop();
            webcamContainer.classList.add('d-none');
        }

        document.getElementById('open-webcam-btn').addEventListener('click', () => {
            startWebcam();
        });

        captureBtn.addEventListener('click', () => {
            picture = webcam.snap()
            takenPicturePreview.src = picture;
            closeWebcam();
        });

        flipWebcamBtn.addEventListener('click', () => {
            flipWebcam();
        });

        closeWebcamBtn.addEventListener('click', () => {
            closeWebcam();
        });
    </script>
@endpush
