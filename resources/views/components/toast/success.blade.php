<div>
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
        {{ $automaticTrigger ? 'showSuccess();' : '' }}
    </script>
</div>
