<?php

namespace App\View\Components\Toast;

use Illuminate\View\Component;

class ErrorWithMessage extends Component
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.toast.error_with_message');
    }
}
