<div>
    <script src="{{ asset('/assets/node_modules/toast-master/js/jquery.toast.js') }}"></script>

    <script type="text/javascript">
        const showError = () => {
            window.$.toast({
                heading: '@lang('Error!')',
                text : '{{ $message }}',
                hideAfter : 5000,
                stack : 5,
                icon: 'error',
                textAlign : '{{ app()->getLocale() === 'ar' ? 'right' : 'left' }}',
                position : '{{ app()->getLocale() === 'ar' ? 'bottom-right' : 'bottom-left' }}',
            });
        };

        @if ($automaticTrigger)
            showError();
        @endif
    </script>
</div>
