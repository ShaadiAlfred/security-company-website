<div>
    <script src="{{ asset('/assets/node_modules/toast-master/js/jquery.toast.js') }}"></script>

    <script type="text/javascript">
        const showSuccess = () => {
            window.$.toast({
                heading: '@lang('Success!')',
                text : '{{ $message }}',
                hideAfter : 5000,
                stack : 5,
                icon: 'success',
                textAlign : '{{ app()->getLocale() === 'ar' ? 'right' : 'left' }}',
                position : '{{ app()->getLocale() === 'ar' ? 'bottom-right' : 'bottom-left' }}',
            });
        };

        @if ($automaticTrigger)
            showSuccess();
        @endif
    </script>
</div>
