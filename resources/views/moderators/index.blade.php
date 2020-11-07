@extends('layouts.main')

@push('breadcrumb')
    <li class="breadcrumb-item">
        <a href="javascript:void(0)">
            @lang('Manage Moderators')
        </a>
    </li>

    <li class="breadcrumb-item active">
        @lang('All Moderators')
    </li>
@endpush

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">@lang('All Moderators')</h4>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>@lang('Id')</th>
                                <th>@lang('Name')</th>
                                <th class="text-nowrap">@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($moderators as $id => $moderator)
                                <tr>
                                    <td>{{ ++$id }}</td>
                                    <td>
                                        <a href="{{ route('moderators.show', $moderator) }}">
                                            {{ $moderator->name }}
                                        </a>
                                    </td>
                                    <td>
                                        <div class="button-group">
                                            <a href="{{ route('moderators.edit', $moderator->id) }}"
                                            class="btn waves-effect waves-light btn-info">
                                                @lang('Edit')
                                            </a>
                                            <button user-id="{{ $moderator->id }}" type="button"
                                                    class="btn waves-effect waves-light btn-danger delete-user">
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
    <x-toast-container>
        <x-toast.success message="Moderator was deleted successfully!" />
    </x-toast-container>

    <script type="text/javascript">
        $(document).ready(() => {
            $('.btn.delete-user').on('click', function () {
                const userId = $(this).attr('user-id');

                $.ajax('{{ route('moderators.destroy', '') }}/' + userId, {
                    method: 'DELETE',
                    data: {
                        userId
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
