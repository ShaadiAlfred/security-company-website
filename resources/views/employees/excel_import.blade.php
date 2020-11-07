@extends('layouts.main')

@push('stylesheets')
    <!-- Dropzone css -->
    <link href="{{ asset('/assets/node_modules/dropzone-master/dist/dropzone.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('breadcrumb')
    <li class="breadcrumb-item">
        <a href="javascript:void(0)">
            @lang('Manage Employees')
        </a>
    </li>

    <li class="breadcrumb-item active">
        @lang('Import Excel Files')
    </li>
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        @lang('Import Excel Files')
                    </h4>
                    <div class="row">
                        <div class="col-md-6 mx-auto">
                            <form action="{{ route('employees.storeFromExcel') }}" method="POST" class="dropzone"
                                  enctype="multipart/form-data" id="excelFiles">
                                @csrf
                                <div class="fallback">
                                    <input type="file" multiple required id="excel_files">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('javascript')
    <x-toast-container>
        <x-toast.success message="{{ trans('Employees were imoprted successfully!') }}" />
    </x-toast-container>

    <!-- Dropzone Plugin JavaScript -->
    <script src="{{ asset('/assets/node_modules/dropzone-master/dist/dropzone.js') }}"></script>

    <script type="text/javascript">
        Dropzone.options.excelFiles = {
            init: function() {
                this.on("success", function(file, response) {
                    console.log(response);
                    showSuccess();
                });
            }
        };
    </script>

    @if (session()->has('success'))
        showSuccess();
    @endif
@endpush
